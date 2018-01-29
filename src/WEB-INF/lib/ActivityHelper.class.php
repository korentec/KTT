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

// $Id: ActivityHelper.class.php,v 1.17 2008/12/29 01:50:53 nokuntseff Exp $

import("ttProjectHelper");

/**
 * Class ActivityHelper for manipulation with the Activity data
 * @package TimeTracker
 */
class ActivityHelper {

    /**
     * Finds all projects for specified user
     * @param int $user
     * @param int $project_id
     * @param boolean $alldata
     * @param boolean $showHidden
     * @return array
     */
	function findAllActivity($user, $project_id="", $alldata=false, $showHidden=false) {
		$result = array();
		$mdb2 = getConnection();
    	 
    	
    	$project_tables = "";
    	$project_cond = "";
    	if ($project_id) {
    		$project_tables = ", activity_bind";
    		$project_cond = " and a_id=ab_id_a and ab_id_p=".$project_id;
    	}
		if ($user->isManager() || $user->isCoManager() ) {  //
			if ($alldata) {
				$sel_str = "select a.a_id, a.a_name, a.a_code, a.a_timestamp, a.a_manager_id, a.a_status";
			} else {
				$sel_str = "select a.a_id, a.a_name, a.a_code, a.a_manager_id";
			}
			
			$sel_str .= " from activities a $project_tables
				where a.a_manager_id = ". $user->getOwnerId() . $project_cond;
			if (!$showHidden) $sel_str .= " and a.a_status=1";
			$sel_str .= " order by a.a_code, a.a_name";
  		} else {
    		$sel_str = "select DISTINCT a_id, a_name, a_code, a_timestamp, a_manager_id, a_status
				FROM tt_user_project_binds, activity_bind, activities
				where ab_id_p=project_id and ab_id_a=a_id and
				user_id = ".$user->getUserId()." and status=1 ".$project_cond;
    		if (!$showHidden) $sel_str .= " and a_status=1";
    		$sel_str .= " order by a_name";
  		}

  		 //echo $sel_str;
		//$db->setFetchMode(DB_FETCHMODE_ASSOC);
  		//$sth = $db->prepare($sel_str);
  		//$rc = $db->execute($sth);
  		$actIds = array();
		
		   //echo $sel_str ."                         ";
		 $res = $mdb2->query($sel_str);
		 
		 //echo is_a($res, 'PEAR_Error');
   // if (!is_a($res, 'PEAR_Error')) {
		$pCount = ttProjectHelper::findAllProjectsCount($user);
		//echo $pCount ;
      while ($val = $res->fetchRow()) {
                $actIds[] = $val["a_id"];
    		  //echo  $val["a_id"];
      			$result[] = $val;
      }
             //  foreach($result as $v)
				//$str .= ', '.$v[0];
				// echo $str ;
	      		//echo implode("','",$actIds);
      		$result = mu_sort($result,"a_code");
      	 
      		if ($user->isManager() || $user->isCoManager() )    { //
				 // echo 'aaaaaaaa';
				$aprojects = ActivityHelper::findProjectsBinded($actIds);
			} else {
			  //echo 'aaaaaaaa';
				$aprojects = ActivityHelper::findProjectsBinded($actIds, $user->getProjects());
			}
			 
      		foreach ($result as $k=>$v) {
      			$result[$k]["aprojects"] = array();
      			if ($aprojects)
	      			foreach ($aprojects as $p) {
	      				if ($v["a_id"]==$p["ab_id_a"]) $result[$k]["aprojects"][] = $p;
	      			}
      			$result[$k]["aprojects_all"] = ($pCount==count($result[$k]["aprojects"]));
      		}
	//
			
  		/*if (DB::isError($rc) == 0) {
  			$pCount = ProjectHelper::findAllProjectsCount($user);
  			
    		while ($val = $rc->fetchRow()) {
    			$actIds[] = $val["a_id"];
    		 
      			$result[] = $val;
      		}
      		
      		$result = mu_sort($result,"a_code");
      		
      		if ($user->isManager() || $user->isCoManager()) {
				$aprojects = ActivityHelper::findProjectsBinded($actIds);
			} else {
				$aprojects = ActivityHelper::findProjectsBinded($actIds, $user->getProjects());
			}
			
      		foreach ($result as $k=>$v) {
      			$result[$k]["aprojects"] = array();
      			if ($aprojects)
	      			foreach ($aprojects as $p) {
	      				if ($v["a_id"]==$p["ab_id_a"]) $result[$k]["aprojects"][] = $p;
	      			}
      			$result[$k]["aprojects_all"] = ($pCount==count($result[$k]["aprojects"]));
      		}
  		}*/
  		/*echo "$sel_str<PRE>";
		print_r($result);
		echo "</PRE>";*/
		 
		
  		return $result;
	}

        /**
         * Finds activity data by ID
         * @param int $user_id
         * @param int $act_id
         * @return array
         */
	function findActivityById($user_id, $act_id) {
	   $mdb2 = getConnection();
    		
	  $sql = "select a.a_id, a.a_name, a.a_code, a.a_project_id 
                from activities a, tt_users u
                where u.id=a.a_manager_id and u.id=$user_id and a.a_id = $act_id" ;
				
				 $res = $mdb2->query($sql);
	  // echo  $res->numRows()  ;
	  $val = $res->fetchRow();
 
	  
    		 
		    if ($val['a_id'] != '') {
		    	$val["aprojects"] = ActivityHelper::findProjectsBinded($act_id);
      			return $val;
    		} else {
      			return false;
    		}
	 
	  return false;
    }
    
        /**
         * Finds activity data by name
         * @param int $user_id
         * @param string $act_name
         * @return array 
         */
    function findActivityByName($user_id, $act_name) {
     $mdb2 = getConnection();
    		
	  $sql =  "select a.a_id, a.a_name, a.a_code, a.a_project_id 
                from activities a, tt_users u
                where u.id=a.a_manager_id and a.a_status=1 and u.id=$user_id and a.a_name = '$act_name'" ;
				
				//echo $sql;
	  $res = $mdb2->query($sql);
	  // echo  $res->numRows()  ;
	  $val = $res->fetchRow();
  	  
	  if($res->numRows()==0)
	  {
		 // echo 'false';
		  return false;
	  }
	
    		$val = $res->fetchRow();
		    if ($val['a_id'] != '') {
		    	$val["aprojects"] = ActivityHelper::findProjectsBinded($val['a_id']);
      			return $val;
    		} else {
      			return false;
    		}
	 
	  return false;
    }
	
    /**
     * Checks presence of activity for the set user
     * @param int $activity_id
     * @param User $user
     * @return boolean 
     */
	function isActivityExistsStrict($activity_id,$user) {
		$result = false;
		$db = DB::connect(DSN);
    	if (DB::isError($db))
    		return false;
    		
    	$user_id = $user->getManagerId();
    	if ($user->isManager()) $user_id = $user->getUserId();
    	
    	$sel_str = "select count(a.a_id) as actc
    			from activities a where a.a_id = $activity_id and a.a_manager_id=".$user_id." 
    			and a.a_status=1";
    	$db->setFetchMode(DB_FETCHMODE_ASSOC);
  		$sth = $db->prepare($sel_str);
  		$rc = $db->execute($sth);
  		if (DB::isError($rc) == 0) {
    		if ($val = $rc->fetchRow()) {
    			if ($val["actc"]>0) $result = true;
      		}
  		}
  		
  		return $result;
	}
	
        /**
         * Checks presence of activity
         * @param int $activity_id
         * @return boolean 
         */
	function isActivityExists($activity_id) {
		$db = DB::connect(DSN);
    	if (DB::isError($db))
    		return false;
    		
    	$sel_str = "select count(a.a_id) from activities a where a.a_id = $activity_id and a.a_status = 1";
  		$sth = $db->prepare($sel_str);
  		$rc = $db->execute($sth);

  		if (DB::isError($rc) == 0) {
    		$val = $rc->fetchRow();

    		if ($val[0] > 0) {
      			return true;
    		} else {
      			return false;
    		}
  		}
  		return false;
	}
	
        /**
         * Searches for a hidden Activity ID
         * @return int 
         */
	function getHiddenActivity() {
		 $mdb2 = getConnection();

  		$sql =  "select asl_id from activity_status_list where asl_hidden = 1" ;
  		$res = $mdb2->query($sql);
//echo $res->numRows();
  		if ($res->numRows()>0) {
    		$val = $res->fetchRow();
			//echo 'd'.$val['asl_id'];
    		if ($val['asl_id']) {
				
      			return $val['asl_id'];
    		} else {
      			return false;
    		}
  		}
    	return false;
  	}
  	
        /**
         * Finds all projects bound to $activity_id
         * and present in $projects_cs_list list
         * @param int $activity_id
         * @param array $projects_cs_list
         * @return array 
         */
  	function findProjectsBinded($activity_id, $projects_cs_list=null) {
  		$mdb2 = getConnection();
		
    	 
 
    	$result = array();
		
		 
    	if (is_array($activity_id) && count($activity_id)==0)
		{
			return false;
		}
    	 
    	if (is_array($activity_id) && count($activity_id)>0) {
			
    		$sel_str = " select tt_projects.id as p_id, tt_projects.name  as p_name,
						ab_id_p, ab_id_a from activity_bind, tt_projects where tt_projects.id=ab_id_p 
						and tt_projects.status=1 and ab_id_a  in (".join(",",$activity_id).")";
    	} else {
			//echo "1";
			
    		$sel_str = " select tt_projects.id as p_id, tt_projects.name  as p_name,
						 ab_id_p, ab_id_a from activity_bind, tt_projects where tt_projects.id=ab_id_p 
						 and tt_projects.status=1 and    ab_id_a = ".$activity_id;
    	}
    	if (!is_null($projects_cs_list)) {
    		$arr = array();
    		foreach ($projects_cs_list as $p) {
				
    			$arr[] = $p["p_id"];
    		}
    		$sel_str .= " and tt_projects.id  in (".join(",",$arr).")";
    	}
    	 //echo count($activity_id).  $sel_str;
  		  $res = $mdb2->query($sel_str);
  		 if( $res->numRows() ==0)
		 {
			 return false;
		 }
  		 
  			while ($val = $res->fetchRow()) {
   				$result[] = $val;
				//echo $result["p_id"];
  			}
  			return $result;
 		 
    	return false;
  	}
  	
        /**
         * Finds all projects bound and owner is $manager_id
         * @param int $manager_id
         * @return array 
         */
  	function findProjectsBindedAll($manager_id) {
  		  $mdb2 = getConnection();

    	$result = array();
    	$db->setFetchMode(DB_FETCHMODE_ASSOC);
    	$sel_str = "select p_id, ab_id_a, ab_id_p
			from projects left join activity_bind on (ab_id_p=p_id)
			where p_status=1 and p_manager_id = $manager_id and ab_id_a is not null
			order by ab_id_p";
			
  		$res = $mdb2->query($sql);
  		 
  			while ($val = $res->fetchRow()) {
   				$result[] = $val;
  			}
  			return $result;
 		 
    	return false;
  	}

        /**
         * Binds activity to projects
         * @param int $activity_id
         * @param int $project_id
         * @return boolean
         */
  	function insertActivityBind($activity_id, $project_id) {
  		$db = DB::connect(DSN);
    	if (DB::isError($db))
    		return false;

    	$result = array();
    	$db->setFetchMode(DB_FETCHMODE_ASSOC);
    	$sql_str = "INSERT INTO activity_bind (ab_id_a, ab_id_p)
			VALUES($activity_id,$project_id)";
  		$sth = $db->prepare($sql_str);
  		$rc = $db->execute($sth);
  		return (DB::isError($rc) == 0);
  	}

        /**
         * Stores Activity data into database. Returns stored entity ID.
         * @param int $user_id
         * @param string $activity_name
         * @param array $aprojects
         * @return int
         */
  	function insert($user_id, $activity_name, $activity_code, $aprojects) {
  	
	
	 $mdb2 = getConnection();
			
  		//if (!isset($project_id) || $project_id=="") $project_id = 0;
		
		
  		$sql ="insert into activities (a_manager_id, a_name, a_code)  
		values(". $mdb2->quote(trim($user_id)). ",". $mdb2->quote(trim( $activity_name)). ", ".$mdb2->quote(trim($activity_code)).")";
  		//$data = pear_db_quote($db, array($activity_name, $activity_code));
  		 $affected = $mdb2->exec($sql);
  		if ( $affected >0) {
    		$sql1 =  "SELECT LAST_INSERT_ID() AS `last_id`" ;
		 $res = $mdb2->query($sql1);
         $val = $res->fetchRow();
			if(!isset($val['last_id']) OR $val['last_id']=='')
				$lastid = $val[0];
			else
				$lastid = $val['last_id'];
			
			if (is_array($aprojects) && count($aprojects)>0)
   			foreach ($aprojects as $p_id) {
   				$sql2 =  "insert into activity_bind (ab_id_p, ab_id_a) values(".$p_id.",".$lastid.")" ;
				$affected = $mdb2->exec($sql2);
			}
			
			return $lastid;
  		}
		return false;
  	}

        /**
         * Updates Activity data in database.
         * @param int $fields
         * @return boolean 
         */
  	function update($fields)
    {
  		  $mdb2 = getConnection();
    
    		
      $user_id = $fields['user_id'];
      $activity_id = $fields['activity_id'];
      $activity_name = $fields['activity_name'];
	  $activity_code = $fields['activity_code'];
      $aprojects = &$fields['aprojects'];
		
  		$hidden_act = ActivityHelper::getHiddenActivity();
		//echo "s".$hidden_act;
  		if ($hidden_act) {
			
    		$sql ="update activities set a_name =  ".$mdb2->quote(trim( $activity_name)).", a_code = ".$mdb2->quote(trim( $activity_code)).",a_project_id=0 where a_id = ".$mdb2->quote(trim( $activity_id))." and a_manager_id = ".$mdb2->quote(trim( $user_id))."" ;
			
			//echo $sql;
			$affected = $mdb2->exec($sql);
    		 
    		// echo $affected;
    		if ($affected >=0) {
    			$sql2 =   "delete from activity_bind where ab_id_a=".$activity_id ;
    			$affected = $mdb2->exec($sql2);
    			
    			if (count($aprojects)>0)
	   			foreach ($aprojects as $p_id) {
	   				$sql3 =  "insert into activity_bind (ab_id_p, ab_id_a) values(".$p_id.",".$activity_id.")" ;
    				$affected = $mdb2->exec($sql3);
    			}
      			return true;
    		}
  		}
      	return false;
	}

        /**
         * Deletes activity in database
         * @param int $user_id
         * @param int $activity_id
         * @return boolean 
         */
	function delete($user_id, $activity_id) {
		  $mdb2 = getConnection();

  		$hidden_act = ActivityHelper::getHiddenActivity();
  		if ($hidden_act) {
    		$sql =  "update activities set a_status = $hidden_act where a_id = $activity_id and a_manager_id = $user_id" ;
    		$affected = $mdb2->exec($sql);
    		if ($affected >0) {
      			return true;
    		}
	    }
    	return false;
	}

}
?>