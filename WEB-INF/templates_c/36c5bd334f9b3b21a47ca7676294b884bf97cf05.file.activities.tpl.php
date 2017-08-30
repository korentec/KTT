<?php /* Smarty version Smarty-3.0.7, created on 2016-03-24 07:03:00
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/activities.tpl" */ ?>
<?php /*%%SmartyHeaderCode:100179550456f3d774885572-20683226%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36c5bd334f9b3b21a47ca7676294b884bf97cf05' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/activities.tpl',
      1 => 1291535022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100179550456f3d774885572-20683226',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_cycle')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/function.cycle.php';
?>
<script>
    function chLocation(newLocation) { document.location = newLocation; }
</script>


<?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['open'];?>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
  <td valign="top">

  <div style="padding:0 0 10 0;">
  <table border="0" bgcolor="#efefef" width="720"><tr><td>
	  <table cellspacing="1" cellpadding="3" border="0">
	    <tr>
	      <td colspan="2"><b><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['filter'];?>
:</b></td>
	      <td>&nbsp;</td>
	    </tr>
	    <tr>
	      <td><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['filter']['project'];?>
:</td><td><?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['f_project']['control'];?>
</td>
	      <td><noscript><?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['btsubmit']['control'];?>
</noscript></td>
	    </tr>
	  </table>
  </td></tr></table>
  </div>
  
  <?php if (($_smarty_tpl->getVariable('user')->value->isManager()||$_smarty_tpl->getVariable('user')->value->isCoManager())){?>
	<table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
    <tr>
	  <td width="10%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['th']['code'];?>
</td>
      <td width="40%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['th']['name'];?>
</td>
	  <td width="30%" class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['th']['project'];?>
</td>
      <td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['th']['edit'];?>
</td>
      <td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['th']['del'];?>
</td>
    </tr>
    <?php if ($_smarty_tpl->getVariable('activity_list')->value){?>
    <?php  $_smarty_tpl->tpl_vars['activity'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('activity_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['activity']->key => $_smarty_tpl->tpl_vars['activity']->value){
?>
    <tr valign="top" bgcolor="<?php echo smarty_function_cycle(array('values'=>"#f5f5f5,#dedee5"),$_smarty_tpl);?>
">
		<td><?php echo $_smarty_tpl->tpl_vars['activity']->value['a_code'];?>
</td>
    	<td><?php echo $_smarty_tpl->tpl_vars['activity']->value['a_name'];?>
</td>
		<td>
    	<?php if ($_smarty_tpl->tpl_vars['activity']->value['aprojects_all']){?>
    		<?php echo $_smarty_tpl->getVariable('i18n')->value['controls']['all'];?>

    	<?php }else{ ?>
	    	<?php if ($_smarty_tpl->tpl_vars['activity']->value['aprojects']){?>
		    	<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['activity']->value['aprojects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
		    	<?php echo $_smarty_tpl->tpl_vars['project']->value['p_name'];?>
<br>
		    	<?php }} ?>
	    	<?php }else{ ?>
	    		<?php echo $_smarty_tpl->getVariable('i18n')->value['controls']['notbind'];?>

	    	<?php }?>
	   	<?php }?>
    	</td>
    	<td><a href="activity_edit.php?act_id=<?php echo $_smarty_tpl->tpl_vars['activity']->value['a_id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['forward']['edit'];?>
</a></td>
       	<td><a href="activity_delete.php?act_id=<?php echo $_smarty_tpl->tpl_vars['activity']->value['a_id'];?>
"><?php echo $_smarty_tpl->getVariable('i18n')->value['forward']['delete'];?>
</a></td>
    </tr>
    <?php }} ?>
    <?php }?>
    </table>
    
    <table width="100%">
    <tr>
      <td align="center">
        <br>
       <form>
         <input type="button" onclick="chLocation('activity_add.php');" value="<?php echo $_smarty_tpl->getVariable('i18n')->value['button']['act_add'];?>
">
        </form>
      </td>
    </tr>
  	</table>
  	
  <?php }else{ ?>
  
    <table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
    <tr>
      <td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['th']['name'];?>
</td>
      <td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['activity']['th']['project'];?>
</td>
    </tr>
    <?php if ($_smarty_tpl->getVariable('activity_list')->value){?>
    <?php  $_smarty_tpl->tpl_vars['activity'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('activity_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['activity']->key => $_smarty_tpl->tpl_vars['activity']->value){
?>
    <tr valign="top" bgcolor="<?php echo smarty_function_cycle(array('values'=>"#f5f5f5,#dedee5"),$_smarty_tpl);?>
">
    	<td><?php echo $_smarty_tpl->tpl_vars['activity']->value['a_name'];?>
</td>
    	<td>
    	<?php if ($_smarty_tpl->tpl_vars['activity']->value['aprojects_all']){?>
    		<?php echo $_smarty_tpl->getVariable('i18n')->value['controls']['all'];?>

    	<?php }else{ ?>
	    	<?php if ($_smarty_tpl->tpl_vars['activity']->value['aprojects']){?>
		    	<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['activity']->value['aprojects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
		    	<?php echo $_smarty_tpl->tpl_vars['project']->value['p_name'];?>
<br>
		    	<?php }} ?>
	    	<?php }else{ ?>
	    		<?php echo $_smarty_tpl->getVariable('i18n')->value['controls']['notbind'];?>

	    	<?php }?>
	    <?php }?>
    	</td>
    </tr>
    <?php }} ?>
    <?php }?>
    </table>
  <?php }?>
  
  </td>
  </tr>
</table>
<?php echo $_smarty_tpl->getVariable('forms')->value['activityForm']['close'];?>
