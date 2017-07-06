<?php /* Smarty version Smarty-3.0.7, created on 2016-02-18 16:14:29
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\reports.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1261456c5d1c57ad595-36364178%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2c024b0d763f47c1bf73279a7a370076166770b' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\reports.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1261456c5d1c57ad595-36364178',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs\WEB-INF\lib\smarty\plugins\modifier.escape.php';
?><script>
// We need a couple of array-like objects, one for associated task ids, another for task names.
// For performance, and because associated arrays are frowned upon in JavaScript, we'll use a simple object
// with properties for project tasks. Format:

// obj_tasks.p325 = "100,101,302,303,304"; // Tasks ids for project 325 are "100,101,302,303,304".
// obj_tasks.p408 = "100,302";  // Tasks ids for project 408 are "100,302".

// Create an object for task ids.
obj_tasks = {};
var project_prefix = "p"; // Prefix for project property.
var project_property;

// Populate obj_tasks with task ids for each relevant project.
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('project_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
  project_property = project_prefix + <?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
;
  obj_tasks[project_property] = "<?php echo $_smarty_tpl->tpl_vars['project']->value['tasks'];?>
";
<?php }} ?>

// Prepare an array of task names.
// Format: task_names[0] = Array(100, 'Coding'), task_names[1] = Array(302, 'Debugging'), etc...
// First element = task_id, second element = task name.
task_names = new Array();
var idx = 0;
<?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('task_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
  task_names[idx] = new Array(<?php echo $_smarty_tpl->tpl_vars['task']->value['id'];?>
, "<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['task']->value['name'],'javascript');?>
");
  idx++;
<?php }} ?>

	
// empty_label is the mandatory top option in the tasks dropdown.
empty_label = '<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('i18n')->value['dropdown']['all'],'javascript');?>
';

// inArray - determines whether needle is in haystack array.
function inArray(needle, haystack) {
  var length = haystack.length;
  for(var i = 0; i < length; i++) {
	if(haystack[i] == needle) return true;
  }
  return false;
}
	
// The fillTaskDropdown function populates the task combo box with
// tasks associated with a selected project_id.    
function fillTaskDropdown(project_id) {
  var str_task_ids;
  // Get a string of comma-separated task ids.
  if (project_id) {  
    var property = "p" + project_id;
    str_task_ids = obj_tasks[property];
  }
  if (str_task_ids) {
    var task_ids = new Array(); // Array of task ids.
    task_ids = str_task_ids.split(",");
  }
  
  var dropdown = document.getElementById("task");
  // Determine previously selected item.
  var selected_item = dropdown.options[dropdown.selectedIndex].value;
  
  // Remove existing content.
  dropdown.length = 0;
  // Add mandatory top option.
  dropdown.options[0] = new Option(empty_label, '', true);

  // Populate the dropdown with associated tasks.
  len = task_names.length;
  var dropdown_idx = 0;
  for (var i = 0; i < len; i++) {
    if (!project_id) {
      // No project is selected. Fill in all tasks.
      dropdown.options[dropdown_idx+1] = new Option(task_names[i][1], task_names[i][0]);
      dropdown_idx++;
    } else if (str_task_ids) {
      // Project is selected and has associated tasks. Fill them in.
      if (inArray(task_names[i][0], task_ids)) {
        dropdown.options[dropdown_idx+1] = new Option(task_names[i][1], task_names[i][0]);
        dropdown_idx++;
      }
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

// Build JavaScript array for assigned projects out of passed in PHP array.
var assigned_projects = new Array();
<?php if ($_smarty_tpl->getVariable('assigned_projects')->value){?>
  <?php  $_smarty_tpl->tpl_vars['projects'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['user_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('assigned_projects')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['projects']->key => $_smarty_tpl->tpl_vars['projects']->value){
 $_smarty_tpl->tpl_vars['user_id']->value = $_smarty_tpl->tpl_vars['projects']->key;
?>
    assigned_projects[<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
] = new Array();
	<?php if ($_smarty_tpl->tpl_vars['projects']->value){?>
	  <?php  $_smarty_tpl->tpl_vars['project_id'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['idx'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['projects']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project_id']->key => $_smarty_tpl->tpl_vars['project_id']->value){
 $_smarty_tpl->tpl_vars['idx']->value = $_smarty_tpl->tpl_vars['project_id']->key;
?>
	    assigned_projects[<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['idx']->value;?>
] = <?php echo $_smarty_tpl->tpl_vars['project_id']->value;?>
;
	  <?php }} ?>
    <?php }?>
  <?php }} ?>
<?php }?>
	
// selectAssignedUsers is called when a project is changed in project dropdown.
// It selects users on the form who are assigned to this project.
function selectAssignedUsers(project_id) {
  var user_id;
  var len;

  for (var i = 0; i < document.reportForm.elements.length; i++) {
    if ((document.reportForm.elements[i].type == 'checkbox') && (document.reportForm.elements[i].name == 'users[]')) {
      user_id = document.reportForm.elements[i].value;
      if (project_id)
        document.reportForm.elements[i].checked = false;
      else
        document.reportForm.elements[i].checked = true;

      if(assigned_projects[user_id] != undefined)
        len = assigned_projects[user_id].length;
      else
        len = 0;

      if (project_id != '')
        for (var j = 0; j < len; j++) {
          if (project_id == assigned_projects[user_id][j]) {
            document.reportForm.elements[i].checked = true;
            break;
          }
        }
    }
  }
}

// handleCheckboxes - unmarks and disables the "Totals only" checkbox when
// "no grouping" is selected in the associated dropdown.
// In future we need to improve this function and hide not relevant elements completely.
function handleCheckboxes() {
  var totalsOnlyCheckbox = document.getElementById("chtotalsonly");
  if ("no_grouping" == document.getElementById("group_by").value) {
	// Unmark and disable the "Totals only" checkbox.
    totalsOnlyCheckbox.checked = false;
    totalsOnlyCheckbox.disabled = true;
  } else
	totalsOnlyCheckbox.disabled = false;
}
</script>

<?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['open'];?>

<div style="padding: 0 0 10 0;">
  <table border="0" bgcolor="#efefef" width="720">
    <tr>
      <td>
        <table cellspacing="1" cellpadding="3" border="0">
          <tr>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['fav_report'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['favorite_report']['control'];?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['btn_generate']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['btn_delete']['control'];?>
</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>

<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td valign="top" colspan="2" align="center">
      <table border="0" cellpadding="3">
<?php if (((in_array('cl',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))&&!($_smarty_tpl->getVariable('user')->value->isClient()&&$_smarty_tpl->getVariable('user')->value->client_id))||($_smarty_tpl->getVariable('custom_fields')->value&&$_smarty_tpl->getVariable('custom_fields')->value->fields[0]&&$_smarty_tpl->getVariable('custom_fields')->value->fields[0]['type']==CustomFields::TYPE_DROPDOWN))){?>          
        <tr>
  <?php if (in_array('cl',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))&&!($_smarty_tpl->getVariable('user')->value->isClient()&&$_smarty_tpl->getVariable('user')->value->client_id)){?><td><b><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['client'];?>
</b></td><?php }else{ ?><td>&nbsp;</td><?php }?>
          <td>&nbsp;</td>
  <?php if (($_smarty_tpl->getVariable('custom_fields')->value&&$_smarty_tpl->getVariable('custom_fields')->value->fields[0]&&$_smarty_tpl->getVariable('custom_fields')->value->fields[0]['type']==CustomFields::TYPE_DROPDOWN)){?><td><b><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['option'];?>
</b></td><?php }else{ ?><td>&nbsp;</td><?php }?>
        </tr>
        <tr>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['client']['control'];?>
</td>
          <td>&nbsp;</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['option']['control'];?>
</td>
        </tr>
<?php }?>
<?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>      
        <tr>
          <td><b><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['project'];?>
</b></td>
          <td>&nbsp;</td>
  <?php if ((@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
          <td><b><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['task'];?>
</b></td>
  <?php }?>           
        </tr>
<?php }?>
<?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
        <tr>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['project']['control'];?>
</td>
          <td>&nbsp;</td>
  <?php if ((@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['task']['control'];?>
</td>
  <?php }?>
        </tr>
<?php }?>
<?php if (in_array('iv',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))){?> 
        <tr>
          <td><b><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['billable'];?>
</b></td>
          <td>&nbsp;</td>
          <td><b><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['invoice'];?>
</b></td>
        </tr>
        <tr valign="top">
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['include_records']['control'];?>
</td>
          <td>&nbsp;</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['invoice']['control'];?>
</td>
        </tr>
<?php }?>
<?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?>
        <tr>
          <td colspan="3"><b><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['users'];?>
</b></td>
        </tr>
        <tr>
          <td colspan="3"><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['users']['control'];?>
</td>
        </tr>
<?php }?>
        <tr>
          <td><b><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['reports']['select_period'];?>
</b></td>
          <td>&nbsp;</td>
          <td><b><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['reports']['set_period'];?>
</b></td>
        </tr>
        <tr valign="top">
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['period']['control'];?>
</td>
          <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['start_date'];?>
:</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['start_date']['control'];?>
</td>
        </tr>
        <tr>
          <td></td>
          <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['end_date'];?>
:</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['end_date']['control'];?>
</td>
        </tr>
        <tr><td colspan="3"><b><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['reports']['show_fields'];?>
</b></td></tr>
        <tr>
          <td colspan="3">
            <table border="0" width="100%">
<?php if (in_array('cl',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))||in_array('iv',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))){?>          
              <tr>
  <?php if (in_array('cl',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))){?>
                <td width="25%"><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chclient']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['label']['client'];?>
</label></td>
  <?php }?>
  <?php if (($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient())&&in_array('iv',explode(',',$_smarty_tpl->getVariable('user')->value->plugins))){?>
                <td width="25%"><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chinvoice']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['label']['invoice'];?>
</label></td>
  <?php }?>
              </tr>
<?php }?>            
              <tr>
                <td width="25%"><?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chproject']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['label']['project'];?>
</label><?php }?></td>
                <td width="25%"><?php if (((@TYPE_START_FINISH==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chstart']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['label']['start'];?>
</label><?php }?></td>
                <td width="25%"><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chduration']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['label']['duration'];?>
</label></td>
<?php if (((($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient())||in_array('ex',explode(',',$_smarty_tpl->getVariable('user')->value->plugins)))&&defined('COST_ON_REPORTS')&&isTrue(@COST_ON_REPORTS))){?>
                  <td width="25%"><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chcost']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['label']['cost'];?>
</label></td>
<?php }else{ ?>
                  <td></td>
<?php }?>
              </tr>
              <tr>
              	<td><?php if ((@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chtask']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['label']['task'];?>
</label><?php }?></td>
              	<td><?php if (((@TYPE_START_FINISH==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chfinish']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['label']['finish'];?>
</label><?php }?></td>
                <td><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chnote']['control'];?>
&nbsp;<?php echo $_smarty_tpl->getVariable('i18n')->value['label']['note'];?>
</label></td>
<?php if (($_smarty_tpl->getVariable('custom_fields')->value&&$_smarty_tpl->getVariable('custom_fields')->value->fields[0])){?>
                <td><label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chcf_1']['control'];?>
&nbsp;<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('custom_fields')->value->fields[0]['label'],'html');?>
</label></td>
<?php }else{ ?>
                <td></td>
<?php }?>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td><b><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['reports']['group_by'];?>
</b></td>
        </tr>
        <tr valign="top">
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['group_by']['control'];?>
 <label><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['chtotalsonly']['control'];?>
 <?php echo $_smarty_tpl->getVariable('i18n')->value['form']['reports']['totals_only'];?>
</label></td>
        </tr>
      </table>
      
<div style="padding: 10 0 10 0;">
  <table border="0" bgcolor="#efefef" width="720">
    <tr>
      <td align="center">
        <table cellspacing="1" cellpadding="3" border="0">
          <tr>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['reports']['save_as_favorite'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['new_fav_report']['control'];?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['btn_save']['control'];?>
</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>

      <table border="0" cellpadding="3" width="100%">
        <tr><td colspan="3" height="50" align="center"><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['btn_generate']['control'];?>
</td></tr>
      </table>
    </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['close'];?>
