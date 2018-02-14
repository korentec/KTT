<?php

/* 
 * this page is used for sync att clock dat ato ktt database.
 * It handlsed http POST request with the data in the following format:
 * key: "from" value: date indication from which records where pulled from att clock.
 *      example : "2013-01-25 01:23:15"
 * key: "data" value: json array of time reports from att clock. 
 *      example: "[{"timestamp":"2017-01-02 01:02:03","att_id":140, "date":"2017-09-11", "time":"08:30", "in_out": false},{"timestamp":"2017-01-02 01:02:03","att_id":141, "date":"2017-09-21", "time":"12:30", "in_out": true}]"}]
 */

require_once('initialize.php');
import('ttTimeHelper');
import('DateAndTime');

$errors = '';  // string to hold validation errors
$data = array();        // array to pass back data

// validate from variable =======

if(($from_str = trim($_POST['from'])) == ''){
    $errors = 'from date is required.';
}else if(($to_str = trim($_POST['to'])) == ''){
    $errors = 'to date is required.';
}else if(($from = (new DateAndTime(API_DATEFORMAT, $from_str))) == null){
    $errors = 'invalid from date. ' . $from_str;
}else if(($to = (new DateAndTime(API_DATEFORMAT, $to_str))) == null){
    $errors = 'invalid to date. ' . $to_str;
}else if(($lastSync = ttTimeHelper::getLastSyncDate()) !=null && $from->compare($lastSync)<0){
    $errors = 'data was already imported from this date. data last syncronized on '.$lastSync->toString(API_DATEFORMAT);
}else if($from->compare($to)>0){
    $errors = 'invalid from date ' . $from_str . ' or to date ' . $to_str;
}
// validate data variable ========
if (($data_str = trim($_POST['data'])) == '')
  $errors = 'data is required.';
else{
    // Convert JSON string to Array
    $res_arr = json_decode($data_str, true);
    if(count($res_arr) ==0)
        $errors = 'empty data.';
}

//if no errors, perform sync ==============
if (strlen($errors) == 0)
{
    if(ttTimeHelper::insertAtt($from, $to, $res_arr) != count($res_arr))
        $errors['data'] = 'writing to DB failed.';
}

// return a response ==============
$data['lastSync'] = ttTimeHelper::getLastSyncDate()->toString(API_DATEFORMAT);
// response if there are errors
if ( strlen($errors) > 0 ) {
  // if there are items in our errors array, return those errors
  $data['success'] = false;
  $data['errors']  = $errors;
} else {
  // if there are no errors, return a message
  $data['success'] = true;
}

// return all our data to an AJAX call
echo json_encode($data);
?>