<?php /* Smarty version Smarty-3.0.7, created on 2016-02-23 13:33:14
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:250856cc437aa7d6f9-98452928%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6a0679816013db2fdb9ca80d88d28f4d30c651d' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\users.tpl',
      1 => 1456227185,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '250856cc437aa7d6f9-98452928',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_cycle')) include 'C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs\WEB-INF\lib\smarty\plugins\function.cycle.php';
if (!is_callable('smarty_modifier_escape')) include 'C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs\WEB-INF\lib\smarty\plugins\modifier.escape.php';
?><script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
<?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()){?>
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
  <?php if ($_smarty_tpl->getVariable('inactive_users')->value){?>
        <tr><td class="sectionHeaderNoBorder"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['active_users'];?>
</td></tr>
  <?php }?>
        <tr>
          <td width="35%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['person_name'];?>
</td>
          <td width="35%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['login'];?>
</td>
          <td width="10%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['role'];?>
</td>
          <td width="10%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['edit'];?>
</td>
          <td width="10%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['delete'];?>
</td>
        </tr>
  <?php if ($_smarty_tpl->getVariable('active_users')->value){?>
    <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('active_users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
        <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#f5f5f5,#dedee5"),$_smarty_tpl);?>
">
          <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['u']->value['name'],'html');?>
</td>
          <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['u']->value['login'],'html');?>
</td>
      <?php if (@ROLE_MANAGER==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['manager'];?>
</td>
      <?php }elseif(@ROLE_COMANAGER==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['comanager'];?>
</td>
      <?php }elseif(@ROLE_CLIENT==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['client'];?>
</td>
      <?php }elseif(@ROLE_USER==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['user'];?>
</td>
      <?php }?>
      <?php if ($_smarty_tpl->getVariable('user')->value->isManager()){?>
          <!-- Manager can edit everybody. -->
          <td><a href="user_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['edit'];?>
</a></td>
          <td><?php if (@ROLE_MANAGER!=$_smarty_tpl->tpl_vars['u']->value['role']||$_smarty_tpl->getVariable('can_delete_manager')->value){?><a href="user_delete.php?id=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['delete'];?>
</a><?php }?></td>
      <?php }else{ ?>
          <!--  Comanager can edit self and clients or users but not manager and other comanagers. -->
          <td><?php if (($_smarty_tpl->getVariable('user')->value->id==$_smarty_tpl->tpl_vars['u']->value['id'])||(@ROLE_CLIENT==$_smarty_tpl->tpl_vars['u']->value['role'])||(@ROLE_USER==$_smarty_tpl->tpl_vars['u']->value['role'])){?><a href="user_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['edit'];?>
</a><?php }?></td>
          <td><?php if (($_smarty_tpl->getVariable('user')->value->id==$_smarty_tpl->tpl_vars['u']->value['id'])||(@ROLE_CLIENT==$_smarty_tpl->tpl_vars['u']->value['role'])||(@ROLE_USER==$_smarty_tpl->tpl_vars['u']->value['role'])){?><a href="user_delete.php?id=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['delete'];?>
</a><?php }?></td>
      <?php }?>
        </tr>
    <?php }} ?>
  <?php }?>
      </table>
      
      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('user_add.php');" value="<?php echo $_smarty_tpl->getVariable('i18n')->value['button']['add_user'];?>
"></form>
          </td>
        </tr>
      </table>

  <?php if ($_smarty_tpl->getVariable('inactive_users')->value){?>
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['inactive_users'];?>
</td></tr>
        <tr>
          <td width="35%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['person_name'];?>
</td>
          <td width="35%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['login'];?>
</td>
          <td width="10%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['role'];?>
</td>
          <td width="10%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['edit'];?>
</td>
          <td width="10%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['delete'];?>
</td>
        </tr>
    <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('inactive_users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
        <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#f5f5f5,#dedee5"),$_smarty_tpl);?>
">
          <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['u']->value['name'],'html');?>
</td>
          <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['u']->value['login'],'html');?>
</td>
      <?php if (@ROLE_MANAGER==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['manager'];?>
</td>
      <?php }elseif(@ROLE_COMANAGER==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['comanager'];?>
</td>
      <?php }elseif(@ROLE_CLIENT==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['client'];?>
</td>
      <?php }elseif(@ROLE_USER==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['user'];?>
</td>
      <?php }?>
      <?php if ($_smarty_tpl->getVariable('user')->value->isManager()){?>
          <!-- Manager can edit everybody. -->
          <td><a href="user_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['edit'];?>
</a></td>
          <td><?php if (@ROLE_MANAGER!=$_smarty_tpl->tpl_vars['u']->value['role']||$_smarty_tpl->getVariable('can_delete_manager')->value){?><a href="user_delete.php?id=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['delete'];?>
</a><?php }?></td>
      <?php }else{ ?>
          <!--  Comanager can edit self and clients or users but not manager and other comanagers. -->
          <td><?php if (($_smarty_tpl->getVariable('user')->value->id==$_smarty_tpl->tpl_vars['u']->value['id'])||(@ROLE_CLIENT==$_smarty_tpl->tpl_vars['u']->value['role'])||(@ROLE_USER==$_smarty_tpl->tpl_vars['u']->value['role'])){?><a href="user_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['edit'];?>
</a><?php }?></td>
          <td><?php if (($_smarty_tpl->getVariable('user')->value->id==$_smarty_tpl->tpl_vars['u']->value['id'])||(@ROLE_CLIENT==$_smarty_tpl->tpl_vars['u']->value['role'])||(@ROLE_USER==$_smarty_tpl->tpl_vars['u']->value['role'])){?><a href="user_delete.php?id=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['delete'];?>
</a><?php }?></td>
      <?php }?>
        </tr>
    <?php }} ?>

      </table>
      
      <table width="100%">
        <tr>
          <td align="center" height="50">
            <form><input type="button" onclick="chLocation('user_add.php');" value="<?php echo $_smarty_tpl->getVariable('i18n')->value['button']['add_user'];?>
"></form>
          </td>
        </tr>
      </table>
  <?php }?>
<?php }else{ ?>
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td width="35%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['person_name'];?>
</td>
          <td width="35%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['login'];?>
</td>
          <td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['role'];?>
</td>
        </tr>
  <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('active_users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
        <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#f5f5f5,#dedee5"),$_smarty_tpl);?>
">
          <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['u']->value['name'],'html');?>
</td>
          <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['u']->value['login'],'html');?>
</td>
    <?php if (@ROLE_MANAGER==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['manager'];?>
</td>
    <?php }elseif(@ROLE_COMANAGER==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['users']['manager'];?>
</td>
    <?php }elseif(@ROLE_CLIENT==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['client'];?>
</td>
			<?php }elseif(@ROLE_SITE_ADMIN==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['role_admin'];?>
</td>
    <?php }elseif(@ROLE_USER==$_smarty_tpl->tpl_vars['u']->value['role']){?>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['user'];?>
</td>
    <?php }?>
        </tr>
  <?php }} ?>
      </table>
<?php }?>
    </td>
  </tr>
</table>