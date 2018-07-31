<?php

require_once('initialize.php');
import('ttTimeHelper');
import('DateAndTime');

$data = array();        // array to pass back data

// return a response ==============
try
{
  $data['lastSync'] = ttTimeHelper::getLastSyncDate()->toString(API_DATEFORMAT);
  $data['success'] = true;
}
catch(Exception $ex)
{
  $data['lastSync'] = null;
  $data['success'] = false;  
  $data['errors']  = $ex->getMessage();
}
// if there are no errors, return a message


// return all our data to an AJAX call
echo json_encode($data);
?>