<?php /* Smarty version Smarty-3.0.7, created on 2016-03-27 06:19:18
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/time_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96653203256f7c1b6ac84a5-45671529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1aa0e7e01cd52fa67cc04c758a8178e4a5b77ee' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/time_delete.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96653203256f7c1b6ac84a5-45671529',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_cycle')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_escape')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/modifier.escape.php';
?><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['open'];?>

<table cellspacing="4" cellpadding="7" border="0" width="720">
<tr>
  <td>
  <table border='0' cellpadding='3' cellspacing='1' width="100%">
  <tr>
<?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
    <td class="tableHeader" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['project'];?>
</td>
<?php }?>
<?php if ((@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
    <td class="tableHeader" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['task'];?>
</td>
<?php }?>
<?php if (((@TYPE_START_FINISH==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?>
    <td class="tableHeader" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['start'];?>
</td>
    <td class="tableHeader" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['finish'];?>
</td>
<?php }?>
<?php if (((@TYPE_DURATION==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?>
    <td class="tableHeader" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['duration'];?>
</td>
<?php }?>
	<td class="tableHeader" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['note'];?>
</td>
  </tr>
  <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#f5f5f5,#ccccce"),$_smarty_tpl);?>
">
<?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
    <td><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('time_rec')->value['project_name'],'html');?>
</td>
<?php }?>
<?php if ((@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
    <td><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('time_rec')->value['task_name'],'html');?>
</td>
<?php }?>
<?php if (((@TYPE_START_FINISH==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?>
    <td align="right"><?php if ($_smarty_tpl->getVariable('time_rec')->value['start']){?><?php echo $_smarty_tpl->getVariable('time_rec')->value['start'];?>
<?php }else{ ?>&nbsp;<?php }?></td>
    <td align="right"><?php if ($_smarty_tpl->getVariable('time_rec')->value['finish']!=$_smarty_tpl->getVariable('time_rec')->value['start']){?><?php echo $_smarty_tpl->getVariable('time_rec')->value['finish'];?>
<?php }else{ ?>&nbsp;<?php }?></td>
<?php }?>
<?php if (((@TYPE_DURATION==$_smarty_tpl->getVariable('user')->value->record_type)||(@TYPE_ALL==$_smarty_tpl->getVariable('user')->value->record_type))){?>
    <td align="right"><?php if ($_smarty_tpl->getVariable('time_rec')->value['duration']!='0:00'){?><?php echo $_smarty_tpl->getVariable('time_rec')->value['duration'];?>
<?php }else{ ?><font color="#ff0000"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['uncompleted'];?>
</font><?php }?></td>
<?php }?>
    <td><?php if ($_smarty_tpl->getVariable('time_rec')->value['comment']){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('time_rec')->value['comment'],'html');?>
<?php }else{ ?>&nbsp;<?php }?></td>
  </tr>
  </table>
  <table width="100%">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['delete_button']['control'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['cancel_button']['control'];?>
</td>
  </tr>
  </table>
  </td>
</tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['close'];?>
