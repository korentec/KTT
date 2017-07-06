<?php
/** WR Time Tracker
*
* Copyright (c) 2004-2006 WR Consulting (http://wrconsulting.com)
*
* LIBERAL FREEWARE LICENSE: This source code document may be used
* by anyone for any purpose, and freely redistributed alone or in
* combination with other software, provided that the license is obeyed.
*
* There are only two ways to violate the license:
*
* 1. To redistribute this code in source form, with the copyright
*    notice or license removed or altered. (Distributing in compiled
*    forms without embedded copyright notices is permitted).
*
* 2. To redistribute modified versions of this code in *any* form
*    that bears insufficient indications that the modifications are
*    not the work of the original author(s).
*
* This license applies to this document only, not any other software
* that it may be combined with.
* 
* Contributors: Igor Melnik <igor.melnik at mail.ru>
* 
*/

/**
 * Class ClientHelper for manipulation with the Client data
 * @package TimeTracker
 */
class LocationHelper {
    
	/**
         * Finds all client data belonging to the user with specified $owner_id
         * @param int $owner_id
         * @return array 
         */
	function findAllLocations() {
		$result = array();
		  $mdb2 = getConnection();
    	
   		$sel_str = "SELECT *
    			FROM locations
    			ORDER BY l_name";
		 $res = $mdb2->query($sel_str);
  	 
    		while ($val = $res->fetchRow()) {
      			$result[] = $val;
				//echo $val["l_name"];
      		}
      		$result = mu_sort($result,"l_name");
 
  		
  		return $result;
	}

        /**
         * Finds client data by it ID. Returns array of data.
         * @param User $user
         * @param int $id
         * @return array 
         */
	function findLocationById($id) {
 $mdb2 = getConnection();
    		
	  $sth =  "select *
                from locations
                where  l_id=$id" ;
	  $res = $mdb2->query($sth);
	 
    		$val = $res->fetchRow();
		    if ($val['l_id'] != '') {
      			return $val;
    		} else {
      			return false;
    		}
	   
	  return false;
    }
    
    
    /* Inserts record about client into database. Returns ID of new record.
     * @param User $user
     * @param array $fields
     * @return int
     */
    function insert($fields)      
    {

  		$db = DB::connect(DSN);
    	if (DB::isError($db))
    		return false;
        
    	$name = $fields['name'];
		$sql_str="insert into locations (l_name) values(!)";
		$data = pear_db_quote($db, array($name));
		$sth = $db->prepare($sql_str);
		$rc = $db->execute($sth,$data);
  		if (DB::isError($rc) == 0) {
			return @$newid;
  		}	
		return false;
  	}
  	
  	
        /**
     * Updates location data in database
     * @param User $user
     * @param array $fields
     * @return int 
     */

  	function update($fields)
    {   
  		$db = DB::connect(DSN);
    	if (DB::isError($db))
    		return false;

    	$id = $fields['id'];
      $name = $fields['name'];
     
		
  		$sth = $db->prepare("update locations set l_name=! where  l_id=".$id);
  		$data = pear_db_quote($db, array($name));
  		$rc = $db->execute($sth ,$data);
  		if (DB::isError($rc) == 0) {
			return $id;
  		}	
      	return false;
	}
	
	
			/*
         * Deletes client data from database. Returns of boolean result of action.
         * @param User $user
         * @param int $id
         * @return boolean 
         */
         
	function delete($id) 
	{
		$db = DB::connect(DSN);
    	if (DB::isError($db))
    		return false;

		$sth = $db->prepare("DELETE FROM locations WHERE l_id = $id");
		$rc = $db->execute($sth);
		if (DB::isError($rc) == 0) {
  			return true;
		}
    	return false;
	}
	        /**
         * Fills ActionForm object by client data
         * @param User $user
         * @param int $client_id
         * @param ActionForm $bean 
         */
	function fillBean($location_id, &$bean) {
		$location_arr = Helper::findLocationById($location_id);
		$bean->setAttribute("name",$location_arr["l_name"]);
	}

}
?>