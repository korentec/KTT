<?php /* Smarty version Smarty-3.0.7, created on 2016-04-04 01:01:16
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/user_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16177905195702032c5d1339-03737493%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e816bba68597ea037e7f0aa0a1ef94a2ce35b8e' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/user_delete.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16177905195702032c5d1339-03737493',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/modifier.escape.php';
?><?php echo $_smarty_tpl->getVariable('forms')->value['userDeleteForm']['open'];?>

<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td colspan="2" align="center"><b><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('user_to_delete')->value,'html');?>
</b></td>
        </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><?php echo $_smarty_tpl->getVariable('forms')->value['userDeleteForm']['btn_delete']['control'];?>
&nbsp;</td>
          <td align="left">&nbsp;<?php echo $_smarty_tpl->getVariable('forms')->value['userDeleteForm']['btn_cancel']['control'];?>
</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['userDeleteForm']['close'];?>
