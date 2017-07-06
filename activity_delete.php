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
	import('form.Form');
	import('ttUserHelper');
	import('ActivityHelper');

	if ($auth->isAuthenticated()) {
		$user = new ttUser($auth->getUserId());
		if ($user->isAdmin()) {
			Header("Location: admin.php");
			exit();
		}
	} else {
		Header("Location: login.php");
		exit();
	}
	$user->getAttribute($auth->getUserId());
	
	$cl_activity_id = (int)$request->getParameter('act_id');
	$ud = ActivityHelper::findActivityById($user->getOwnerId(), $cl_activity_id);
    $delstr_activity = $ud["a_name"];
	
	$form = new Form('activityForm');
    $form->addInput(array("type"=>"hidden","name"=>"act_id","value"=>$cl_activity_id));
	$form->addInput(array("type"=>"submit","name"=>"confirmation","value"=>$i18n->getKey('button.delete')));
	$form->addInput(array("type"=>"submit","name"=>"rejecting","value"=>$i18n->getKey('button.cancel')));
	
	if ($request->getMethod()=="POST") {
		if(ActivityHelper::findActivityById($user->getOwnerId(), $cl_activity_id)) {
			if ($request->getParameter('confirmation')) {
				if (ActivityHelper::delete($user->getOwnerId(), $cl_activity_id)) {
					header("Location: activities.php");
					exit();
				} else {
					$errors->add("delact",$i18n->getKey("errors.activity_nodel"));
				}
			}
		} else 
			$errors->add("noact",$i18n->getKey("errors.activity_notexists"));
			
		if ($request->getParameter('rejecting')) {
			header("Location: activities.php");
			exit();
		}
	} // post
	
	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign("delstr_activity", $delstr_activity);
    $smarty->assign("forms",array($form->getName()=>$form->toArray()));
    $smarty->assign("onload","onLoad=\"document.activityForm.rejecting.focus()\"");
    $smarty->assign("userdet_string",ttUserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("title_page",$i18n->getKey("form.activity.del_str"));
  	if ($ud) {
    	$smarty->assign("content_page_name","activity_del.tpl");
    } else {
    	$smarty->assign("content_page_name","syserror.tpl");
    }
   $smarty->display("index.tpl");
?>