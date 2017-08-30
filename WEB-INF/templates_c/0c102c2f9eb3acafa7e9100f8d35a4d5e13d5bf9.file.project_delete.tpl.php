<?php /* Smarty version Smarty-3.0.7, created on 2016-05-17 07:12:41
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/project_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2078084888573b0ab99d2ce4-99375374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c102c2f9eb3acafa7e9100f8d35a4d5e13d5bf9' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/project_delete.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2078084888573b0ab99d2ce4-99375374',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/modifier.escape.php';
?><?php echo $_smarty_tpl->getVariable('forms')->value['projectDeleteForm']['open'];?>

<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td colspan="2" align="center"><b><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('project_to_delete')->value,'html');?>
</b></td>
        </tr>
        <tr><td colspan="2" align="center">&nbsp;</td></tr>
        <tr>
          <td align="right"><?php echo $_smarty_tpl->getVariable('forms')->value['projectDeleteForm']['btn_delete']['control'];?>
&nbsp;</td>
          <td align="left">&nbsp;<?php echo $_smarty_tpl->getVariable('forms')->value['projectDeleteForm']['btn_cancel']['control'];?>
</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['projectDeleteForm']['close'];?>
