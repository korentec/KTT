<?php /* Smarty version Smarty-3.0.7, created on 2016-10-31 08:20:13
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/time_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16853712685817450d5264e4-89743075%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01d0056e9135a20da266f0c2041371af684a12e6' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/time_delete.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16853712685817450d5264e4-89743075',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_cycle')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_escape')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/modifier.escape.php';
?><?php echo $_smarty_tpl->getVariable('forms')->value['timeRecordForm']['open'];?>

<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table border='0' cellpadding='3' cellspacing='1' width="100%">
  <tr>
<?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
    <td class="tableHeader" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['project'];?>
</td>
<?php }?>
    <td class="tableHeader" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['duration'];?>
</td>
	<td class="tableHeader" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['note'];?>
</td>
  </tr>
  <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#f5f5f5,#ccccce"),$_smarty_tpl);?>
">
<?php if ((@MODE_PROJECTS==$_smarty_tpl->getVariable('user')->value->tracking_mode||@MODE_PROJECTS_AND_TASKS==$_smarty_tpl->getVariable('user')->value->tracking_mode)){?>
    <td><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('time_rec')->value['project_name'],'html');?>
</td>
<?php }?>
    <td align="right"><?php if ($_smarty_tpl->getVariable('time_rec')->value['duration']!='0:00'){?><?php echo $_smarty_tpl->getVariable('time_rec')->value['duration'];?>
<?php }else{ ?><font color="#ff0000"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['time']['uncompleted'];?>
</font><?php }?></td>
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
