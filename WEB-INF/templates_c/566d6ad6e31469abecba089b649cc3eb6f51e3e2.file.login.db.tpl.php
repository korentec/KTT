<?php /* Smarty version Smarty-3.0.7, created on 2016-02-17 13:47:44
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\login.db.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2118256c45de0e7a196-41218469%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '566d6ad6e31469abecba089b649cc3eb6f51e3e2' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\login.db.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2118256c45de0e7a196-41218469',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<table border="0">
  <tr>
    <td<?php if (!$_smarty_tpl->getVariable('i18n')->value['language']['rtl']){?> align="right"<?php }?>><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['login'];?>
:</td>
    <td><?php echo $_smarty_tpl->getVariable('forms')->value['loginForm']['login']['control'];?>
</td>
  </tr>
  <tr>
    <td<?php if (!$_smarty_tpl->getVariable('i18n')->value['language']['rtl']){?> align="right"<?php }?>><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['password'];?>
:</td>
    <td><?php echo $_smarty_tpl->getVariable('forms')->value['loginForm']['password']['control'];?>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href ='password_reset.php'><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['login']['forgot_password'];?>
</a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" height="50"><?php echo $_smarty_tpl->getVariable('forms')->value['loginForm']['btn_login']['control'];?>
</td>
  </tr>
</table>