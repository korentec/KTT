<?php /* Smarty version Smarty-3.0.7, created on 2016-03-24 08:48:36
         compiled from "C:\wamp64\www\ktt/WEB-INF/templates\login.db.tpl" */ ?>
<?php /*%%SmartyHeaderCode:874856f3a9e46c9069-17371590%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e192f84e2bc3bef17e963bfe488ce6650933e3c8' => 
    array (
      0 => 'C:\\wamp64\\www\\ktt/WEB-INF/templates\\login.db.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '874856f3a9e46c9069-17371590',
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