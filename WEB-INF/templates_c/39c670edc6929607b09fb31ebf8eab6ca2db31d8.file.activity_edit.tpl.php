<?php /* Smarty version Smarty-3.0.7, created on 2016-02-24 12:27:43
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\activity_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2129056cd859f8d0145-12834491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39c670edc6929607b09fb31ebf8eab6ca2db31d8' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\activity_edit.tpl',
      1 => 1291535023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2129056cd859f8d0145-12834491',
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
              <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['name'];?>
 (*):</td>
              <td><?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['name']['control'];?>
</td>
            </tr>
			<tr>
              <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['code'];?>
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
              <td colspan="2">&nbsp;</td>
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
