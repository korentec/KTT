<?php /* Smarty version Smarty-3.0.7, created on 2016-02-24 13:20:18
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\activity_del.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1281556cd91f23485e9-51765127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4cc0f6dec724a4c819336f3bc0177c1d17f7e62' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\activity_del.tpl',
      1 => 1291535023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1281556cd91f23485e9-51765127',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['open'];?>
<table cellspacing="4" cellpadding="7" border="0">
  <tbody>
    <tr>
      <td>

          <table id="table1" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td colspan="2" align="center"><b><?php echo $_smarty_tpl->getVariable('delstr_activity')->value;?>
</b></td>
            </tr>
            <tr>
              <td colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="right"><?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['confirmation']['control'];?>
&nbsp;</td>
              <td align="left">&nbsp;<?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['rejecting']['control'];?>
</td>
            </tr>
          </table>

      </td>
    </tr>
  </tbody>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['close'];?>
