<?php /* Smarty version Smarty-3.0.7, created on 2016-03-27 04:46:00
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/time_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:44052001356f7abd8b1d543-70376293%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e60295b6e2d800992cc10a12bd7943b783d731d6' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/time_edit.tpl',
      1 => 1456215780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44052001356f7abd8b1d543-70376293',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_regex_replace')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/modifier.regex_replace.php';
?><script>
// We need a few arrays to populate project and task dropdowns.
// When client selection changes, the project dropdown must be re-populated with only relevant projects.
// When project selection changes, the task dropdown must be repopulated similarly.
// Format:
// project_ids[143] = "325,370,390,400";  // Comma-separated list of project ids for client.
// project_names[325] = "Time Tracker";   // Project name.
// task_ids[325] = "100,101,302,303,304"; // Comma-separated list ot task ids for project.
// task_names[100] = "Coding";            // Task name.

//Prepare an array of projects ids for clients.
project_ids = new Array();
<?php  $_smarty_tpl->tpl_vars['client'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('client_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['client']->key => $_smarty_tpl->tpl_vars['client']->value){
?>
  project_ids[<?php echo $_smarty_tpl->tpl_vars['client']->value['id'];?>
] = "<?php echo $_smarty_tpl->tpl_vars['client']->value['projects'];?>
";
<?php }} ?>
// Prepare an array of project names.
project_names = new Array();
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('project_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
  project_names[<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
] = "<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['project']->value['name'],'javascript');?>
";
<?php }} ?>
// We'll use this array to populate project dropdown when client is not selected.
var idx = 0;
projects = new Array();
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('project_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
  projects[idx] = new Array("<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
", "<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['project']->value['name'],'javascript');?>
");
  idx++;
<?php }} ?>

 var act = new unit();
 
function unit(sId,projects,sName) {
		this.id = sId;
		this.parentid = projects;
		this.name = sName;
	    this.cnt = -1;
	    this.collect = new Array();
		this.append = appendUnit;
	}

	function appendUnit(sId,projects,sName) {
		this.cnt++;
		t = new unit(sId,projects,sName);
		this.collect[this.cnt] = t;
	}


	var empty_label = '<?php echo smarty_modifier_regex_replace($_smarty_tpl->getVariable('i18n')->value['controls']['select']['activity'],"/(\&rsquo;)/","\'");?>
';

    <?php if ($_smarty_tpl->getVariable('activity_list')->value){?>
    <?php  $_smarty_tpl->tpl_vars['activity'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('activity_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['activity']->key => $_smarty_tpl->tpl_vars['activity']->value){
?>
    	projects = new Array();
    	<?php if ($_smarty_tpl->tpl_vars['activity']->value['aprojects']){?>
    	<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['activity']->value['aprojects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
    	projects.push(<?php echo $_smarty_tpl->tpl_vars['project']->value['p_id'];?>
);
    	<?php }} ?>
    	<?php }?>
	act.append(<?php echo $_smarty_tpl->tpl_vars['activity']->value['a_id'];?>
,projects,'<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['activity']->value['a_name'],"quotes");?>
');
	<?php }} ?>
	<?php }?>
	
	
	

// Prepare an array of task ids for projects.
task_ids = new Array();
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('project_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
  task_ids[<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
] = "<?php echo $_smarty_tpl->tpl_vars['project']->value['tasks'];?>
";
<?php }} ?>
// Prepare an array of task names.
task_names = new Array();
<?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('task_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
  task_names[<?php echo $_smarty_tpl->tpl_vars['task']->value['id'];?>
] = "<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['task']->value['name'],'javascript');?>
";
<?php }} ?>

// Mandatory top options for project and task dropdowns.
empty_label_project = '<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('i18n')->value['dropdown']['select'],'javascript');?>
';
empty_label_task = '<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('i18n')->value['dropdown']['select'],'javascript');?>
';

// The populateDropdowns function populates the "project" and "task" dropdown controls
// with relevant values.
function fillDropdowns() {
  if(document.body.contains(document.timeRecordForm.client))
    fillProjectDropdown(document.timeRecordForm.client.value);

  fillTaskDropdown(document.timeRecordForm.project.value);
}
	
// The fillProjectDropdown function populates the project combo box with
// projects associated with a selected clientt (client id is passed here as id).
function fillProjectDropdown(id) {
  var str_ids = project_ids[id];

  var dropdown = document.getElementById("project");
  // Determine previously selected item.
  var selected_item = dropdown.options[dropdown.selectedIndex].value;

  // Remove existing content.
  dropdown.length = 0;
  var project_reset = true;
  // Add mandatory top option.
  dropdown.options[0] = new Option(empty_label_project, '', true);

  // Populate project dropdown.
  if (!id) {
    // If we are here, client is not selected.
	var len = projects.length;
    for (var i = 0; i < len; i++) {
      dropdown.options[i+1] = new Option(projects[i][1], projects[i][0]);
      if (dropdown.options[i+1].value == selected_item)  {
        dropdown.options[i+1].selected = true;
        project_reset = false;
      }
    }
  } else if (str_ids) {
    var ids = new Array();
    ids = str_ids.split(",");
    var len = ids.length;

    for (var i = 0; i < len; i++) {
      var p_id = ids[i];
      dropdown.options[i+1] = new Option(project_names[p_id], p_id);
      if (dropdown.options[i+1].value == selected_item)  {
        dropdown.options[i+1].selected = true;
        project_reset = false;
      }
    }
  }

  // If project selection was reset - clear the tasks dropdown.
  if (project_reset) {
    dropdown = document.getElementById("task");
    dropdown.length = 0;
    dropdown.options[0] = new Option(empty_label_task, '', true);
  }
}

// The fillTaskDropdown function populates the task combo box with
// tasks associated with a selected project (project id is passed here as id).
function fillTaskDropdown(id) {
  var str_ids = task_ids[id];

  var dropdown = document.getElementById("task");
  if (dropdown == null) return; // Nothing to do.
  
  // Determine previously selected item.
  var selected_item = dropdown.options[dropdown.selectedIndex].value;

  // Remove existing content.
  dropdown.length = 0;
  // Add mandatory top option.
  dropdown.options[0] = new Option(empty_label_task, '', true);

  // Populate the dropdown from the task_names array.
  if (str_ids) {
    var ids = new Array();
    ids = str_ids.split(",");
    var len = ids.length;

    var idx = 1;
    for (var i = 0; i < len; i++) {
      var t_id = ids[i];
      if (task_names[t_id]) {
        dropdown.options[idx] = new Option(task_names[t_id], t_id);
        idx++;
      }
    }

    // If a previously selected item is still in dropdown - select it.
    if (dropdown.options.length > 0) {
      for (var i = 0; i < dropdown.options.length; i++) {
        if (dropdown.options[i].value == selected_item)  {
          dropdown.options[i].selected = true;
        }
      }
    }
  }
}


function fillActivityDir() {
        var project_list = document.timeRecordForm.project;
        var project_list_item = project_list.options[project_list.selectedIndex].value;
        var activity_list = document.timeRecordForm.activity;
         var activity_list_item = activity_list.options[activity_list.selectedIndex].value;

      	clearOptions('activity');
       	fill(project_list_item,act,'activity');

       	if (activity_list.options.length > 0) {
	        for (var i = 0; i < activity_list.options.length; i++) {
	        	if (activity_list.options[i].value == activity_list_item)  {
	        		activity_list.options[i].selected = true;
	        	}
	        }
        }
         fillSubActivityDir();
    }
	
	
	  function fillSubActivityDir() {
        var activity_list = document.timeRecordForm.activity;
        var activity_list_item = activity_list.options[activity_list.selectedIndex].value;
        
         var x = eval("document.timeRecordForm.subactivity");
			//activity no. 7 is markting, at this moment only markting as sub activity      
         if(activity_list_item==7)
         {
  	   		x.disabled = false;
  	   	}
  	   	else
  	   	{
  	   		x.disabled = true;
  	   		x.value=null;	
  	   	}
    }
	
	
	    function clearOptions(formElement) {
        formObject = eval("document.timeRecordForm." + formElement);
        formObject.length = 0;
    }
	
	   function fill(parentId, list, formElement) {
      formObject = eval("document.timeRecordForm." + formElement);
      cnt = 0;
      formObject.options[cnt] = new Option(empty_label,'',true,false);
      cnt++;
      if (list.collect.length > 0) {
        for (var i = 0; i < list.collect.length; i++) {
        	finded = false;
        	for (var p = 0; p < list.collect[i].parentid.length; p++) {
        		if (parentId==list.collect[i].parentid[p]) finded = true;
        	}
            if (finded) {
              formObject.options[cnt] = new Option(list.collect[i].name,list.collect[i].id,true,false);
              cnt++;
            }
        }
      }
    }
	

// The formDisable function disables some fields depending on what we have in other fields.
function formDisable(formField) {
  var formFieldValue = eval("document.timeRecordForm." + formField + ".value");
  var formFieldName = eval("document.timeRecordForm." + formField + ".name");

  if (((formFieldValue != "") && (formFieldName == "start")) || ((formFieldValue != "") && (formFieldName == "finish"))) {
    var x = eval("document.timeRecordForm.duration");
    x.value = "";
    x.disabled = true;
    x.style.background = "#e9e9e9";
  }

  if (((formFieldValue == "") && (formFieldName == "start") && (document.timeRecordForm.finish.value == "")) || ((formFieldValue == "") && (formFieldName == "finish") && (document.timeRecordForm.start.value == ""))) {
    var x = eval("document.timeRecordForm.duration");
    x.value = "";
    x.disabled = false;
    x.style.background = "white";
  }

  if ((formFieldValue != "") && (formFieldName == "duration")) {
    var x = eval("document.timeRecordForm.start");
    x.value = "";
    x.disabled = true;
    x.style.background = "#e9e9e9";
    var x = eval("document.timeRecordForm.finish");
    x.value = "";
    x.disabled = true;
    x.style.background = "#e9e9e9";
  }

  if ((formFieldValue == "") && (formFieldName == "duration")) {
	var x = eval("document.timeRecordForm.start");
	x.disabled = false;
	x.style.background = "white";
	var x = eval("document.timeRecordForm.finish");
	x.disabled = false;
	x.style.background = "white";
  }
}

// The setNow function fills a given field with current time.
function setNow(formField) {
  var x = eval("document.timeRecordForm.start");
  x.disabled = false;
  x.style.background = "white";
  var x = eval("document.timeRecordForm.finish");
  x.disabled = false;
  x.style.background = "white";
  var today = new Date();
  var time_format = '<?php echo $_smarty_tpl->getVariable('user')->value->time_format;?>
';
  var obj = eval("document.timeRecordForm." + formField);
  obj.value = today.strftime(time_format);
  formDisable(formField);
}

   function initForm() {
    	fillActivityDir();
    	//fillSubActivityDir();
    }
</script>

<?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['open'];?>

<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table width = "100%">
  <tr>
  	<td valign="top">
    <table border="0">
<?php if (in_array('cl',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))){?>
    <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['client'];?>
<?php if (in_array('cm',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))){?> (*)<?php }?>:</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['client']['control'];?>
</td>
    </tr>
<?php }?>
<?php if (in_array('iv',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))){?>
    <tr>
      <td align="right">&nbsp;</td>
      <td><label><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['billable']['control'];?>
<?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['billable'];?>
</label></td>
    </tr>
<?php }?>
<?php if (($_smarty_tpl->getVariable('custom_fields')->value&&$_smarty_tpl->getVariable('custom_fields')->value->fields[0])){?> 
    <tr>
      <td align="right"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('custom_fields')->value->fields[0]['label'],'html');?>
<?php if ($_smarty_tpl->getVariable('custom_fields')->value->fields[0]['required']){?> (*)<?php }?>:</td><td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['cf_1']['control'];?>
</td>
    </tr>
<?php }?>
<?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
    <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['project'];?>
 (*):</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['project']['control'];?>
</td>
    </tr>
	
	
	  <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['activity'];?>
 (*):</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['activity']['control'];?>
</td>
    </tr>
   // <?php if (($_smarty_tpl->getVariable('user')->value->isManager())){?> //|| $user->isCoManager()
    //  <tr>
    //  <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['subactivity'];?>
 :</td>
    //  <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['subactivity']['control'];?>
</td>
   // </tr>
	 <?php }?>
	 <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['location'];?>
</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['location']['control'];?>
</td>
    </tr>
<?php }?>
<?php if ((@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
    <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['task'];?>
 (*):</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['task']['control'];?>
</td>
    </tr>
<?php }?>
<?php if (((@TYPE_START_FINISH==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?>
    <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['start'];?>
:</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['start']['control'];?>
&nbsp;<input onclick="setNow('start');" type="button" tabindex="-1" value="<?php echo $_smarty_tpl->getVariable('i18n')->value['button']['now'];?>
"></td>
    </tr>
    <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['finish'];?>
:</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['finish']['control'];?>
&nbsp;<input onclick="setNow('finish');" type="button" tabindex="-1" value="<?php echo $_smarty_tpl->getVariable('i18n')->value['button']['now'];?>
"></td>
    </tr>
<?php }?>
<?php if (((@TYPE_DURATION==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?>
    <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['duration'];?>
:</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['duration']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['duration_format'];?>
</td>
    </tr>
<?php }?>
    <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['date'];?>
:</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['date']['control'];?>
</td>
    </tr>
    <tr>
      <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['note'];?>
:</td>
      <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['note']['control'];?>
</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td align="left"><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['btn_save']['control'];?>
 <?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['btn_copy']['control'];?>
 <?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['btn_delete']['control'];?>
</td>
    </tr>
    </table>
    </td>
    </tr>
  </table>
  </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['close'];?>
