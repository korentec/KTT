<?php /* Smarty version Smarty-3.0.7, created on 2016-04-03 07:10:00
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/cf_custom_field_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132342838357010818027495-97038309%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25b42d690622de8948623cae354f8205bebbb089' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/cf_custom_field_edit.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132342838357010818027495-97038309',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo $_smarty_tpl->getVariable('forms')->value['fieldForm']['open'];?>
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()){?>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['thing_name'];?>
 (*):</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['fieldForm']['name']['control'];?>
</td>
        </tr>
        <tr>
          <td align="right"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['type'];?>
:</td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['fieldForm']['type']['control'];?>
</td>
        </tr>
        <tr>
          <td align="right"><label for="required"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['required'];?>
:</label></td>
          <td><?php echo $_smarty_tpl->getVariable('forms')->value['fieldForm']['required']['control'];?>
</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="50"><?php echo $_smarty_tpl->getVariable('forms')->value['fieldForm']['btn_save']['control'];?>
</td>
        </tr>
      </table>
      <?php }?>
    </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['fieldForm']['close'];?>
