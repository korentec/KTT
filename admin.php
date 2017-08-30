<?php
// +----------------------------------------------------------------------+
// | WR Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 WR Consulting (http://wrconsulting.com)
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
// | Contributors: Igor Melnik <igor@rivne.com>
// +----------------------------------------------------------------------+

	require_once('initialize.php');

	if ($auth->isAuthenticated()) {
		$user = new User($auth->getUserId());
		if (!$user->isAdministrator()) {
			Header("Location: mytime.php");
			exit();
		}
	} else {
		Header("Location: login.php");
		exit();
	}
	

    $smarty->assign("title_page",$i18n->getKey("form.admin.title"));
  	$smarty->assign("content_page_name","admin.tpl");
  	$smarty->display(INDEX_TEMPLATE);
?>