<?php /* Smarty version Smarty-3.0.7, created on 2016-03-24 07:03:21
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/export.tpl" */ ?>
<?php /*%%SmartyHeaderCode:80500764156f3d7896b2906-86014980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f7a4f9a5114a1745209b7e9645338ee166d4c05' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/export.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80500764156f3d7896b2906-86014980',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo $_smarty_tpl->getVariable('forms')->value['exportForm']['open'];?>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td align="center">
<?php if ($_smarty_tpl->getVariable('user')->value->isManager()){?>
      <table border="0" width="60%">
        <colgroup>
          <col width="50%">
          <col width="50%">
        </colgroup>
        <tr><td colspan="2"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['export']['hint'];?>
<br></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
          <td align='right'><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['export']['compression'];?>
:</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['exportForm']['compression']['control'];?>
</td>
        </tr>
        <tr><td height="50" align="center" colspan="2"><?php echo $_smarty_tpl->getVariable('forms')->value['exportForm']['btn_submit']['control'];?>
</td></tr>
      </table>
<?php }?>
    </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['exportForm']['close'];?>
