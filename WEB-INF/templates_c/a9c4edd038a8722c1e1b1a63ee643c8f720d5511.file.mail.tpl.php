<?php /* Smarty version Smarty-3.0.7, created on 2016-04-03 02:01:18
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/mail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12228924725700bfbef30c21-63241523%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9c4edd038a8722c1e1b1a63ee643c8f720d5511' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/mail.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12228924725700bfbef30c21-63241523',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo $_smarty_tpl->getVariable('forms')->value['mailForm']['open'];?>
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
    <table cellspacing="4" cellpadding="7" border="0">
    <tr>
      <td valign="top" colspan="2">
        <table>
        <tr>
          <td align='right'><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['mail']['from'];?>
 (*):</td>
          <td><?php echo @SENDER;?>
</td>
        </tr>
        <tr>
          <td align='right'><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['mail']['to'];?>
 (*):</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['mailForm']['receiver']['control'];?>
</td>
        </tr>
        <tr>
          <td align='right'><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['mail']['cc'];?>
:</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['mailForm']['cc']['control'];?>
</td>
        </tr>
        <tr>
          <td align='right'><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['mail']['subject'];?>
 (*):</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['mailForm']['subject']['control'];?>
</td>
        </tr>
        <tr>
          <td align='right'><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['comment'];?>
:</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['mailForm']['comment']['control'];?>
</td>
        </tr>
        <tr>
          <td></td>
          <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['required_fields'];?>
</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="70"><?php echo $_smarty_tpl->getVariable('forms')->value['mailForm']['btn_send']['control'];?>
</td>
        </tr>
        </table>
      </td>
    </tr>
    </table>
  </td>
</tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['mailForm']['close'];?>
