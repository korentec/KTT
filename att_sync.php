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

$errors = array();  // array to hold validation errors
$data = array();        // array to pass back data

// validate from variable ========
if(($from_str = trim($_POST['from'])) == '')
    $errors['from'] = 'from date is required.';
else if(($from = (new DateAndTime(DB_DATEFORMAT, $from_str))) == null)
    $errors['from'] = 'invalid from date. ' . $from_str;
else if(($lastFrom = ttTimeHelper::getLastSyncDate()) !=null && $lastFrom >= $from)
    $errors['from'] = 'data was already imported from this date. data last syncronized on '.$lastFrom->toString(DB_DATEFORMAT);


// validate data variable ========
if (($data_str = trim($_POST['data'])) == '')
  $errors['data'] = 'data is required.';
else{
    // Convert JSON string to Array
    $res_arr = json_decode($data_str, true);
    if(count($res_arr) ==0)
        $errors['data'] = 'empty data.';
}

//if no errors, perform sync ==============
if (count($errors) == 0)
{
    if(ttTimeHelper::insertAtt($from, $res_arr) != count($res_arr))
        $errors['data'] = 'writing to DB failed.';
}

// return a response ==============

// response if there are errors
if ( count($errors) > 0 ) {
  // if there are items in our errors array, return those errors
  $data['success'] = false;
  $data['errors']  = $errors;
} else {
  // if there are no errors, return a message
  $data['success'] = true;
  $data['message'] = 'Success!';
}

// return all our data to an AJAX call
echo json_encode($data);
?>