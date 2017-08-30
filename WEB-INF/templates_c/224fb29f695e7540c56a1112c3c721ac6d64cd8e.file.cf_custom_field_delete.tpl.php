<?php /* Smarty version Smarty-3.0.7, created on 2016-04-03 07:10:28
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/cf_custom_field_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205244540357010834b56250-23083609%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '224fb29f695e7540c56a1112c3c721ac6d64cd8e' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/cf_custom_field_delete.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205244540357010834b56250-23083609',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/modifier.escape.php';
?><?php echo $_smarty_tpl->getVariable('forms')->value['fieldDeleteForm']['open'];?>
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()){?>
      <table cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td colspan="2" align="center"><b><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('field')->value,'html');?>
</b></td>
        </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><?php echo $_smarty_tpl->getVariable('forms')->value['fieldDeleteForm']['btn_delete']['control'];?>
&nbsp;</td>
          <td align="left">&nbsp;<?php echo $_smarty_tpl->getVariable('forms')->value['fieldDeleteForm']['btn_cancel']['control'];?>
</td>
        </tr>
      </table>
      <?php }?>
    </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['fieldDeleteForm']['close'];?>
