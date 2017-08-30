<?php /* Smarty version Smarty-3.0.7, created on 2016-03-30 01:19:10
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/activity_del.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5053385856fb6fde609c96-75247588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b21e6cd35c92aca2ebd7f90760d4815bfe73ddf1' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/activity_del.tpl',
      1 => 1291535023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5053385856fb6fde609c96-75247588',
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
