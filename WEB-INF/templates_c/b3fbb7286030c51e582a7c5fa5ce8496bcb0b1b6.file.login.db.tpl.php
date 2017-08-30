<?php /* Smarty version Smarty-3.0.7, created on 2016-03-27 02:30:12
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/login.db.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170511611056f78c046f87e7-30072853%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3fbb7286030c51e582a7c5fa5ce8496bcb0b1b6' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/login.db.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170511611056f78c046f87e7-30072853',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<table border="0">
  <tr><td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['login'];?>
:</td></tr>
  <tr><td><?php echo $_smarty_tpl->getVariable('forms')->value['loginForm']['login']['control'];?>
</td></tr>
  <tr><td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['password'];?>
:</td></tr>
  <tr><td><?php echo $_smarty_tpl->getVariable('forms')->value['loginForm']['password']['control'];?>
</td></tr>
  <tr><td align="center" height="50"><?php echo $_smarty_tpl->getVariable('forms')->value['loginForm']['btn_login']['control'];?>
</td></tr>
</table>