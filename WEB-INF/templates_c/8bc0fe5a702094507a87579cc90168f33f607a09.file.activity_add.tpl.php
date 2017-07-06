<?php /* Smarty version Smarty-3.0.7, created on 2016-02-24 11:12:12
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\activity_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1441956cd73ec92fef8-66763377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8bc0fe5a702094507a87579cc90168f33f607a09' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\activity_add.tpl',
      1 => 1291535023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1441956cd73ec92fef8-66763377',
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
      
          <table id="table1" cellspacing="1" cellpadding="2" border="0">
            <tr>
              <td align = "right"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['name'];?>
 (*):</td>
              <td><?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['name']['control'];?>
</td>
            </tr>
			<tr>
              <td align = "right"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['code'];?>
:</td>
              <td><?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['code']['control'];?>
</td>
            </tr>
            <tr valign="top">
              <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['people']['projects'];?>
:</td>
              <td><?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['projects']['control'];?>
</td>
            </tr>
            <tr>
              <td></td>
              <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['req_fields'];?>
</td>
            </tr>
            <tr>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="center" height="50"><?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['btsubmit']['control'];?>
</td>
            </tr>
          </table>

      </td>
    </tr>
  </tbody>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['close'];?>
