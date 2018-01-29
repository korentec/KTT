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
	import('form.ActionForm');
	import('ttUserHelper');
	import('ttProjectHelper');
	import('ActivityHelper');
	import('form.check.Validator');

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
	$projects = ttProjectHelper::findAllProjects($user);
	if ($request->getMethod()=="POST") {
		$cl_name  = $request->getParameter('name');
		$cl_name  = trim($cl_name);
		$cl_code  = $request->getParameter('code');
		$cl_code  = trim($cl_code);
		//$cl_projects = $request->getAttribute("projects");
		$cl_projects = $_POST['projects'];
		//echo $cl_projects[0];
	} else {
		$bean = new ActionForm("activityBean", new Form('activityForm'), $request);
		if ($bean->getAttribute("f_project")) {
			$cl_projects[] = $bean->getAttribute("f_project");
		} else {
			if (is_array($projects))
			foreach ($projects as $p) $cl_projects[] = $p["p_id"];
		}
	}
	
	$form = new Form('activityForm');
	$form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"name","style"=>"width:250;","value"=>@$cl_name));
	$form->addInput(array("type"=>"text","maxlength"=>"3","name"=>"code","style"=>"width:250;","value"=>@$cl_code));
	$form->addInput(array("type"=>"checkboxgroup","name"=>"projects","layout"=>"H",
    	"data"=>$projects,"datakeys"=>array("p_id","p_name"),"value"=>@$cl_projects));
	$form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.add')));
	
	if ($request->getMethod()=="POST") {
		
		$validator = new Validator($cl_name);
		$validator->validateSpaceString();
		$validator->validateEmptyString();
		if (!$validator->isValid()) {
			$errors->add("name",$i18n->getKey("errors.wrong"),$i18n->getKey("form.activity.name"));	
		}
		
		if ($errors->isEmpty()) {
			$ulo = ActivityHelper::findActivityByName($user->getOwnerId(), $cl_name);
			/*echo "<PRE>";
			print_r($ulo);
			echo "</PRE>";*/
			if (!$ulo OR ($ulo['a_status']>1) ) {
				if (ActivityHelper::insert($user->getOwnerId(), $cl_name, $cl_code, $cl_projects)) {
					Header("Location: activities.php");
					exit();
				} else
					$errors->add("addact",$i18n->getKey("errors.activity_add"));
			} else {
				$errors->add("exact",$i18n->getKey("errors.activity_exist"));
			}
		}			
	} // post
	
	$smarty->assign_by_ref("errors", $errors);
    $smarty->assign("forms",array($form->getName()=>$form->toArray()));
    $smarty->assign("onload","onLoad=\"document.activityForm.name.focus()\"");
    $smarty->assign("userdet_string",ttUserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("title_page",$i18n->getKey("form.activity.add_title"));
  
		$smarty->assign("content_page_name","activity_add.tpl");
  	$smarty->display("index.tpl");
?>