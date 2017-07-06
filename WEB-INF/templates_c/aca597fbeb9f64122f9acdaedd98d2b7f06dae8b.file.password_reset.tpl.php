<?php /* Smarty version Smarty-3.0.7, created on 2016-02-17 15:14:49
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\password_reset.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1295056c47249c3c7a9-76149853%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aca597fbeb9f64122f9acdaedd98d2b7f06dae8b' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\password_reset.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1295056c47249c3c7a9-76149853',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo $_smarty_tpl->getVariable('forms')->value['resetPasswordForm']['open'];?>

<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <?php if ($_smarty_tpl->getVariable('result_message')->value){?>
      <table cellspacing="4" cellpadding="7" border="0" width="100%">
        <tr><td align="center"><font color="red"><b><?php echo $_smarty_tpl->getVariable('result_message')->value;?>
</b></font></td></tr>
      </table>
	  <?php }else{ ?>
      <table>
        <tr>
          <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['login'];?>
:</td>
          <td colspan="3"><?php echo $_smarty_tpl->getVariable('forms')->value['resetPasswordForm']['login']['control'];?>
</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3" align="center"><?php echo $_smarty_tpl->getVariable('forms')->value['resetPasswordForm']['btn_submit']['control'];?>
</td>
        </tr>
      </table>
      <?php }?>
    </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['resetPasswordForm']['close'];?>
