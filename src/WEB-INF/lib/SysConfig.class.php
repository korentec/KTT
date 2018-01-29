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

// $Id: SysConfig.class.php,v 1.0 2005/07/08 16:08:21 dries Exp $


define("SYSC_LOCK_DATE", "lock_date");
define("SYSC_LOCK_DAYS", "lock_days");
define("SYSC_CHART_PERIOD", "chart_show_period");

/**
 * Class SysConfig as a system repository for storage of pairs name-value
 * @package TimeTracker
 */
class SysConfig {
	
	var $mCurrUser	= null;
	var $db			= null;

    /**
     * Constructor
     * @param User $user
     */
	function SysConfig(&$user) {
		$this->mCurrUser = &$user;
		$this->db = getConnection();
}

        /**
         * Returns value by name
         * @param string $name
         * @return string
         */
	function getValue($name) {
	  $sth = $this->db->prepare("select sysc_value from sysconfig where sysc_id_u=".pear_db_quote($this->db, $this->mCurrUser->getUserId())." and sysc_name=".pear_db_quote($this->db, $name));
	  $this->db->setFetchMode(DB_FETCHMODE_ASSOC);
  	  $rc = $this->db->execute($sth);
	  if (DB::isError($rc) == 0) {
    	$val = $rc->fetchRow();
    	return $val['sysc_value'];
	  }
	  return false;
	}
	
        /**
         * Returns date value by name
         * @param string $name
         * @return DateAndTime 
         */
	function getValueAsDate($name) {
		if ($val = $this->getValue($name)) {
			import('DateAndTime');
			return new DateAndTime(DB_DATEFORMAT, $val);
		}
		return false;
	}

        /**
         * Sets value by name
         * @param string $name
         * @param string $value
         * @return boolean
         */
	function setValue($name, $value) {
	  $rcnt = 0;
	  $sth = $this->db->prepare("select count(sysc_id) as rcnt from sysconfig where sysc_id_u=".pear_db_quote($this->db, $this->mCurrUser->getUserId())." and sysc_name=".pear_db_quote($this->db, $name));
	  $this->db->setFetchMode(DB_FETCHMODE_ASSOC);
  	  $rc = $this->db->execute($sth);
	  if ($val = $rc->fetchRow()) $rcnt = $val['rcnt'];

	  if ($rcnt>0) {
      	$sth = $this->db->prepare("update sysconfig set sysc_value=".pear_db_quote($this->db, $value)." where sysc_id_u=".pear_db_quote($this->db, $this->mCurrUser->getUserId())." and sysc_name=".pear_db_quote($this->db, $name));
	  } else {
	  	$sth = $this->db->prepare("insert into sysconfig set sysc_value=".pear_db_quote($this->db, $value).", sysc_name=".pear_db_quote($this->db, $name).", sysc_id_u=".pear_db_quote($this->db, $this->mCurrUser->getUserId()));
	  }
	  $this->db->setFetchMode(DB_FETCHMODE_ASSOC);
  	  $rc = $this->db->execute($sth);
	  return (DB::isError($rc) == 0);
	}

        /**
         * Sets value as date by name
         * @param string $name
         * @param DateAndTime $date_time
         */
	function setValueAsDate($name, $date_time) {
		$this->setValue($name,$date_time->toString(DB_DATEFORMAT));
	}
}
?>
