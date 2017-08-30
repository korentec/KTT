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

import('ttTeamHelper');
import('ttUserHelper');

// Class ttNotificationHelper is used to help with notification related tasks.
class ttNotificationHelper {
	
  // get - gets notification details. 
  static function get($id)
  {
    global $user;
 
    $mdb2 = getConnection();

    $sql = "select c.id, c.cron_spec, c.report_id, c.email, c.status, fr.name from tt_cron c
      left join tt_fav_reports fr on (fr.id = c.report_id)
      where c.id = $id and c.team_id = $user->team_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
	  if ($val && $val['id'])
        return $val;
    }
    return false;
  }
  
  // delete - deletes a notification from tt_cron table. 
  static function delete($id) {
    global $user;
  	    
    $mdb2 = getConnection();
    
    $sql = "delete from tt_cron where id = $id and team_id = $user->team_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

  	return true;
  }
  
  // insert function inserts a new notification into database.
  static function insert($fields)
  {
    $mdb2 = getConnection();

    $team_id = (int) $fields['team_id'];
    $cron_spec = $fields['cron_spec'];
    $next = (int) $fields['next'];
    $report_id = (int) $fields['report_id'];
    $email = $fields['email'];
    $status = $fields['status'];
    
    $sql = "insert into tt_cron (team_id, cron_spec, next, report_id, email, status)
      values ($team_id, ".$mdb2->quote($cron_spec).", $next, $report_id, ".$mdb2->quote($email).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;
 
    return true;
  } 
  
  // update function - updates a notification in database.
  static function update($fields)
  {
    $mdb2 = getConnection();
    
    $notification_id = (int) $fields['id'];
    $team_id = (int) $fields['team_id'];
    $cron_spec = $fields['cron_spec'];
    $next = (int) $fields['next'];
    $report_id = (int) $fields['report_id'];
    $email = $fields['email'];
    $status = $fields['status'];
    
    $sql = "update tt_cron set cron_spec = ".$mdb2->quote($cron_spec).", next = $next, report_id = $report_id, email = ".$mdb2->quote($email).", status = ".$mdb2->quote($status).
      " where id = $notification_id and team_id = $team_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
}
?>