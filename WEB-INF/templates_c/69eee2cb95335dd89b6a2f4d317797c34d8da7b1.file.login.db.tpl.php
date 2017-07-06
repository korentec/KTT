<?php /* Smarty version Smarty-3.0.7, created on 2016-03-24 06:59:19
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/login.db.tpl" */ ?>
<?php /*%%SmartyHeaderCode:194171172256f3d6971e6fe3-05607742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69eee2cb95335dd89b6a2f4d317797c34d8da7b1' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/login.db.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '194171172256f3d6971e6fe3-05607742',
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