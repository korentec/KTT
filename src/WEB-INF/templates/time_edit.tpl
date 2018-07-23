<script>
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
{foreach $client_list as $client}
  project_ids[{$client.id}] = "{$client.projects}";
{/foreach}
// Prepare an array of project names.
project_names = new Array();
{foreach $project_list as $project}
  project_names[{$project.id}] = "{$project.name|escape:'javascript'}";
{/foreach}
// We'll use this array to populate project dropdown when client is not selected.
var idx = 0;
projects = new Array();
{foreach $project_list as $project}
  projects[idx] = new Array("{$project.id}", "{$project.name|escape:'javascript'}");
  idx++;
{/foreach}
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

	var empty_label = '{$i18n.controls.select.activity|regex_replace:"/(\&rsquo;)/":"\'"}';
    {if $activity_list}
    {foreach from=$activity_list item=activity}
    	projects = new Array();
    	{if $activity.aprojects}
    	{foreach from=$activity.aprojects item=project}
    	projects.push({$project.p_id});
    	{/foreach}
    	{/if}
	act.append({$activity.a_id},projects,'{$activity.a_name|escape:"quotes"}');
	{/foreach}
	{/if}
	
	
	
// Prepare an array of task ids for projects.
task_ids = new Array();
{foreach $project_list as $project}
  task_ids[{$project.id}] = "{$project.tasks}";
{/foreach}
// Prepare an array of task names.
task_names = new Array();
{foreach $task_list as $task}
  task_names[{$task.id}] = "{$task.name|escape:'javascript'}";
{/foreach}
// Mandatory top options for project and task dropdowns.
empty_label_project = '{$i18n.dropdown.select|escape:'javascript'}';
empty_label_task = '{$i18n.dropdown.select|escape:'javascript'}';
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
         if(x){
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
  var time_format = '{$user->time_format}';
  var obj = eval("document.timeRecordForm." + formField);
  obj.value = today.strftime(time_format);
  formDisable(formField);
}
   function initForm() {
    	fillActivityDir();
    	//fillSubActivityDir();
    }

function setAttTime(formField) {
  const elem = eval("document.timeRecordForm." + formField);
  elem.value = formField === 'start' ? "{$att_start}" : "{$att_finish}";
}

</script>
{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table width = "100%">
  <tr>
  	<td valign="top">
    <table border="0">
{if in_array('cl', explode(',', $user->plugins))}
    <tr>
      <td align="right">{$i18n.label.client}{if in_array('cm', explode(',', $user->plugins))} (*){/if}:</td>
      <td>{$forms.timeRecordForm.client.control}</td>
    </tr>
{/if}
{if in_array('iv', explode(',', $user->plugins))}
    <tr>
      <td align="right">&nbsp;</td>
      <td><label>{$forms.timeRecordForm.billable.control}{$i18n.form.time.billable}</label></td>
    </tr>
{/if}
{if ($custom_fields && $custom_fields->fields[0])} 
    <tr>
      <td align="right">{$custom_fields->fields[0]['label']|escape:'html'}{if $custom_fields->fields[0]['required']} (*){/if}:</td><td>{$forms.timeRecordForm.cf_1.control}</td>
    </tr>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <tr>
      <td align="right">{$i18n.label.project} (*):</td>
      <td>{$forms.timeRecordForm.project.control}</td>
    </tr>
	
	
	  <tr>
      <td align="right">{$i18n.label.activity} (*):</td>
      <td>{$forms.timeRecordForm.activity.control}</td>
    </tr>
   // {if ($user->isManager() )} //|| $user->isCoManager()
    //  <tr>
    //  <td align="right">{$i18n.form.time.subactivity} :</td>
    //  <td>{$forms.timeRecordForm.subactivity.control}</td>
   // </tr>
	 {/if}
	 <tr>
      <td align="right">{$i18n.form.time.location}</td>
      <td>{$forms.timeRecordForm.location.control}</td>
    </tr>
{/if}
{if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <tr>
      <td align="right">{$i18n.label.task} (*):</td>
      <td>{$forms.timeRecordForm.task.control}</td>
    </tr>
{/if}
{if (($smarty.const.TYPE_START_FINISH == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
    <tr>
      <td align="right">{$i18n.label.start}:</td>
      <td>
        {$forms.timeRecordForm.start.control}&nbsp;
        <input onclick="setNow('start');" type="button" tabindex="-1" value="{$i18n.button.now}">
        {if (isset($att_start))}
          <input onclick="setAttTime('start');" type="button" tabindex="-1" value="{$i18n.button.att_time}">
        {else}
          <input type="button" tabindex="-1" value="{$i18n.button.att_time}" disabled>
        {/if}
      </td>
    </tr>
    <tr>
      <td align="right">{$i18n.label.finish}:</td>
      <td>
        {$forms.timeRecordForm.finish.control}&nbsp;
        <input onclick="setNow('finish');" type="button" tabindex="-1" value="{$i18n.button.now}">
        {if (isset($att_start))}
          <input onclick="setAttTime('finish');" type="button" tabindex="-1" value="{$i18n.button.att_time}">
        {else}
          <input type="button" tabindex="-1" value="{$i18n.button.att_time}" disabled>
        {/if}
      </td>
    </tr>
{/if}
{if (($smarty.const.TYPE_DURATION == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
    <tr>
      <td align="right">{$i18n.label.duration}:</td>
      <td>{$forms.timeRecordForm.duration.control}&nbsp;{$i18n.form.time.duration_format}</td>
    </tr>
{/if}
    <tr>
      <td align="right">{$i18n.label.date}:</td>
      <td>{$forms.timeRecordForm.date.control}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.label.note}:</td>
      <td>{$forms.timeRecordForm.note.control}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.label.attendanceNote}:</td>
      <td>{$forms.timeRecordForm.attendance_note.control}</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td align="left">{$forms.timeRecordForm.btn_save.control} {$forms.timeRecordForm.btn_copy.control} {$forms.timeRecordForm.btn_delete.control}</td>
    </tr>
    </table>
    </td>
    </tr>
  </table>
  </td>
  </tr>
</table>
{$forms.timeRecordForm.close}