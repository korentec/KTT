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

class ttUser {
  var $login = null;        // User login.
  var $name = null;         // User name.
  var $id = null;           // User id.
  var $team_id = null;      // Team id.
  var $ManagerId = null;      // Team id.
  var $att_id = null;       //User id in ATT clock
  
  var $mBehalfName;
  
  
  var $role = null;			// User role (user, client, comanager, manager, admin).
  var $client_id = null;	// Client id for client user role.
  var $behalf_id = null;    // User id, on behalf of whom we are working.
  var $behalf_name = null;  // User name, on behalf of whom we are working.
   var $mBehalfProjects = null;
  var $email = null;        // User email.
  var $lang = null;         // Language.
  var $decimal_mark = null; // Decimal separator.
  var $date_format = null;  // Date format.
  var $time_format = null;  // Time format.
  var $week_start = 0;      // Week start day.
  var $tracking_mode = 0;   // Tracking mode.
  var $record_type = 0;     // Record type (duration vs start and finish, or both).
  var $currency = null;     // Currency.
  var $plugins = null;      // Comma-separated list of enabled plugins.
  var $team = null;	        // Team name.
  var $custom_logo = 0;     // Whether to use a custom logo for team.
  var $address = null;		// Address for invoices.
  var $lock_interval = 0;	// Lock interval in days for time records.
  var $rights = 0;          // A mask of user rights.
  

  // Constructor.
  function ttUser($login, $id = null) {
  	if (!$login && !$id) {
      // nothing to initialize
  	  return;
  	}
  	
    $mdb2 = getConnection();
    
    $sql = "SELECT u.id, u.login, u.name, u.team_id, u.role, u.client_id, u.email, u.att_id, t.name as team_name, 
      t.address, t.currency, t.locktime, t.lang, t.decimal_mark, t.date_format, t.time_format, t.week_start, t.tracking_mode, t.record_type, t.plugins, t.custom_logo
      FROM tt_users u LEFT JOIN tt_teams t ON (u.team_id = t.id) WHERE ";
  	if ($id)
  	  $sql .= "u.id = $id";
    else
  	  $sql .= "u.login = ".$mdb2->quote($login);
  	$sql .= " AND u.status = 1";
  	  	    	
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      return;
      //die($res->getMessage());
    }

    $val = $res->fetchRow();
    if ($val['id'] > 0) {
      $this->login = $val['login'];
      $this->name = $val['name'];
      $this->id = $val['id'];
	  //echo $val['team_id'];
	  $this->team_id = $val['team_id'];
	 // echo $this->team_id ;
	   $this->ManagerId = $val['team_id'];
	  @$_SESSION[$this->_sessionName]["team_id"]=$this->team_id ;
      $this->role = $val['role'];
      $this->client_id = $val['client_id'];
      $this->email = $val['email'];
      $this->lang = $val['lang'];
      $this->decimal_mark = $val['decimal_mark'];
      $this->date_format = $val['date_format'];
      $this->time_format = $val['time_format'];
      $this->week_start = $val['week_start'];
      $this->tracking_mode = $val['tracking_mode'];
      $this->record_type = $val['record_type'];
      $this->team = $val['team_name'];
      $this->address = $val['address'];
      $this->currency = $val['currency'];
      $this->plugins = $val['plugins'];
      $this->custom_logo = $val['custom_logo'];
      $this->lock_interval = $val['locktime'];
      $this->att_id = $val['att_id'];
      
      // Set "on behalf" id and name.
      if (isset($_SESSION['behalf_id'])) {
          $this->behalf_id = $_SESSION['behalf_id'];
          $this->behalf_name = $_SESSION['behalf_name'];
      }
        if (isset($_SESSION[$this->_sessionName]["behalfprojects"]))
          $this->mBehalfProjects = $_SESSION[$this->_sessionName]["behalfprojects"];
      // Set user rights.
      if ($this->role == ROLE_USER) {
      	$this->rights = right_data_entry|right_view_charts|right_view_reports;
      } else if ($this->role == ROLE_CLIENT) {
      	$this->rights = right_view_reports|right_view_invoices; // TODO: how about right_view_charts, too?
      } else if ($this->role == ROLE_COMANAGER) {
      	$this->rights = right_data_entry|right_view_charts|right_view_reports|right_view_invoices|right_manage_team;
      } else if ($this->role == ROLE_MANAGER) {
      	$this->rights = right_data_entry|right_view_charts|right_view_reports|right_view_invoices|right_manage_team|right_assign_roles|right_export_team;
      } else if ($this->role == ROLE_SITE_ADMIN) {
      	$this->rights = right_administer_site;
      }
    }
  }
  
  
  function getAttribute($id)
  {
	  
	  $mdb2 = getConnection();
    
    $sql = "SELECT u.id, u.login, u.name, u.team_id, u.role, u.client_id, u.email, u.att_id, t.name as team_name, 
      t.address, t.currency, t.locktime, t.lang, t.decimal_mark, t.date_format, t.time_format, t.week_start, t.tracking_mode, t.record_type, t.plugins, t.custom_logo
      FROM tt_users u LEFT JOIN tt_teams t ON (u.team_id = t.id) WHERE ";
  	if ($id)
  	  $sql .= "u.id = $id";
    else
  	  $sql .= "u.login = ".$mdb2->quote($login);
  	$sql .= " AND u.status = 1";
  	  	    	
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      return;
      //die($res->getMessage());
    }

    $val = $res->fetchRow();
	 
    if ($val['id'] > 0) {
      $this->login = $val['login'];
      $this->name = $val['name'];
      $this->id = $val['id'];
      $this->att_id = $val['átt_id'];
	  //echo $val['team_id'];
	  $this->team_id = $val['team_id'];
	  
	   $this->ManagerId = $val['team_id'];
	  @$_SESSION[$this->_sessionName]["team_id"]=$this->team_id ;
      $this->role = $val['role'];
      $this->client_id = $val['client_id'];
      $this->email = $val['email'];
      $this->lang = $val['lang'];
      $this->decimal_mark = $val['decimal_mark'];
      $this->date_format = $val['date_format'];
      $this->time_format = $val['time_format'];
      $this->week_start = $val['week_start'];
      $this->tracking_mode = $val['tracking_mode'];
      $this->record_type = $val['record_type'];
      $this->team = $val['team_name'];
      $this->address = $val['address'];
      $this->currency = $val['currency'];
      $this->plugins = $val['plugins'];
      $this->custom_logo = $val['custom_logo'];
      $this->lock_interval = $val['locktime'];
      
      // Set "on behalf" id and name.
      if (isset($_SESSION['behalf_id'])) {
          $this->behalf_id = $_SESSION['behalf_id'];
          $this->behalf_name = $_SESSION['behalf_name'];
      }
        if (isset($_SESSION[$this->_sessionName]["behalfprojects"]))
          $this->mBehalfProjects = $_SESSION[$this->_sessionName]["behalfprojects"];
      // Set user rights.
      if ($this->role == ROLE_USER) {
      	$this->rights = right_data_entry|right_view_charts|right_view_reports;
      } else if ($this->role == ROLE_CLIENT) {
      	$this->rights = right_view_reports|right_view_invoices; // TODO: how about right_view_charts, too?
      } else if ($this->role == ROLE_COMANAGER) {
      	$this->rights = right_data_entry|right_view_charts|right_view_reports|right_view_invoices|right_manage_team;
      } else if ($this->role == ROLE_MANAGER) {
      	$this->rights = right_data_entry|right_view_charts|right_view_reports|right_view_invoices|right_manage_team|right_assign_roles|right_export_team;
      } else if ($this->role == ROLE_SITE_ADMIN) {
      	$this->rights = right_administer_site;
      }
    } 
  }
  // The getActiveUser returns user id on behalf of whom current user is operating.
  function getActiveUser() {
    return ($this->behalf_id ? $this->behalf_id : $this->id);
  }
  
  function getUserAttId()
  {
      return $this->att_id;
  }
  
    function getBehalfName() { return $this->behalf_name; }

        /**
         *
         * @param String $name
         */
  function setBehalfName($name) { $this->behalf_name = $name; }
  
  
  // isAdmin - determines whether current user is admin (has right_administer_site).
  function isAdmin() {
    return (right_administer_site & $this->role);
  }

  // isManager - determines whether current user is team manager.
  function isManager() {
    return (ROLE_MANAGER == $this->role);
  }

  // isCoManager - determines whether current user is team comanager.
  function isCoManager() {
    return (ROLE_COMANAGER == $this->role);
  }
  
  // isClient - determines whether current user is a client.
  function isClient() {
    return (ROLE_CLIENT == $this->role);
  }
  
  // canManageTeam - determines whether current user is manager or co-manager.
  function canManageTeam() {
    return (right_manage_team & $this->role);
  }
   function getUserId() {
    return $this->id;
  }
  
  function getUserName() {
    return $this->name;
  }
  
      function getBehalfId() { return $this->behalf_id; }
	  
	  
  // getAssignedProjects - returns an array of assigned projects.
  function getAssignedProjects()
  {
    $result = array();
    $mdb2 = getConnection();
    
    // Do a query with inner join to get assigned projects.
    $sql = "select p.id, p.name, p.description, p.tasks, upb.rate from tt_projects p
      inner join tt_user_project_binds upb on (upb.user_id = ".$this->getActiveUser()." and upb.project_id = p.id and upb.status = 1)
      where p.team_id = $this->team_id and p.status = 1 order by p.name";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }
  
  // getAttInReports - returns an array of start time reports from att.
  function getAttInReports($date)
  {
      $in_out = 0;
      return $this->getAttReports($date, $in_out); 
  }
  // getAttInReports - returns an array of start time reports from att.
  function getAttOutReports($date)
  {
      $in_out = 1;
      return $this->getAttReports($date, $in_out); 
  }
  
  private function getAttReports($date, $in_out)
  {
    $result = array();
    $mdb2 = getConnection();
    
    // Do a query with inner join to get assigned projects.
    $sql = "SELECT TIME_FORMAT(time, '%k:%i') as time, archived".
          " FROM att_log".
          " WHERE att_id=".$this->att_id.
          " AND in_out=".$in_out.
          " AND date=".$mdb2->quote($date).
          " ORDER BY date";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = (object) [
          "time" => $val[time],
          "archived" => $val["archived"]
        ];
      }
    }

    return $result;
  }
   
  
    function getProjects() {
    if ($this->mBehalfId>0) {
      return ($this->mBehalfProjects?$this->mBehalfProjects:array());
    } else {
      if (!$this->isManager())
		// echo "ID--". $this->id.",". $this->getOwnerId();
        $this->mProjects = ttUserHelper::findProjectsBinded($this->id, $this->getOwnerId(), true);
      return ($this->mProjects?$this->mProjects:array());
    }
  }
   function getManagerId() {    
    //echo 'ap'.$this->ManagerId;
  return $this->team_id; 
  }
  
  function getOwnerId() {
    if ($this->isManager()) {
      return $this->getUserId();
     } elseif ($this->isCoManager()) {
      return $this->getManagerId();
    } else {
      return $this->getManagerId();
    }
  }
  

}
?>