<?php /* Smarty version Smarty-3.0.7, created on 2016-03-24 08:50:15
         compiled from "C:\wamp64\www\ktt/WEB-INF/templates\time.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2275256f3aa47ecbc32-46906639%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48bd6be0d760cbb64e2b25d48c39e6eec86f2431' => 
    array (
      0 => 'C:\\wamp64\\www\\ktt/WEB-INF/templates\\time.tpl',
      1 => 1456214625,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2275256f3aa47ecbc32-46906639',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'C:\wamp64\www\ktt\WEB-INF\lib\smarty\plugins\modifier.escape.php';
if (!is_callable('smarty_modifier_regex_replace')) include 'C:\wamp64\www\ktt\WEB-INF\lib\smarty\plugins\modifier.regex_replace.php';
if (!is_callable('smarty_function_cycle')) include 'C:\wamp64\www\ktt\WEB-INF\lib\smarty\plugins\function.cycle.php';
?><script>
// We need a few arrays to populate project and task dropdowns.
// When client selection changes, the project dropdown must be re-populated with only relevant projects.
// When project selection changes, the task dropdown must be repopulated similarly.
// Format:
// project_ids[143] = "325,370,390,400";  // Comma-separated list of project ids for client.
// project_names[325] = "Time Tracker";   // Project name.
// task_ids[325] = "100,101,302,303,304"; // Comma-separated list ot task ids for project.
// task_names[100] = "Coding";            // Task name.

// Prepare an array of project ids for clients.
project_ids = new Array();
var act = new unit();
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
// projects associated with a selected client (client id is passed here as id).    
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

// The formDisable function disables some fields depending on what we have in other fields.
function formDisable(formField) {
  formFieldValue = eval("document.timeRecordForm." + formField + ".value");
  formFieldName = eval("document.timeRecordForm." + formField + ".name");

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

function get_date() {
  var date = new Date();
  return date.strftime("%Y-%m-%d");
}

function get_time() {
  var date = new Date();
  return date.strftime("%H:%M");
}
</script>

<style>
.not_billable td {
  color: #ff6666;
}
</style>

<?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['open'];?>

<table cellspacing="4" cellpadding="0" border="0">
  <tr>
    <td valign="top">
      <table>
<?php if ($_smarty_tpl->getVariable('on_behalf_control')->value){?>
        <tr>
          <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['user'];?>
:</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['onBehalfUser']['control'];?>
</td>
        </tr>
<?php }?>
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
      </table>
    </td>
    <td valign="top">
      <table>
        <tr><td><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['date']['control'];?>
</td></tr>
      </table>
    </td>
  </tr>
</table>

<table>
  <tr>
    <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['note'];?>
:</td>
    <td align="left"><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['note']['control'];?>
</td>
  </tr>
  <tr>
    <td align="center" colspan="2"><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['btn_submit']['control'];?>
</td>
  </tr>
</table>

<table width="720">
<tr>
  <td valign="top">
    <?php if ($_smarty_tpl->getVariable('time_records')->value){?>
      <table border='0' cellpadding='3' cellspacing='1' width="100%">
      <tr>
<?php if (in_array('cl',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))){?>
        <td width="20%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['client'];?>
</td>
<?php }?>
<?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
        <td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['project'];?>
</td>
		<td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['th']['activity'];?>
</td>
		<td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['th']['location'];?>
</td>
<?php }?>
<?php if ((@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
        <td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['task'];?>
</td>
<?php }?>
<?php if (((@TYPE_START_FINISH==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?>
        <td width="5%" class="tableHeader" align='right'><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['start'];?>
</td>
        <td width="5%" class="tableHeader" align='right'><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['finish'];?>
</td>
<?php }?>
        <td width="5%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['duration'];?>
</td>
        <td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['note'];?>
</td>
        <td width="5%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['edit'];?>
</td>
      </tr>
      <?php  $_smarty_tpl->tpl_vars['record'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('time_records')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['record']->key => $_smarty_tpl->tpl_vars['record']->value){
?>
      <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#f5f5f5,#ccccce"),$_smarty_tpl);?>
" <?php if (!$_smarty_tpl->tpl_vars['record']->value['billable']){?> class="not_billable" <?php }?>>
<?php if (in_array('cl',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))){?>
        <td valign='top'><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['record']->value['client'],'html');?>
</td>
<?php }?>
<?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
        <td valign='top'><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['record']->value['project'],'html');?>
</td>
		 <td valign='top'><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['record']->value['a_name'],'html');?>
</td>
		  <td valign='top'><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['record']->value['l_name'],'html');?>
</td>
<?php }?>
<?php if ((@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
        <td valign='top'><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['record']->value['task'],'html');?>
</td>
<?php }?>
<?php if (((@TYPE_START_FINISH==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?>
        <td nowrap align='right' valign='top'><?php if ($_smarty_tpl->tpl_vars['record']->value['start']){?><?php echo $_smarty_tpl->tpl_vars['record']->value['start'];?>
<?php }else{ ?>&nbsp;<?php }?></td>
        <td nowrap align='right' valign='top'><?php if ($_smarty_tpl->tpl_vars['record']->value['finish']){?><?php echo $_smarty_tpl->tpl_vars['record']->value['finish'];?>
<?php }else{ ?>&nbsp;<?php }?></td>
<?php }?>
        <td align='right' valign='top'><?php if ($_smarty_tpl->tpl_vars['record']->value['duration']!='0:00'){?><?php echo $_smarty_tpl->tpl_vars['record']->value['duration'];?>
<?php }else{ ?><font color="#ff0000"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['uncompleted'];?>
</font><?php }?></td>
        <td valign='top'><?php if ($_smarty_tpl->tpl_vars['record']->value['comment']){?><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['record']->value['comment'],'html');?>
<?php }else{ ?>&nbsp;<?php }?></td>
        <td valign='top' align='center'>
        <?php if ($_smarty_tpl->tpl_vars['record']->value['invoice_id']){?>
          &nbsp;
        <?php }else{ ?>
          <a href='time_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['record']->value['id'];?>
'><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['edit'];?>
</a>
          <?php if ($_smarty_tpl->tpl_vars['record']->value['duration']=='0:00'){?>
          <input type='hidden' name='record_id' value='<?php echo $_smarty_tpl->tpl_vars['record']->value['id'];?>
'>
          <input type='hidden' name='browser_date' value=''>
          <input type='hidden' name='browser_time' value=''>
          <input type='submit' id='btn_stop' name='btn_stop' onclick='browser_date.value=get_date();browser_time.value=get_time()' value='<?php echo $_smarty_tpl->getVariable('i18n')->value['button']['stop'];?>
'>
          <?php }?>          
        <?php }?>
        </td>
      </tr>
      <?php }} ?>
	  </table>
    <?php }?>
  </td>
</tr>
</table>
<?php if ($_smarty_tpl->getVariable('time_records')->value){?>
<table cellpadding="3" cellspacing="1" width="720">
  <tr>
    <td align="left"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['week_total'];?>
: <?php echo $_smarty_tpl->getVariable('week_total')->value;?>
</td>
    <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['day_total'];?>
: <?php echo $_smarty_tpl->getVariable('day_total')->value;?>
</td>
  </tr>
</table>
<?php }?>
<?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['close'];?>



