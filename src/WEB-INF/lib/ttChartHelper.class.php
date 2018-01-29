<?php
// +----------------------------------------------------------------------+
// | Anuko Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) Anuko International Ltd. (https://www.anuko.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors:
// | https://www.anuko.com/time_tracker/credits.htm
// +----------------------------------------------------------------------+

import('Period');

// Definitions for chart types.
define('CHART_PROJECTS', 1);
define('CHART_TASKS', 2);
define('CHART_CLIENTS', 3);

// Class ttChartHelper is a helper class for charts.
class ttChartHelper {

  // getTotals - returns total times by project or activity for a given user in a specified period.
  static function getTotals($user_id, $ch_type, $cl_date, $cl_period = null) {

    $period = null;
    if (isset($cl_period) && isset($cl_date)) {
      switch ($cl_period) {
        case INTERVAL_THIS_DAY:
          $period = new Period(INTERVAL_THIS_DAY, new DateAndTime(DB_DATEFORMAT, $cl_date));
          break;
 
        case INTERVAL_THIS_WEEK:
          $period = new Period(INTERVAL_THIS_WEEK, new DateAndTime(DB_DATEFORMAT, $cl_date));
          break;

        case INTERVAL_THIS_MONTH:
          $period = new Period(INTERVAL_THIS_MONTH, new DateAndTime(DB_DATEFORMAT, $cl_date));
          break;

        case INTERVAL_THIS_YEAR:
          $period = new Period(INTERVAL_THIS_YEAR, new DateAndTime(DB_DATEFORMAT, $cl_date));
          break;
      }
    }
   	
    $result = array();
    $mdb2 = getConnection();

    $q_period = '';
    if ($period != null) {
      $q_period = " and date >= '".$period->getBeginDate(DB_DATEFORMAT)."' and date <= '".$period->getEndDate(DB_DATEFORMAT)."'";
    }
    if (CHART_PROJECTS == $ch_type) {
      // Data for projects.
      $sql = "select p.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        inner join tt_projects p on (p.id = l.project_id)
        where l.status = 1 and l.duration > 0 and l.user_id = $user_id $q_period group by l.project_id";
    } else if (CHART_TASKS == $ch_type) {
      // Data for tasks.
      $sql = "select t.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        inner join tt_tasks t on (t.id = l.task_id)
        where l.status = 1 and l.duration > 0 and l.user_id = $user_id $q_period group by l.task_id";
    } else if (CHART_CLIENTS == $ch_type) {
      // Data for clients.
      $sql = "select coalesce(c.name, 'NULL') as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_clients c on (c.id = l.client_id)
        where l.status = 1 and l.duration > 0 and l.user_id = $user_id $q_period group by l.client_id";    	
    }
    
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = array('name'=>$val['name'],'time'=>$val['time']); // name  - project name, time - total for project in seconds.
      }
    }
    
    // Get total time. We'll need it calculate percentages (for labels to the right of diagram).
    $total = 0;
    foreach ($result as $one_val) {
      $total += $one_val['time'];
	}
	// Add a string representation of time + percentage to names. Example: "Time Tracker (1:15 - 6%)".
	foreach ($result as &$one_val) {
	  $percent = round(100*$one_val['time']/$total).'%';
      $one_val['name'] .= ' ('.sec_to_time_fmt_hm($one_val['time']).' - '.$percent.')';
	}
	    
    // Note: the remaining code here is needed to display labels on the side of a diagram.
    // We print lables ourselves (not using libchart.php) because quality of libchart labels is not good. 
	
	// Note: Optimize this sorting and reversing.
    $result = mu_sort($result, 'time');
    $result = array_reverse($result); // This is to assign correct colors to labels.
        
    // Add color to array items. This is used in labels on the side of a chart.
    $colors = array(
      array(2, 78, 0),
      array(148, 170, 36),
      array(233, 191, 49),
      array(240, 127, 41),
      array(243, 63, 34),
      array(190, 71, 47),
      array(135, 81, 60),
      array(128, 78, 162),
      array(121, 75, 255),
      array(142, 165, 250),
      array(162, 254, 239),
      array(137, 240, 166),
      array(104, 221, 71),
      array(98, 174, 35),
      array(93, 129, 1)
    );
    for ($i = 0; $i < count($result); $i++) {
      $color = $colors[$i%count($colors)];
      $result[$i]['color_html'] = sprintf('#%02x%02x%02x', $color[0], $color[1], $color[2]);
    }
			
    return $result;
  }
}



  function getActivityChartData($user_id, $cl_period, $cl_pie_mode) {
			$user = new User($user_id);
$user->getAttribute($auth->getUserId());
			$period = null;
			//$cl_period = $request->getParameter('period', $_SESSION['chPeriod']);

			//$cl_pie_mode = $request->getParameter('pie_mode', null); // activities OR project

			$cl_date = $_SESSION['date'];
			if (isset($cl_period) && isset($cl_date)) {
				switch ($cl_period) {
					case "1":
						$period = new Period(PERIOD_THIS_DAY, new DateAndTime(SYS_DATEFORMAT, $cl_date));
						break;

					case "2":
						$period = new Period(PERIOD_THIS_WEEK, new DateAndTime(SYS_DATEFORMAT, $cl_date));
						break;

					case "3":
						$period = new Period(PERIOD_THIS_MONTH, new DateAndTime(SYS_DATEFORMAT, $cl_date));
						break;

					case "4": // year
						$period = new Period(PERIOD_THIS_YEAR, new DateAndTime(SYS_DATEFORMAT, $cl_date));
						break;
				}
			}

			// Activities
			$active_user = new User($user->getActiveUser(), false);

			if($cl_pie_mode AND $cl_pie_mode=="project") {
	  		$activities = ttProjectHelper::findAllProjects($active_user, array('showHidden' => true));
				$acts = array();
				foreach ($activities as $a) $acts[] = $a["p_id"];
				$kname = "p_id";
				$fname = "p_name";
			} else {
				$activities = ActivityHelper::findAllActivity($active_user, "", false, true);
				$acts = array();
				foreach ($activities as $a) $acts[] = $a["a_id"];
				$kname = "a_id";
				$fname = "a_name";
			}
			$totalsTime = ttTimeHelper::getTotalTimeByActivities($acts, $active_user->getUserId(), $period, $cl_pie_mode);

			//$cnt = 0;
			$total = 0;

			foreach ($activities as $a) {
				if (isset($totalsTime[$a[$kname]])) {
					//$cnt++;
					//if ($cnt>9) $height += 20;
					$total += TimeHelper::toMinutes($totalsTime[$a[$kname]]);
				}
			}

			// colors from PieChart.php. no way to get them without creating object.
			$colors = array(
				array(2, 78, 0),
				array(148, 170, 36),
				array(233, 191, 49),
				array(240, 127, 41),
				array(243, 63, 34),
				array(190, 71, 47),
				array(135, 81, 60),
				array(128, 78, 162),
				array(121, 75, 255),
				array(142, 165, 250),
				array(162, 254, 239),
				array(137, 240, 166),
				array(104, 221, 71),
				array(98, 174, 35),
				array(93, 129, 1)
			);



			$points = array();
			foreach ($activities as $a) {
				if (isset($totalsTime[$a[$kname]]) && $totalsTime[$a[$kname]]!="0:00") {

					$points[] = array('name' => $a[$fname], 'time' => $totalsTime[$a[$kname]],
						'time_perc' => round(TimeHelper::toMinutes($totalsTime[$a[$kname]])/$total*100)."%",
						'time_min' => TimeHelper::toMinutes($totalsTime[$a[$kname]]));
				}
			}

			function sort_points($a, $b) {
				return $b['time_min'] - $a['time_min'];
			}
			usort($points, 'sort_points');

			for ($i = 0; $i < count($points); $i++) {
				$color = $colors[$i % count($colors)];
				$points[$i]['color'] = $color;
				$points[$i]['color_html'] = sprintf('#%02x%02x%02x', $color[0], $color[1], $color[2]);
			}

			return array('active_user_name' => $active_user->getUserName(), 'kname' => $kname, 'fname' => $fname, 'totalsTime' => $totalsTime, 'activities' => $activities, 'points' => $points);
    }
?>