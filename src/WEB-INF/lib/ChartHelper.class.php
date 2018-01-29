<?php

import('ttUserHelper');
import('ttTimeHelper');
import('ActivityHelper');
import('ttProjectHelper');
import('DateAndTime');
import('Period');

/**
* ChartHelper class for drawing chart data
* @package TimeTracker
*/
class ChartHelper {

    /**
     * Returns all information for drawing activity chart for specified user_id
     * @param int $user_id
     * @param int $cl_period 1 = this day, 2 = this week, 3 = this month, 4 = this year
     * @param string $cl_pie_mode "project" for project mode otherwise activities mode
     * @return array
     */
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
	  		$activities = ProjectHelper::findAllProjects($active_user, array('showHidden' => true));
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
			$totalsTime = TimeHelper::getTotalTimeByActivities($acts, $active_user->getUserId(), $period, $cl_pie_mode);

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
}
?>