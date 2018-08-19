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

require_once('../initialize.php');
import('form.Form');
import('ttUserHelper');
import('ttTeamHelper');
import('ttClientHelper');
import('ttTimeHelper');
import('DateAndTime');

// Access check.
if (!ttAccessCheck(right_data_entry)) {
  header('Location: access_denied.php');
  exit();
}

// Initialize and store date in session.
$cl_date = $request->getParameter('date', @$_SESSION['date']);
$selected_date = new DateAndTime(DB_DATEFORMAT, $cl_date);
if($selected_date->isError())
  $selected_date = new DateAndTime(DB_DATEFORMAT);
if(!$cl_date)
  $cl_date = $selected_date->toString(DB_DATEFORMAT);
$_SESSION['date'] = $cl_date;
  
// Determine previous and next dates for simple navigation.
$prev_date = date('Y-m-d', strtotime('-1 day', strtotime($cl_date)));
$next_date = date('Y-m-d', strtotime('+1 day', strtotime($cl_date)));

// Use custom fields plugin if it is enabled.
if (in_array('cf', explode(',', $user->plugins))) {
  require_once('../plugins/CustomFields.class.php');
  $custom_fields = new CustomFields($user->team_id);
  $smarty->assign('custom_fields', $custom_fields);
}

// Initialize variables.
$cl_start = trim($request->getParameter('start'));
$cl_finish = trim($request->getParameter('finish'));
$cl_duration = trim($request->getParameter('duration'));
$cl_note = trim($request->getParameter('note'));
// Custom field.
$cl_cf_1 = trim($request->getParameter(('cf_1'), ($request->getMethod()=='POST'? null : @$_SESSION['cf_1'])));
$_SESSION['cf_1'] = $cl_cf_1;
$cl_billable = 1;
if (in_array('iv', explode(',', $user->plugins))) {
  if ($request->getMethod() == 'POST') {
    $cl_billable = $request->getParameter('billable');
    $_SESSION['billable'] = (int) $cl_billable;
  } else 
    if (isset($_SESSION['billable']))
      $cl_billable = $_SESSION['billable'];
}
$cl_client = $request->getParameter('client', ($request->getMethod()=='POST'? null : @$_SESSION['client']));
$_SESSION['client'] = $cl_client;
$cl_project = $request->getParameter('project', ($request->getMethod()=='POST'? null : @$_SESSION['project']));
$_SESSION['project'] = $cl_project;
$cl_task = $request->getParameter('task', ($request->getMethod()=='POST'? null : @$_SESSION['task']));
$_SESSION['task'] = $cl_task;

// Elements of timeRecordForm.
$form = new Form('timeRecordForm');

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $user->tracking_mode && in_array('cl', explode(',', $user->plugins))) {
    $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'value'=>$cl_client,
      'data'=>$active_clients,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))
    ));
  // Note: in other modes the client list is filtered to relevant clients only. See below.
}

if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  //att reports for user
  $optimized_att_reports = ttTimeHelper::optimizationAttReports(
    $user->getAttInReports($cl_date), 
    $user->getAttOutReports($cl_date)
  );

  $att_start_list = $optimized_att_reports->start_list;
  $att_finish_list = $optimized_att_reports->finish_list;
  
  if(empty($cl_start) && empty($cl_finish) && empty($tt_records))
  {
      if(count($att_start_list) == 1)
      {
          $cl_start = $att_start_list[0];
          $att_start = $att_start_list[0];
      }
      else if(count($att_start_list) >1)
      {
          //handle more than 1
          $cl_start = ttTimeHelper::$multiple;
          $att_start = ttTimeHelper::$multiple;
      }
      if(count($att_finish_list) == 1)
      {
          $cl_finish = $att_finish_list[0];
          $att_finish = $att_finish_list[0];
      }
      else if(count($att_finish_list) >1)
      {
          //handle more than 1
          $cl_finish = ttTimeHelper::$multiple;
          $att_finish = ttTimeHelper::$multiple;
      }
 
      if(count($att_start_list) + count($att_finish_list) >0)
      {
          $cl_location = 6;//משרד צפון
      }
  }
  
  // Dropdown for projects assigned to user.
  $project_list = $user->getAssignedProjects();
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillTaskDropdown(this.value);',
    'name'=>'project',
    'style'=>'width: 250px;',
    'value'=>$cl_project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))
  ));

  // Dropdown for clients if the clients plugin is enabled.
  if (in_array('cl', explode(',', $user->plugins))) {
    $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
    // We need an array of assigned project ids to do some trimming. 
    foreach($project_list as $project)
      $projects_assigned_to_user[] = $project['id'];

    // Build a client list out of active clients. Use only clients that are relevant to user.
    // Also trim their associated project list to only assigned projects (to user).
    foreach($active_clients as $client) {
  	  $projects_assigned_to_client = explode(',', $client['projects']);
  	  $intersection = array_intersect($projects_assigned_to_client, $projects_assigned_to_user);
  	  if ($intersection) {
  	    $client['projects'] = implode(',', $intersection);
  	    $client_list[] = $client;
  	  }
    }
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'value'=>$cl_client,
      'data'=>$client_list,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))
    ));
  }
}

if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  $task_list = ttTeamHelper::getActiveTasks($user->team_id);
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'style'=>'width: 250px;',
    'value'=>$cl_task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))
  ));
}
if ((TYPE_START_FINISH == $user->record_type) || (TYPE_ALL == $user->record_type)) {
  $form->addInput(array('type'=>'text','name'=>'start','value'=>$cl_start,'onchange'=>"formDisable('start');"));
  $form->addInput(array('type'=>'text','name'=>'finish','value'=>$cl_finish,'onchange'=>"formDisable('finish');"));
}
if (!$user->canManageTeam() && defined('READONLY_START_FINISH') && isTrue(READONLY_START_FINISH)) {
  // Make the start and finish fields read-only.
  $form->getElement('start')->setEnable(false);
  $form->getElement('finish')->setEnable(false);	
}
if ((TYPE_DURATION == $user->record_type) || (TYPE_ALL == $user->record_type))
  $form->addInput(array('type'=>'text','name'=>'duration','value'=>$cl_duration,'onchange'=>"formDisable('duration');"));
$form->addInput(array('type'=>'textarea','name'=>'note','style'=>'width: 250px; height: 60px;','value'=>$cl_note));
if (in_array('iv', explode(',', $user->plugins)))
  $form->addInput(array('type'=>'checkbox','name'=>'billable','data'=>1,'value'=>$cl_billable));
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_submit click.
$form->addInput(array('type'=>'submit','name'=>'btn_submit','onclick'=>'browser_today.value=get_date()','value'=>$i18n->getKey('button.submit')));
  
// If we have custom fields - add controls for them.
if ($custom_fields && $custom_fields->fields[0]) {
  // Only one custom field is supported at this time.
  if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT) {
  	$form->addInput(array('type'=>'text','name'=>'cf_1','value'=>$cl_cf_1));
  } else if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN) {
    $form->addInput(array('type'=>'combobox','name'=>'cf_1',
      'style'=>'width: 250px;',
      'value'=>$cl_cf_1,
      'data'=>$custom_fields->options,
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))
    ));
  }
}

// Determine lock date. Time entries earlier than lock date cannot be created or modified. 
$lock_interval = $user->lock_interval;
$lockdate = 0;
if ($lock_interval > 0) {
  $lockdate = new DateAndTime();
  $lockdate->decDay($lock_interval);
}

// Submit.
if ($request->getMethod() == 'POST') {
  if ($request->getParameter('btn_submit')) {

    // Validate user input.
    if (in_array('cl', explode(',', $user->plugins)) && in_array('cm', explode(',', $user->plugins)) && !$cl_client)
      $errors->add($i18n->getKey('error.client'));
    if ($custom_fields) {
      if (!ttValidString($cl_cf_1, !$custom_fields->fields[0]['required'])) $errors->add($i18n->getKey('error.field'), $custom_fields->fields[0]['label']);
    }
    if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
      if (!$cl_project) $errors->add($i18n->getKey('error.project'));
      if (!$cl_activity) $errors->add($i18n->getKey('error.activity'));
    }
    if (!$cl_duration) {
      if ('0' == $cl_duration)
        $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.duration'));
      else if ($cl_start || $cl_finish) {
        if (!ttTimeHelper::isValidTime($cl_start))
          $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.start'));
        if ($cl_finish) {
          if (!ttTimeHelper::isValidTime($cl_finish))
            $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.finish'));
          if (!ttTimeHelper::isValidInterval($cl_start, $cl_finish))
            $errors->add($i18n->getKey('error.interval'), $i18n->getKey('label.finish'), $i18n->getKey('label.start'));
        }
      } else {
      	if ((TYPE_START_FINISH == $user->record_type) || (TYPE_ALL == $user->record_type)) {
          $errors->add($i18n->getKey('error.empty'), $i18n->getKey('label.start'));
          $errors->add($i18n->getKey('error.empty'), $i18n->getKey('label.finish'));
      	}
        if ((TYPE_DURATION == $user->record_type) || (TYPE_ALL == $user->record_type))
          $errors->add($i18n->getKey('error.empty'), $i18n->getKey('label.duration'));
      }
    } else {
      if (!ttTimeHelper::isValidDuration($cl_duration))
        $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.duration'));
    }
    if (!ttValidString($cl_note, true)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.note'));
    // Finished validating user input.
    
    // Prohibit creating entries in future.
    if (defined('FUTURE_ENTRIES') && !isTrue(FUTURE_ENTRIES)) {
      $browser_today = new DateAndTime(DB_DATEFORMAT, $request->getParameter('browser_today', null));
      if ($selected_date->after($browser_today))
        $errors->add($i18n->getKey('error.future_date'));
    }
    
    // Prohibit creating time entries in locked interval.
    if($lockdate && $selected_date->before($lockdate))
      $errors->add($i18n->getKey('error.period_locked'));
    
    // Prohibit creating another uncompleted record.
    if ($errors->isEmpty()) {
      if (($not_completed_rec = ttTimeHelper::getUncompleted($user->getActiveUser())) && (($cl_finish == '') && ($cl_duration == '')))
        $errors->add($i18n->getKey('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->getKey('error.goto_uncompleted')."</a>");
    }
    
    // Prohibit creating an overlapping record.
    if ($errors->isEmpty()) {
      if (ttTimeHelper::overlaps($user->getActiveUser(), $cl_date, $cl_start, $cl_finish))
        $errors->add($i18n->getKey('error.overlap'));
    }  
          
    if ($errors->isEmpty()) {
      $id = ttTimeHelper::insert(array(
        'date' => $cl_date,
        'user_id' => $user->getActiveUser(),
        'client' => $cl_client,
        'project' => $cl_project,
        'task' => $cl_task,
        'start' => $cl_start,
        'finish' => $cl_finish,
        'duration' => $cl_duration,
        'note' => $cl_note,
        'billable' => $cl_billable));
        	
      // Insert a custom field if we have it.
      $result = true;
      if ($id && $custom_fields && $cl_cf_1) {
        if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
          $result = $custom_fields->insert($id, $custom_fields->fields[0]['id'], null, $cl_cf_1);
        else if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
          $result = $custom_fields->insert($id, $custom_fields->fields[0]['id'], $cl_cf_1, null);
      }

      if ($id && $result) {
        header('Location: time.php');
        exit();
      }
      $errors->add($i18n->getKey('error.db'));
    }
  }
}

$smarty->assign('next_date', $next_date);
$smarty->assign('prev_date', $prev_date);
$smarty->assign('time_records', ttTimeHelper::getRecords($user->getActiveUser(), $cl_date));
$smarty->assign('day_total', ttTimeHelper::getTimeForDay($user->getActiveUser(), $cl_date));
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('timestring', $selected_date->toString($user->date_format));
$smarty->assign('title', $i18n->getKey('title.time'));
$smarty->assign('content_page_name', 'mobile/time.tpl');
$smarty->display('mobile/index.tpl');
$smarty->assign('att_start', $att_start);
$smarty->assign('att_finish', $att_finish);
?>