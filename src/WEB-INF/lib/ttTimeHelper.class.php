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
import('DateAndTime');
// The ttTimeHelper is a class to help with time-related values.
class ttTimeHelper {
    static $multiple = "(multiple)";

	
  /* // isWeekend determines if $date falls on weekend.
  static function isWeekend($date) {
	$weekDay = date('w', strtotime($date));
    return ($weekDay == WEEKEND_START_DAY || $weekDay == (WEEKEND_START_DAY + 1) % 7);
  }*/
  // isValidTime validates a value as a time string.
  static function isValidTime($value) {
    if (strlen($value)==0 || !isset($value)) return false;
    
    // 24 hour patterns.
    if ($value == '24:00' || $value == '2400') return true;
    
    if (preg_match('/^([0-1]{0,1}[0-9]|[2][0-3]):?[0-5][0-9]$/', $value )) { // 0:00 - 23:59, 000 - 2359
      return true;
    }
    if (preg_match('/^([0-1]{0,1}[0-9]|[2][0-4])$/', $value )) { // 0 - 24
      return true;
    }    
    
    // 12 hour patterns
    if (preg_match('/^[1-9]\s?(am|AM|pm|PM)$/', $value)) { // 1 - 9 am
      return true;
    }
    if (preg_match('/^(0[1-9]|1[0-2])\s?(am|AM|pm|PM)$/', $value)) { // 01 - 12 am
      return true;
    }
    if (preg_match('/^[1-9]:?[0-5][0-9]\s?(am|AM|pm|PM)$/', $value)) { // 1:00 - 9:59 am, 100 - 959 am
      return true;
    }    
    if (preg_match('/^(0[1-9]|1[0-2]):?[0-5][0-9]\s?(am|AM|pm|PM)$/', $value)) { // 01:00 - 12:59 am, 0100 - 1259 am
      return true;	
    }
    return false;
  }
  
  static function isValidTimeArray($valuesArr) {

    if(!isset($valuesArr) || !is_array($valuesArr))
        return false;
    
    foreach ($valuesArr as $value)
    {
       if(!ttTimeHelper::isValidTime($value))
           return false;
    }
    return true;
  }
  
  // isValidDuration validates a value as a time duration string (in hours and minutes).
  static function isValidDuration($value) {
    if (strlen($value)==0 || !isset($value)) return false;
    
    if ($value == '24:00' || $value == '2400') return true;
    if (preg_match('/^([0-1]{0,1}[0-9]|2[0-3]):?[0-5][0-9]$/', $value )) { // 0:00 - 23:59, 000 - 2359
      if ('00:00' == ttTimeHelper::normalizeDuration($value))
        return false;
      return true;
    }
    if (preg_match('/^([0-1]{0,1}[0-9]|2[0-4])h?$/', $value )) { // 0, 1 ... 24
      if ('00:00' == ttTimeHelper::normalizeDuration($value))
        return false;
      return true;
    }
    if (preg_match('/^([0-1]{0,1}[0-9]|2[0-3])?[.][0-9]{1,4}h?$/', $value )) { // Decimal values like 0.5, 1.25h, ... .. 23.9999h
      if ('00:00' == ttTimeHelper::normalizeDuration($value))
        return false;
      return true;
    }
    return false;
  }
  
  // normalizeDuration - converts a valid time duration string to format 00:00.
  static function normalizeDuration($value) {
    $time_value = $value;
    
    // If we have a decimal format - convert to time format 00:00.
    if((strpos($time_value, '.') !== false) || (strpos($time_value, 'h') !== false)) {
      $val = floatval($time_value);
      $mins = round($val * 60);
      $hours = (string)((int)($mins / 60));
      $mins = (string)($mins % 60);
      if (strlen($hours) == 1)
        $hours = '0'.$hours;
      if (strlen($mins) == 1)
        $mins = '0' . $mins;
      return $hours.':'.$mins;
    }
          
    $time_a = explode(':', $time_value);
    $res = '';
    // 0-99
    if ((strlen($time_value) >= 1) && (strlen($time_value) <= 2) && !isset($time_a[1])) {
      $hours = $time_a[0];
      if (strlen($hours) == 1)
        $hours = '0'.$hours;
       return $hours.':00';
    }
    // 000-2359 (2400)
    if ((strlen($time_value) >= 3) && (strlen($time_value) <= 4) && !isset($time_a[1])) {
      if (strlen($time_value)==3) $time_value = '0'.$time_value;
      $hours = substr($time_value,0,2);
      if (strlen($hours) == 1)
        $hours = '0'.$hours;
      return $hours.':'.substr($time_value,2,2);
    }
    // 0:00-23:59 (24:00)
    if ((strlen($time_value) >= 4) && (strlen($time_value) <= 5) && isset($time_a[1])) {
      $hours = $time_a[0];
      if (strlen($hours) == 1)
        $hours = '0'.$hours;
      return $hours.':'.$time_a[1];
    }
    return $res;
  }
  
  // toMinutes - converts a time string in format 00:00 to a number of minutes.
  static function toMinutes($value) {
    $time_a = explode(':', $value);
    return (int)@$time_a[1] + ((int)@$time_a[0]) * 60;
  }
  
  // toDuration - calculates duration between start and finish times in 00:00 format.
  static function toDuration($start, $finish) {
    $duration_minutes = ttTimeHelper::toMinutes($finish) - ttTimeHelper::toMinutes($start);
    if ($duration_minutes <= 0) return false;
    
    $hours = (string)((int)($duration_minutes / 60));
    $mins = (string)($duration_minutes % 60);
    if (strlen($hours) == 1)
      $hours = '0'.$hours;
    if (strlen($mins) == 1)
      $mins = '0' . $mins;
    return $hours.':'.$mins;
  }
  
  // The to12HourFormat function converts a 24-hour time value (such as 15:23) to 12 hour format (03:23 PM).
  static function to12HourFormat($value) {
  	if ('24:00' == $value) return '12:00 AM';
  	
    $time_a = explode(':', $value);
    if ($time_a[0] > 12)
      $res = (string)((int)$time_a[0] - 12).':'.$time_a[1].' PM';
    else if ($time_a[0] == 12)
      $res = $value.' PM';
    else if ($time_a[0] == 0)
      $res = '12:'.$time_a[1].' AM';
    else
      $res = $value.' AM';
    return $res;
  }
  
  // The to24HourFormat function attempts to convert a string value (human readable notation of time of day)
  // to a 24-hour time format HH:MM.
  static function to24HourFormat($value) {
  	$res = null;
  	
  	// Algorithm: use regular expressions to find a matching pattern, starting with most popular patterns first.
  	$tmp_val = trim($value);
        
        //remove seconds - tbd revital: remove for all reg expressions and add also to isvalidtime()
//        if (preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/', $tmp_val)) { // 00:00:00 - 23:59:59
//            $tmp_val = substr($tmp_val,0, strlen($tmp_val)-3);
//        }

  	// 24 hour patterns.
  	if (preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $tmp_val)) { // 00:00 - 23:59
  	  // We already have a 24-hour format. Just return it. 
  	  $res = $tmp_val; 
  	  return $res;
  	}
  	if (preg_match('/^[0-9]:[0-5][0-9]$/', $tmp_val)) { // 0:00 - 9:59
  	  // This is a 24-hour format without a leading zero. Add 0 and return.
  	  $res = '0'.$tmp_val; 
  	  return $res;
  	}
    if (preg_match('/^[0-9]$/', $tmp_val)) { // 0 - 9
  	  // Single digit. Assuming hour number.
  	  $res = '0'.$tmp_val.':00'; 
  	  return $res;
  	}
    if (preg_match('/^([01][0-9]|2[0-4])$/', $tmp_val)) { // 00 - 24
  	  // Two digit hour number.
  	  $res = $tmp_val.':00'; 
  	  return $res;
  	}
    if (preg_match('/^[0-9][0-5][0-9]$/', $tmp_val)) { // 000 - 959
  	  // Missing colon. We'll assume the first digit is the hour, the rest is minutes.
  	  $tmp_arr = str_split($tmp_val);
  	  $res = '0'.$tmp_arr[0].':'.$tmp_arr[1].$tmp_arr[2]; 
  	  return $res;
  	}  	
    if (preg_match('/^([01][0-9]|2[0-3])[0-5][0-9]$/', $tmp_val)) { // 0000 - 2359
  	  // Missing colon. We'll assume the first 2 digits are the hour, the rest is minutes.
  	  $tmp_arr = str_split($tmp_val);
  	  $res = $tmp_arr[0].$tmp_arr[1].':'.$tmp_arr[2].$tmp_arr[3]; 
  	  return $res;
  	}
  	// Special handling for midnight.
    if ($tmp_val == '24:00' || $tmp_val == '2400')
      return '24:00';  
  	
    // 12 hour AM patterns.
    if (preg_match('/.(am|AM)$/', $tmp_val)) {
    	
      // The $value ends in am or AM. Strip it.
      $tmp_val = rtrim(substr($tmp_val, 0, -2));
      
      // Special case to handle 12, 12:MM, and 12MM AM.
      if (preg_match('/^12:?([0-5][0-9])?$/', $tmp_val))
        $tmp_val = '00'.substr($tmp_val, 2);
        
      // We are ready to convert AM time.
      if (preg_match('/^(0[0-9]|1[0-1]):[0-5][0-9]$/', $tmp_val)) { // 00:00 - 11:59
  	    // We already have a 24-hour format. Just return it. 
  	    $res = $tmp_val; 
        return $res;
  	  }
  	  if (preg_match('/^[1-9]:[0-5][0-9]$/', $tmp_val)) { // 1:00 - 9:59
  	    // This is a 24-hour format without a leading zero. Add 0 and return.
  	    $res = '0'.$tmp_val; 
  	    return $res;
  	  }
      if (preg_match('/^[1-9]$/', $tmp_val)) { // 1 - 9
    	// Single digit. Assuming hour number.
        $res = '0'.$tmp_val.':00'; 
  	    return $res;
  	  }
  	  if (preg_match('/^(0[0-9]|1[0-1])$/', $tmp_val)) { // 00 - 11
  	    // Two digit hour number.
  	    $res = $tmp_val.':00'; 
  	    return $res;
  	  }
      if (preg_match('/^[1-9][0-5][0-9]$/', $tmp_val)) { // 100 - 959
        // Missing colon. Assume the first digit is the hour, the rest is minutes.
  	    $tmp_arr = str_split($tmp_val);
  	    $res = '0'.$tmp_arr[0].':'.$tmp_arr[1].$tmp_arr[2]; 
  	    return $res;
  	  }  	
      if (preg_match('/^(0[0-9]|1[0-1])[0-5][0-9]$/', $tmp_val)) { // 0000 - 1159
        // Missing colon. We'll assume the first 2 digits are the hour, the rest is minutes.
  	    $tmp_arr = str_split($tmp_val);
  	    $res = $tmp_arr[0].$tmp_arr[1].':'.$tmp_arr[2].$tmp_arr[3]; 
  	    return $res;
  	  }  
    } // AM cases handling.
    // 12 hour PM patterns.
    if (preg_match('/.(pm|PM)$/', $tmp_val)) {
      	
      // The $value ends in pm or PM. Strip it.
      $tmp_val = rtrim(substr($tmp_val, 0, -2));
        
      if (preg_match('/^[1-9]$/', $tmp_val)) { // 1 - 9
        // Single digit. Assuming hour number.
        $hour = (string)(12 + (int)$tmp_val);
        $res = $hour.':00';
        return $res;
      }
      if (preg_match('/^((0[1-9])|(1[0-2]))$/', $tmp_val)) { // 01 - 12
        // Double digit hour.
        if ('12' != $tmp_val)
          $tmp_val = (string)(12 + (int)$tmp_val);
        $res = $tmp_val.':00';
        return $res;
      }        
      if (preg_match('/^[1-9][0-5][0-9]$/', $tmp_val)) { // 100 - 959
        // Missing colon. We'll assume the first digit is the hour, the rest is minutes.
  	    $tmp_arr = str_split($tmp_val);
  	    $hour = (string)(12 + (int)$tmp_arr[0]);
  	    $res = $hour.':'.$tmp_arr[1].$tmp_arr[2]; 
  	    return $res;
  	  }
  	  if (preg_match('/^(0[1-9]|1[0-2])[0-5][0-9]$/', $tmp_val)) { // 0100 - 1259
        // Missing colon. We'll assume the first 2 digits are the hour, the rest is minutes.
        $hour = substr($tmp_val, 0, -2);
        $min = substr($tmp_val, 2);
        if ('12' != $hour)
          $hour = (string)(12 + (int)$hour); 
        $res = $hour.':'.$min; 
  	    return $res;
  	  }  
      if (preg_match('/^[1-9]:[0-5][0-9]$/', $tmp_val)) { // 1:00 - 9:59
  	    $hour = substr($tmp_val, 0, -3);
        $min = substr($tmp_val, 2);
        $hour = (string)(12 + (int)$hour);
        $res = $hour.':'.$min; 	
  	    return $res;
  	  }
      if (preg_match('/^(0[1-9]|1[0-2]):[0-5][0-9]$/', $tmp_val)) { // 01:00 - 12:59
  	    $hour = substr($tmp_val, 0, -3);
        $min = substr($tmp_val, 3);
        if ('12' != $hour)
          $hour = (string)(12 + (int)$hour);
  	    $res = $hour.':'.$min;
        return $res;
  	  }    
    } // PM cases handling.
    return $res;
  }
  
  // isValidInterval - checks if finish time is greater than start time.
  static function isValidInterval($start, $finish) {
    $start = ttTimeHelper::to24HourFormat($start);
    $finish = ttTimeHelper::to24HourFormat($finish);
    if ('00:00' == $finish) $finish = '24:00';
    
    $minutesStart = ttTimeHelper::toMinutes($start);
    $minutesFinish = ttTimeHelper::toMinutes($finish);
    if ($minutesFinish > $minutesStart)
      return true;
    return false;
  }
  
  static function isValidIntervalArray($startArr, $finishArr) {

    if(!isset($startArr) || !is_array($startArr) || !isset($finishArr) || !is_array($finishArr))
        return false;
    
    if(count($startArr) < count($finishArr))
        return false;
    
    for ($i = 0; $i < count($finishArr); $i++)
    {
       if(!ttTimeHelper::isValidInterval($startArr[$i], $finishArr[$i]))
           return false;
    }
    return true;
  }
  
  // insert - inserts a time record into log table. Does not deal with custom fields.
  static function insert($fields)
  {
    $user_start = $fields['start'];
    $user_finish = $fields['finish'];
    $att_start = $fields['att_start'];
    $att_finish = $fields['att_finish'];

    $att_start_count = isset($att_start) ? count($att_start) : 0;
    $att_finish_count = isset($att_finish) ? count($att_finish) : 0;

    //single or no att reports (up to 1 for start and 1 for finish) - insert 1 record with start dirty flag according to user and att values
    if($att_start_count <=1 && $att_finish_count <=1)
    {
        $fields['start_dirty'] = ($att_start_count == 0) ? true : (ttTimeHelper::to24HourFormat($att_start[0]) != ttTimeHelper::to24HourFormat($user_start));
        $fields['duration_dirty'] = ($att_finish_count == 0) ? true : (ttTimeHelper::to24HourFormat($att_finish[0]) != ttTimeHelper::to24HourFormat($user_finish));
        return ttTimeHelper::insertSingle($fields);
    }

    //multiple att records for start, finish or both
    //check dirty state (compare user values with att values)
    $start_dirty = true;
    if(   ($att_start_count>1 && $user_start == ttTimeHelper::$multiple) ||
          ($att_start_count==1 && ttTimeHelper::to24HourFormat($att_start[0]) == ttTimeHelper::to24HourFormat($user_start)))
    {
        //more than 1 att start . if user value is multiple, dirty flag is false
        $start_dirty = false;
    }

    $finish_dirty = true;
    if(   ($att_finish_count>1 && $user_finish == ttTimeHelper::$multiple) ||
          ($att_finish_count==1 && ttTimeHelper::to24HourFormat($att_finish[0]) == ttTimeHelper::to24HourFormat($user_finish)))
    {
        //in case more than 1 att finish . if user value is multiple, dirty flag is false
        //in case 1 att finish . if user value equals att value, dirty flag is false
        $finish_dirty = false;
    }
    
    //more than 1 att record but start is missing for finish report - ERROR
    if(!$start_dirty && !$finish_dirty && $att_start_count < $att_finish_count)
    {
        return false; //tbd revital check condition
    }
    
    //user overrides att reports - insert 1 record with user values
    if($start_dirty && $finish_dirty)
    {
        $fields['start_dirty'] = true;
        $fields['duration_dirty'] = true;
        return ttTimeHelper::insertSingle($fields);
    }
    //user overides only start att report
    if($start_dirty && !$finish_dirty)
    {
        //more than 1 att finish report for overriten start report - ERROR
        if($att_finish_count>1)
            return false; 

        //overriten att start, 1 att finish report  - insert 1 record with dirty flags accordingly
        $fields['start_dirty'] = true;
        $fields['duration_dirty'] = false;
        $fields['finish'] = $att_finish[0];
        return ttTimeHelper::insertSingle($fields);  
    }

    //user hasnt overriten start att report
    $fields['start_arr'] = $att_start;
    $fields['finish_arr'] = ($finish_dirty) ? array($user_finish) : $att_finish;
    $fields['start_dirty'] = $start_dirty;
    $fields['duration_dirty'] = $finish_dirty;
    return ttTimeHelper::insertMultiple($fields);   
  }
      
private static function insertSingle($fields)    
{
        
    //execute transaction tt_log insert query & att_log update archived flag

    $mdb2 = getConnection();
    try
    {
        $mdb2->beginTransaction();
        $timestamp = isset($fields['timestamp']) ? $fields['timestamp'] : '';
        $user_id = $fields['user_id'];
        $user_att_id = $fields['att_id'];
        $date = $fields['date'];
        $start = $fields['start'];
        $finish = $fields['finish'];
        $location = $fields['location'];
        $duration = $fields['duration'];    
        $client = $fields['client'];
        $project = $fields['project'];
        $activity = $fields['activity'];
        $task = $fields['task'];
        $invoice = $fields['invoice'];
        $note = $fields['note'];
        $attendance_note = $fields['attendance_note'];
        $billable = $fields['billable'];
        $start_dirty = $fields['start_dirty'];
        $duration_dirty = $fields['duration_dirty'];
        $approved = !boolval($start_dirty) && !boolval($duration_dirty);
        if (array_key_exists('status', $fields)) { // Key exists and may be NULL during migration of data.
          $status_f = ', status';
          $status_v = ', '.$mdb2->quote($fields['status']);
        }
        $start = ttTimeHelper::to24HourFormat($start);
        if ($finish) {
          $finish = ttTimeHelper::to24HourFormat($finish);
          if ('00:00' == $finish) $finish = '24:00';
        }
        $duration = ttTimeHelper::normalizeDuration($duration);
        if (!$timestamp) {
          $timestamp = date('YmdHis');//yyyymmddhhmmss
        }

        if (!$billable) $billable = 0;

        if ($duration) {
            $sql = "insert into tt_log (timestamp, user_id, date, duration, client_id, project_id, al_activity_id,al_location_id,task_id, invoice_id, comment, comment_attendance, billable $status_f) ".
                    "values ('$timestamp', $user_id, ".$mdb2->quote($date).", '$duration', ".$mdb2->quote($client).", ".$mdb2->quote($project).",".$mdb2->quote($activity).",".$mdb2->quote($location).", ".$mdb2->quote($task).", ".$mdb2->quote($invoice).", ".$mdb2->quote($note).", ".$mdb2->quote($attendance_note).", $billable $status_v)";
            $affected = $mdb2->exec($sql);
            if (is_a($affected, 'PEAR_Error'))
                throw new Exception ();
        } else {
            $duration = ttTimeHelper::toDuration($start, $finish);
            if ($duration === false) $duration = 0;
            if (!$duration && ttTimeHelper::getUncompleted($user_id)) throw new Exception ();
            $sql = "insert into tt_log (timestamp, user_id, date, start, start_dirty, duration, duration_dirty, approved, client_id, project_id, al_activity_id,al_location_id,task_id, invoice_id, comment, comment_attendance, billable $status_f) ".
              "values ('$timestamp', $user_id, ".$mdb2->quote($date).", '$start', '$start_dirty', '$duration', '$duration_dirty', '$approved', ".$mdb2->quote($client).", ".$mdb2->quote($project).",".$mdb2->quote($activity).",".$mdb2->quote($location).", ".$mdb2->quote($task).", ".$mdb2->quote($invoice).", ".$mdb2->quote($note).", ".$mdb2->quote($attendance_note).", $billable $status_v)";
            $affected = $mdb2->exec($sql);
            if (is_a($affected, 'PEAR_Error'))
              throw new Exception ();
        }
        $id = $mdb2->lastInsertID('tt_log', 'id');

        $sql1 = "UPDATE `att_log` SET `archived`=1 WHERE date=".$mdb2->quote($date)." AND att_id=".$user_att_id.";";
        //        echo '</br>';
        //        print_r($sql1);
        //        echo '</br>';
        $affected1 = $mdb2->exec($sql1);
        if (is_a($affected1, 'PEAR_Error'))
            throw new Exception ();

        $mdb2->commit();

        return $id;
    
    } catch (Exception $ex) {
        $mdb2->rollback();
        return false;
    }
  }
  
private static function insertMultiple($fields)    
{
    //execute transaction tt_log insert query & att_log update archived flag
    $mdb2 = getConnection();
    
    try
    {
        $mdb2->beginTransaction();
        
        //tbd revital: transaction for mark att_reords as obsolete
        $timestamp = isset($fields['timestamp']) ? $fields['timestamp'] : '';
        $user_id = $fields['user_id'];
        $user_att_id = $fields['att_id'];
        $date = $fields['date'];
        $start_arr = $fields['start_arr'];
        $finish_arr = $fields['finish_arr'];
        $location = $fields['location'];
        //$duration = $fields['duration'];  //tbd revital: check if insert multi can support data with duration instead of start and finish???  
        $client = $fields['client'];
        $project = $fields['project'];
        $activity = $fields['activity'];
        $task = $fields['task'];
        $invoice = $fields['invoice'];
        $note = $fields['note'];
        $attendance_note = $fields['attendance_note'];
        $billable = $fields['billable'];
        $start_dirty = $fields['start_dirty'];
        $duration_dirty = $fields['duration_dirty'];
        if (array_key_exists('status', $fields)) { // Key exists and may be NULL during migration of data.
          $status_f = ', status';
          $status_v = ', '.$mdb2->quote($fields['status']);
        }

        if(count($start_arr) < count($finish_arr))
            throw new Exception ();


        if (!$billable) $billable = 0;

        $sql = '';
//        if ($duration) 
//        {
//          $sql = "insert into tt_log (timestamp, user_id, date, duration, client_id, project_id, al_activity_id,al_location_id,task_id, invoice_id, comment, billable $status_f) ".
//            "values ";
//        } 
//        else 
        {
          $sql = "insert into tt_log (timestamp, user_id, date, start, start_dirty, duration, duration_dirty, approved, client_id, project_id, al_activity_id,al_location_id,task_id, invoice_id, comment, comment_attendance, billable $status_f) ".
            "values ";  
        }
        for($i=0; $i<count($start_arr) ; $i++)
        {
            $start = $start_arr[$i];
            $start = ttTimeHelper::to24HourFormat($start);

            $finish = count($finish_arr)>$i ? $finish_arr[$i] : NULL;
            $finish_dirty = true;
            if ($finish) {
                $finish_dirty = $duration_dirty;
              $finish = ttTimeHelper::to24HourFormat($finish);
              if ('00:00' == $finish) $finish = '24:00';
            }
            $approved = !boolval($start_dirty) && !boolval($finish_dirty);
            //$duration = ttTimeHelper::normalizeDuration($duration);
            if (!$timestamp) {
              $timestamp = date('YmdHis');//yyyymmddhhmmss
            }
//            if ($duration) 
//            {
//                $sql .= "('$timestamp', $user_id, ".$mdb2->quote($date).", '$duration', ".$mdb2->quote($client).", ".$mdb2->quote($project).",".$mdb2->quote($activity).",".$mdb2->quote($location).", ".$mdb2->quote($task).", ".$mdb2->quote($invoice).", ".$mdb2->quote($note).", $billable $status_v), ";
//            }
            //else
            {
                $duration = ttTimeHelper::toDuration($start, $finish);
                if ($duration === false) $duration = 0;
                if (!$duration && ttTimeHelper::getUncompleted($user_id)) 
                    throw new Exception ();
                $sql .= "('$timestamp', $user_id, ".$mdb2->quote($date).", '$start', '$start_dirty', '$duration', '$finish_dirty', '$approved', ".$mdb2->quote($client).", ".$mdb2->quote($project).",".$mdb2->quote($activity).",".$mdb2->quote($location).", ".$mdb2->quote($task).", ".$mdb2->quote($invoice).", ".$mdb2->quote($note).", ".$mdb2->quote($attendance_note).", $billable $status_v), ";
            }
        }        

        $sql = rtrim($sql,", ");
        $sql.=";";

        $affected = $mdb2->exec($sql);
          if (is_a($affected, 'PEAR_Error'))
            throw new Exception ();
        $id = $mdb2->lastInsertID('tt_log', 'id');
        
        
        $sql1 = "UPDATE `att_log` SET `archived`=1 WHERE date=".$mdb2->quote($date)." AND att_id=".$user_att_id.";";
    //        echo '</br>';
    //        print_r($sql1);
    //        echo '</br>';
        $affected1 = $mdb2->exec($sql1);
        if (is_a($affected1, 'PEAR_Error'))
            throw new Exception ();
        
        $mdb2->commit();

        return $id;
    
    } catch (Exception $ex) {
        $mdb2->rollback();
        return false;
    }
  }
  

  // update - updates a record in log table. Does not update its custom fields.
  static function update($fields)
  {
    $mdb2 = getConnection();
    $id = $fields['id'];
    $date = $fields['date'];
    $user_id = $fields['user_id'];
    $client = $fields['client'];
    $activity 		= $fields['activity'];
    //  $subactivity 	= $fields['subactivity'];
    $location 		= $fields['location'];
    $project = $fields['project'];
    $task = $fields['task'];
    $start = ttTimeHelper::to24HourFormat($fields['start']);
    $finish = ttTimeHelper::to24HourFormat($fields['finish']);
    $duration = ttTimeHelper::normalizeDuration($fields['duration']);
    $note = $fields['note'];
    $attendance_note = $fields['attendance_note'];
    $billable = $fields['billable'];
    $user_start = $fields['start'];
    $user_finish = $fields['finish'];
    $att_start = $fields['att_start'];
    $att_finish = $fields['att_finish'];
    $row_index = $fields['row_index'];
    if ('00:00' == $finish) $finish = '24:00';
    if (!$billable) $billable = 0;
    if ($start) $duration = '';

    $att_start_count = isset($att_start) ? count($att_start) : 0;
    $att_finish_count = isset($att_finish) ? count($att_finish) : 0;
  
    //get current record from DB
    $curr = ttTimeHelper::getRecord($id, $user_id);
    if(!$curr)
        return false;
    if ($duration) {
        $duration_dirty = ($att_finish_count == 0) ? true : ($att_finish[$row_index] != $user_finish);
        $approved = !boolval($duration_dirty);
        $sql = "UPDATE tt_log set start = NULL, duration = '$duration', duration_dirty = '$duration_dirty', approved = '$approved', client_id = ".$mdb2->quote($client).", project_id = ".$mdb2->quote($project).",  al_activity_id = ".$mdb2->quote($activity).",
	   al_location_id = ".$mdb2->quote($location).",task_id = ".$mdb2->quote($task).", ".
            "comment = ".$mdb2->quote($note).", comment_attendance = ".$mdb2->quote($attendance_note).", billable = $billable, date = '$date' WHERE id = $id";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
            return false;
    } else {
      $duration = ttTimeHelper::toDuration($start, $finish);
      if ($duration === false)
        $duration = 0;
      $uncompleted = ttTimeHelper::getUncompleted($user_id);
      if (!$duration && $uncompleted && ($uncompleted['id'] != $id))
        return false;
      
      $start_dirty = ($att_start_count == 0) ? true : (ttTimeHelper::to24HourFormat($att_start[$row_index]) != ttTimeHelper::to24HourFormat($user_start));
      $duration_dirty = ($att_finish_count == 0) ? true : (ttTimeHelper::to24HourFormat($att_finish[$row_index]) != ttTimeHelper::to24HourFormat($user_finish));
      $approved = !boolval($start_dirty) && !boolval($duration_dirty);
      $sql = "UPDATE tt_log SET start = '$start', start_dirty = '$start_dirty', duration = '$duration', duration_dirty = '$duration_dirty', approved = '$approved', client_id = ".$mdb2->quote($client).", project_id = ".$mdb2->quote($project).", task_id = ".$mdb2->quote($task).", 
	   al_activity_id = ".$mdb2->quote($activity).", al_location_id = ".$mdb2->quote($location).",".
        "comment = ".$mdb2->quote($note).", comment_attendance = ".$mdb2->quote($attendance_note).", billable = $billable, date = '$date' WHERE id = $id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
      
    }
    return true;
  }
  
  // delete - deletes a record from tt_log table and its associated custom field values.
  static function delete($id, $user_id, $att_id) {
    $mdb2 = getConnection();
    
    try{
        
        $mdb2->beginTransaction();

        $curr = ttTimeHelper::getRecord($id, $user_id);
        if(!$curr)
            throw new Exception ();  
        
        $sql = "update tt_log set status = NULL where id = $id and user_id = $user_id";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          throw new Exception ();

        $sql = "update tt_custom_field_log set status = NULL where log_id = $id";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          throw new Exception ();

        //if no other records from same day, restore records from att_log
        $tmp = ttTimeHelper::getRecords($user_id, $curr['date']);
        if(count($tmp) == 0)
        {
            $sql1 = "UPDATE `att_log` SET `archived`=0 WHERE date=".$mdb2->quote($curr['date'])." AND att_id=".$att_id.";";
            $affected1 = $mdb2->exec($sql1);
            if (is_a($affected1, 'PEAR_Error'))
                throw new Exception ();
        }
        $mdb2->commit();
        return true;
    
    } catch (Exception $ex) {
        $mdb2->rollback();
        return false;
    }
  }
  
  // getTimeForDay - gets total time for a user for a specific date.
  static function getTimeForDay($user_id, $date) {
    $mdb2 = getConnection();
    $sql = "select sum(time_to_sec(duration)) as sm from tt_log where user_id = $user_id and date = '$date' and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return sec_to_time_fmt_hm($val['sm']);
    }
    return false;
  }
  
  // getTimeForWeek - gets total time for a user for a given week.
  static function getTimeForWeek($user_id, $date) {
    import('Period');
    $mdb2 = getConnection();
    $period = new Period(INTERVAL_THIS_WEEK, $date);
    $sql = "select sum(time_to_sec(duration)) as sm from tt_log where user_id = $user_id and date >= '".$period->getBeginDate(DB_DATEFORMAT)."' and date <= '".$period->getEndDate(DB_DATEFORMAT)."' and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return sec_to_time_fmt_hm($val['sm']);
    }
    return 0;
  }
  
  // getUncompleted - retrieves an uncompleted record for user, if one exists.
  static function getUncompleted($user_id) {
    $mdb2 = getConnection();
    $sql = "select id from tt_log  
      where user_id = $user_id and start is not null and time_to_sec(duration) = 0 and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }
  
  // overlaps - determines if a record overlaps with an already existing record.
  //
  // Parameters:
  //   $user_id - user id for whom to determine overlap
  //   $date - date
  //   $start - new record start time
  //   $finish - new record finish time, may be null
  //   $record_id - optional record id we may be editing, excluded from overlap set
  static function overlaps($user_id, $date, $start, $finish, $record_id = null) {
    $mdb2 = getConnection();
    
    $start = ttTimeHelper::to24HourFormat($start);
    if ($finish) {
      $finish = ttTimeHelper::to24HourFormat($finish);
      if ('00:00' == $finish) $finish = '24:00';
    }
    // Handle these 3 overlap situations:
    // - start time in existing record
    // - end time in existing record
    // - record fully encloses existing record
    $sql = "select id from tt_log  
      where user_id = $user_id and date = ".$mdb2->quote($date)."
      and start is not null and duration is not null and status = 1 and (
      (cast(".$mdb2->quote($start)." as time) >= start and cast(".$mdb2->quote($start)." as time) < addtime(start, duration))";
    if ($finish) {
      $sql .= " or (cast(".$mdb2->quote($finish)." as time) <= addtime(start, duration) and cast(".$mdb2->quote($finish)." as time) > start)
      or (cast(".$mdb2->quote($start)." as time) < start and cast(".$mdb2->quote($finish)." as time) > addtime(start, duration))";
    }
    $sql .= ")";
    if ($record_id) {
      $sql .= " and id <> $record_id";
    }
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }
  
  // getRecord - retrieves a time record identified by its id.
  static function getRecord($id, $user_id) {
  	global $user;
  	$sql_time_format = "'%k:%i'"; //  24 hour format.
  	if ('%I:%M %p' == $user->time_format)
  	  $sql_time_format = "'%h:%i %p'"; // 12 hour format for MySQL TIME_FORMAT function.

    $mdb2 = getConnection();
    $sql = "select l.id as id, l.timestamp as timestamp, TIME_FORMAT(l.start, $sql_time_format) as start,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), $sql_time_format) as finish,
      TIME_FORMAT(l.duration, '%k:%i') as duration,
      p.name as project_name, t.name as task_name, l.comment, l.comment_attendance, l.client_id, l.project_id, l.task_id, l.invoice_id, l.billable, l.date
	  , l.al_activity_id, 
	  l.al_location_id,activities.a_name,locations.l_name,l.start_dirty, l.duration_dirty, l.approved
      from tt_log l
      left join tt_projects p on (p.id = l.project_id)
      left join tt_tasks t on (t.id = l.task_id) left join activities   on (l.al_activity_id = activities.a_id) left join locations   on (l.al_location_id = locations.l_id)
      where l.id = $id and l.user_id = $user_id and l.status = 1";
   
    $res = $mdb2->query($sql);
   
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }
  
  // getAllRecords - returns all time records for a certain user.
  static function getAllRecords($user_id) {
    $result = array();
    $mdb2 = getConnection();
    $sql = "select l.id, l.timestamp, l.user_id, l.date, TIME_FORMAT(l.start, '%k:%i') as start,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), '%k:%i') as finish,
      TIME_FORMAT(l.duration, '%k:%i') as duration,
      l.client_id, l.project_id, l.task_id, l.invoice_id, l.comment, l.comment_attendance, l.billable, l.status,l.approved
      from tt_log l where l.user_id = $user_id order by l.id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    } else return false;
    return $result;
  }
  
  // getRecords - returns time records for a user for a given date.
  static function getRecords($user_id, $date) {
  	global $user;
  	$sql_time_format = "'%k:%i'"; //  24 hour format.
  	if ('%I:%M %p' == $user->time_format)
  	  $sql_time_format = "'%h:%i %p'"; // 12 hour format for MySQL TIME_FORMAT function.	
  	  	
    $result = array();
    $mdb2 = getConnection();
    $client_field = null;
    if (in_array('cl', explode(',', $user->plugins)))
      $client_field = ", c.name as client";
    
    $left_joins = " left join tt_projects p on (l.project_id = p.id)".
      " left join tt_tasks t on (l.task_id = t.id)     left join activities   on (l.al_activity_id = activities.a_id) left join locations   on (l.al_location_id = locations.l_id)";
    if (in_array('cl', explode(',', $user->plugins)))
      $left_joins .= " left join tt_clients c on (l.client_id = c.id)";
    $sql = "select l.id as id, TIME_FORMAT(l.start, $sql_time_format) as start, l.start_dirty as start_dirty,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), $sql_time_format) as finish, l.duration_dirty as duration_dirty,
      TIME_FORMAT(l.duration, '%k:%i') as duration, p.name as project, t.name as task, l.comment, l.comment_attendance, l.billable, l.invoice_id $client_field, l.al_activity_id, 
	  l.al_location_id,activities.a_name,locations.l_name,l.approved
      from tt_log l
      $left_joins
      where l.date = '$date' and l.user_id = $user_id and l.status = 1
      order by l.start, l.id";
	  
	 // echo $sql;
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        if($val['duration']=='0:00')
          $val['finish'] = '';
        $result[] = $val;
      }
    } else return false;
    return $result;
  }

  static function getLastSyncDate($format=API_DATEFORMAT)
  {
      $mdb2 = getConnection();
      try {

        $sql = "SELECT last_att_sync FROM `tt_general` FIRST;";
        $res = $mdb2->query($sql);
        $val = $res->fetchRow()[last_att_sync];
        
        if(!$val)
            return null;
            
        $val = new DateAndTime($format, $val);
        return $val;

    } catch (Exception $ex) {
        throw new Exception("internal database query error");
    }
  }
// insertAtt - inserts a time record into att log table. Does not deal with custom fields.
  static function insertAtt($from, $to, $recordsArr)
  {
    if(count($recordsArr) == 0 )
        return 0;
    
    $mdb2 = getConnection();
    
    //build sql statement
    try {

        $sql = "INSERT INTO att_log (timestamp, att_id, date, time, in_out) ".
                "VALUES ";

        //tbd revital: validate date and time format
        foreach ($recordsArr as $record) {
            $timestamp = (new DateAndTime(DB_DATEFORMAT, $record['timestamp']))->toString(DB_DATEFORMAT);//tbd revital - convert from any format
            if (!$timestamp) {
              $timestamp = date('YmdHis');//yyyymmddhhmmss
            }
            $date = (new DateAndTime(DB_DATEFORMAT, $record[date]))->toString(DB_DATEFORMAT);
            $att_id = $record['att_id'];
            $time = ttTimeHelper::to24HourFormat($record['time']);
            if ('00:00' == $time) $time = '24:00';
            $in_out = $record['in_out'];    
            $sql .= "('$timestamp', $att_id, ".$mdb2->quote($date).", '$time', '$in_out'), ";
        }

        $sql = rtrim($sql,", ");
        $sql.=";";
    
    } catch (Exception $exc) {
        return 0;
    }
    
    //execute transaction insert query & update last sync query
    try{
        $mdb2->beginTransaction();
        
        //update att_log table ================
//        echo '</br>';
//        print_r($sql);
//        echo '</br>';
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
            throw new Exception ();
        
        //update tt_general table ================
        if($affected>0)
        {
            $tmp = $to->toString(API_DATEFORMAT);
            $sql1 = "UPDATE `tt_general` SET `last_att_sync`='$tmp' WHERE id=1;";
            //echo '</br>';
            //print_r($sql1);
            //echo '</br>';
            $affected1 = $mdb2->exec($sql1);
            if (is_a($affected1, 'PEAR_Error'))
                throw new Exception ();
        }
        $mdb2->commit();

    } catch (Exception $ex) {
        $mdb2->rollback();
        return 0;
    }

    return $affected;
  }

  static function optimizeAttReports($att_start_list, $att_finish_list) {
    $isOut = false;
    $new_att_start_list = [];
    $new_att_finish_list = [];
    
    $from_index = 0;
    foreach($att_start_list as $in) {
      if (count($new_att_finish_list) && strtotime($in) < strtotime(end($new_att_finish_list))) {
        continue;
      }

      for ($index = $from_index; $index < count($att_finish_list); $index++) {
        if (strtotime($in) < strtotime($att_finish_list[$index])) {
          array_push($new_att_start_list, $in);
          array_push($new_att_finish_list, $att_finish_list[$index]);
          $from_index = $index + 1;
          $isOut = true;
          break;
        }
      }

      if (!$isOut) {
        array_push($new_att_start_list, $in);
      }
    }

    $optimized_att_reports = (object) [
      "start_list" => $new_att_start_list,
      "finish_list" => $new_att_finish_list
    ];

    return $optimized_att_reports;
  }

  static function approvedValidation(
    $user_id, 
    $date,
    $att_start_list, 
    $att_finish_list
  ) {
    $userReports = array();
    $mdb2 = getConnection();
    $sql = "SELECT * FROM tt_log WHERE user_id = " . $user_id . " AND date = '" . $date . "'" . " AND status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $userReports[] = $val;
      }
    }

    $totalClockTime = '';
    foreach($att_start_list as $key => $in) {
      $duration = date("H:i:s", (strtotime($att_finish_list[$key]) - strtotime($in)));
      $totalClockTime = date("H:i:s", (strtotime($totalClockTime) + strtotime($duration)));
    }

    $totalUserTime = '';
    foreach($userReports as $report) {
      $totalUserTime = date("H:i:s", (strtotime($totalUserTime) + strtotime($report["duration"])));
    }

    $approved = $totalClockTime === $totalUserTime ? 1 : 0;
    $sql = "UPDATE tt_log SET approved = " . $approved . " WHERE user_id = " . $user_id . " AND date = '" . $date . "'" . 
      " AND status = 1" . " AND start_dirty + duration_dirty > 0";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      $errors->add($i18n->getKey('error.db'));
    }
  }

  static function filterAttReport($reports, $archived) {
    $filtered_reports = [];
    foreach($reports as $report) {
      if ($archived === "all" || $report->archived == $archived) {
        array_push($filtered_reports, $report->time);
      }
    }

    return $filtered_reports;
  }
  
}
?>