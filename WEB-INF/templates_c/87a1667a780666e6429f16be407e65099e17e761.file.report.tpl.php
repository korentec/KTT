<?php /* Smarty version Smarty-3.0.7, created on 2016-05-25 06:07:42
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20274971265745877eecfaf3-52476309%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87a1667a780666e6429f16be407e65099e17e761' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/report.tpl',
      1 => 1464174141,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20274971265745877eecfaf3-52476309',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/korentecco/public_html/ktt/WEB-INF/lib/smarty/plugins/modifier.escape.php';
?><script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['open'];?>

<table width="720">
  <td valign="top">
    <table border="0" cellpadding="3" cellspacing="1" width="100%">
      <tr>
        <td valign="top" class="sectionHeaderNoBorder" align="center"><?php echo $_smarty_tpl->getVariable('i18n')->value['form']['report']['export'];?>
 <a href="tofile.php?type=xml">XML</a> <?php echo $_smarty_tpl->getVariable('i18n')->value['label']['or'];?>
 <a href="tofile.php?type=csv">CSV</a></td>
      </tr>
    </table>
    <table border="0" cellpadding="3" cellspacing="1" width="100%">
<!-- totals only report -->
<?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chtotalsonly')){?>
      <tr>
        <td class="tableHeader"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('group_by_header')->value,'html');?>
</td>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chduration')){?><td class="tableHeaderCentered" width="5%"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['duration'];?>
</td><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcost')){?><td class="tableHeaderCentered" width="5%"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['cost'];?>
</td><?php }?>
      </tr>
  <?php  $_smarty_tpl->tpl_vars['subtotal'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('subtotals')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['subtotal']->key => $_smarty_tpl->tpl_vars['subtotal']->value){
?>
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->tpl_vars['subtotal']->value['name']){?><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['subtotal']->value['name'],'html');?>
<?php }else{ ?>&nbsp;<?php }?></td>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chduration')){?><td class="cellRightAlignedSubtotal"><?php echo $_smarty_tpl->tpl_vars['subtotal']->value['time'];?>
</td><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcost')){?><td class="cellRightAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><?php echo $_smarty_tpl->tpl_vars['subtotal']->value['cost'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['subtotal']->value['expenses'];?>
<?php }?></td><?php }?>
      </tr>
  <?php }} ?>
      <!-- print totals -->
      <tr><td>&nbsp;</td></tr>
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['total'];?>
</td>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chduration')){?><td nowrap class="cellRightAlignedSubtotal"><?php echo $_smarty_tpl->getVariable('totals')->value['time'];?>
</td><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcost')){?><td nowrap class="cellRightAlignedSubtotal"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('user')->value->currency,'html');?>
 <?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><?php echo $_smarty_tpl->getVariable('totals')->value['cost'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('totals')->value['expenses'];?>
<?php }?></td><?php }?>
      </tr>
<?php }else{ ?>
<!-- normal report -->    
      <tr>
        <td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['date'];?>
</td>
  <?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['user'];?>
</td><?php }?>
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chclient')){?><td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['client'];?>
</td><?php }?>
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chproject')){?><td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['project'];?>
</td><?php }?>
   <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chactivity')){?><td class="tableHeader">פעילות</td><?php }?>
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chtask')){?><td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['task'];?>
</td><?php }?>
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcf_1')){?><td class="tableHeader"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('custom_fields')->value->fields[0]['label'],'html');?>
</td><?php }?>
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chstart')){?><td class="tableHeaderCentered" width="5%"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['start'];?>
</td><?php }?>
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chfinish')){?><td class="tableHeaderCentered" width="5%"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['finish'];?>
</td><?php }?>
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chduration')){?><td class="tableHeaderCentered" width="5%"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['duration'];?>
</td><?php }?>
      <td class="tableHeaderCentered"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['location'];?>
</td>
 
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chnote')){?><td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['note'];?>
</td><?php }?>
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcost')){?><td class="tableHeaderCentered" width="5%"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['cost'];?>
</td><?php }?>
  <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chinvoice')){?><td class="tableHeader"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['invoice'];?>
</td><?php }?>    
      </tr>
  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('report_items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
    <!-- print subtotal for a block of grouped values -->
    <?php $_smarty_tpl->tpl_vars['cur_date'] = new Smarty_variable($_smarty_tpl->tpl_vars['item']->value['date'], null, null);?>      
    <?php if ($_smarty_tpl->getVariable('print_subtotals')->value){?>
      <?php $_smarty_tpl->tpl_vars['cur_grouped_by'] = new Smarty_variable($_smarty_tpl->tpl_vars['item']->value['grouped_by'], null, null);?>
      <?php if ($_smarty_tpl->getVariable('cur_grouped_by')->value!=$_smarty_tpl->getVariable('prev_grouped_by')->value&&!$_smarty_tpl->getVariable('first_pass')->value){?>
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['subtotal'];?>

        <?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='user'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('prev_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chclient')){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='client'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('prev_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chproject')){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='project'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('prev_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
           <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chactivity')){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='a_name'){?><?php echo $_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('prev_grouped_by')->value]['name'];?>
</td><?php }?><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chtask')){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='task'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('prev_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcf_1')){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='cf_1'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('prev_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chstart')){?><td></td><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chfinish')){?><td></td><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chduration')){?><td class="cellRightAlignedSubtotal"><?php echo $_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('prev_grouped_by')->value]['time'];?>
</td><?php }?>
        <td></td>
      
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chnote')){?><td></td><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcost')){?><td class="cellRightAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><?php echo $_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('prev_grouped_by')->value]['cost'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('prev_grouped_by')->value]['expenses'];?>
<?php }?></td><?php }?>
        <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chinvoice')){?><td></td><?php }?>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <?php }?>
    <?php $_smarty_tpl->tpl_vars['first_pass'] = new Smarty_variable(false, null, null);?> 
    <?php }?>
      <!--  print regular row --> 
      <?php if ($_smarty_tpl->getVariable('cur_date')->value!=$_smarty_tpl->getVariable('prev_date')->value){?>
        <?php if ($_smarty_tpl->getVariable('report_row_class')->value=='rowReportItem'){?> <?php $_smarty_tpl->tpl_vars['report_row_class'] = new Smarty_variable('rowReportItemAlt', null, null);?> <?php }else{ ?> <?php $_smarty_tpl->tpl_vars['report_row_class'] = new Smarty_variable('rowReportItem', null, null);?> <?php }?>
      <?php }?>
      <tr class="<?php echo $_smarty_tpl->getVariable('report_row_class')->value;?>
">
        <td class="cellLeftAligned"><?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
</td>
    <?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><td class="cellLeftAligned"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['item']->value['user'],'html');?>
</td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chclient')){?><td class="cellLeftAligned"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['item']->value['client'],'html');?>
</td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chproject')){?><td class="cellRightAligned"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['item']->value['project'],'html');?>
</td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chtask')){?><td class="cellLeftAligned"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['item']->value['task'],'html');?>
</td><?php }?>
     <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chactivity')){?><td class="cellRightAligned"> <?php echo $_smarty_tpl->tpl_vars['item']->value['a_name'];?>
</td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcf_1')){?><td class="cellLeftAligned"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['item']->value['cf_1'],'html');?>
</td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chstart')){?><td nowrap class="cellRightAligned"><?php echo $_smarty_tpl->tpl_vars['item']->value['start'];?>
</td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chfinish')){?><td nowrap class="cellRightAligned"><?php echo $_smarty_tpl->tpl_vars['item']->value['finish'];?>
</td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chduration')){?><td class="cellRightAligned"><?php echo $_smarty_tpl->tpl_vars['item']->value['duration'];?>
</td><?php }?>
    <td class="cellRightAligned"><?php echo $_smarty_tpl->tpl_vars['item']->value['l_name'];?>
</td>
   
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chnote')){?><td class="cellRightAligned"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['item']->value['note'],'html');?>
</td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcost')){?><td class="cellRightAligned"><?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><?php echo $_smarty_tpl->tpl_vars['item']->value['cost'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['expense'];?>
<?php }?></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chinvoice')){?>
        <td class="cellRightAligned"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['item']->value['invoice'],'html');?>
</td>
      <?php if ($_smarty_tpl->getVariable('use_checkboxes')->value){?>
        <?php if (1==$_smarty_tpl->tpl_vars['item']->value['type']){?><td bgcolor="white"><input type="checkbox" name="log_id_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"></td><?php }?>
        <?php if (2==$_smarty_tpl->tpl_vars['item']->value['type']){?><td bgcolor="white"><input type="checkbox" name="item_id_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"></td><?php }?>
      <?php }?>
    <?php }?>
      </tr>
    <?php $_smarty_tpl->tpl_vars['prev_date'] = new Smarty_variable($_smarty_tpl->tpl_vars['item']->value['date'], null, null);?>
    <?php if ($_smarty_tpl->getVariable('print_subtotals')->value){?> <?php $_smarty_tpl->tpl_vars['prev_grouped_by'] = new Smarty_variable($_smarty_tpl->tpl_vars['item']->value['grouped_by'], null, null);?> <?php }?>
  <?php }} ?>
  <!-- print a terminating subtotal -->
  <?php if ($_smarty_tpl->getVariable('print_subtotals')->value){?>      
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['subtotal'];?>

    <?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='user'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('cur_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chclient')){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='client'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('cur_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chproject')){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='project'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('cur_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chtask')){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='task'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('cur_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcf_1')){?><td class="cellLeftAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('group_by')->value=='cf_1'){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('cur_grouped_by')->value]['name'],'html');?>
</td><?php }?><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chstart')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chfinish')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chduration')){?><td class="cellRightAlignedSubtotal"><?php echo $_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('cur_grouped_by')->value]['time'];?>
</td><?php }?>
       <td></td>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chnote')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcost')){?><td class="cellRightAlignedSubtotal"><?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><?php echo $_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('cur_grouped_by')->value]['cost'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('subtotals')->value[$_smarty_tpl->getVariable('cur_grouped_by')->value]['expenses'];?>
<?php }?></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chinvoice')){?><td></td><?php }?>
      </tr>
  <?php }?>
  <!-- print totals -->
      <tr><td>&nbsp;</td></tr>
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal"><?php echo $_smarty_tpl->getVariable('i18n')->value['label']['total'];?>
</td>
    <?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chclient')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chproject')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chtask')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcf_1')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chstart')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chfinish')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chduration')){?><td class="cellRightAlignedSubtotal"><?php echo $_smarty_tpl->getVariable('totals')->value['time'];?>
</td><?php }?>
       <td></td>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chnote')){?><td></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chcost')){?><td nowrap class="cellRightAlignedSubtotal"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('user')->value->currency,'html');?>
 <?php if ($_smarty_tpl->getVariable('user')->value->canManageTeam()||$_smarty_tpl->getVariable('user')->value->isClient()){?><?php echo $_smarty_tpl->getVariable('totals')->value['cost'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('totals')->value['expenses'];?>
<?php }?></td><?php }?>
    <?php if ($_smarty_tpl->getVariable('bean')->value->getAttribute('chinvoice')){?><td></td><?php }?>
      </tr>
<?php }?>
    </table>
  </td>
</tr>
</table>
<?php if ($_smarty_tpl->getVariable('use_checkboxes')->value&&$_smarty_tpl->getVariable('report_items')->value){?>
<table width="720" cellspacing="4" cellpadding="4" border="0">
  <tr>
    <td align="right">
      <table>
        <tr><td><?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['recent_invoice']['control'];?>
 <?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['btn_submit']['control'];?>
</td></tr>
      </table>
    </td>
  </tr>
</table>
<?php }?>
<?php echo $_smarty_tpl->getVariable('forms')->value['reportForm']['close'];?>


<table width="720" cellspacing="4" cellpadding="4" border="0">
<tr>
  <td align="center">
  <table>
  <tr>
    <td><input type="button" onclick="chLocation('report_send.php');" value="<?php echo $_smarty_tpl->getVariable('i18n')->value['button']['send_by_email'];?>
"></td>
  </tr>
  </table>
  </td>
</tr>
</table>