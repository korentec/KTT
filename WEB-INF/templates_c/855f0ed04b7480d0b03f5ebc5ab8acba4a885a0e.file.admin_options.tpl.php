<?php /* Smarty version Smarty-3.0.7, created on 2016-02-17 15:18:23
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\admin_options.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2432056c4731f7d0847-58384755%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '855f0ed04b7480d0b03f5ebc5ab8acba4a885a0e' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\admin_options.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2432056c4731f7d0847-58384755',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo $_smarty_tpl->getVariable('forms')->value['optionsForm']['open'];?>

<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['password'];?>
:</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['optionsForm']['password1']['control'];?>
</td>
        </tr>
        <tr>
          <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['confirm_password'];?>
:</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['optionsForm']['password2']['control'];?>
</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="50"><?php echo $_smarty_tpl->getVariable('forms')->value['optionsForm']['btn_submit']['control'];?>
</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['optionsForm']['close'];?>
