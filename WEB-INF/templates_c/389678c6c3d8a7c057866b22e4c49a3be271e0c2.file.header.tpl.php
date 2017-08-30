<?php /* Smarty version Smarty-3.0.7, created on 2016-03-27 02:30:12
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:193397938656f78c0467eac4-62262371%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '389678c6c3d8a7c057866b22e4c49a3be271e0c2' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/header.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193397938656f78c0467eac4-62262371',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo @CHARSET;?>
">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  <link href="../<?php echo @DEFAULT_CSS;?>
" rel="stylesheet" type="text/css">
<?php if ($_smarty_tpl->getVariable('i18n')->value['language']['rtl']){?>
  <link href="../<?php echo @RTL_CSS;?>
" rel="stylesheet" type="text/css">
<?php }?>
  <title>Time Tracker<?php if ($_smarty_tpl->getVariable('title')->value){?> - <?php echo $_smarty_tpl->getVariable('title')->value;?>
<?php }?></title>
  <script src="../js/strftime.js"></script>
  <script>
    <?php echo $_smarty_tpl->getVariable('js_date_locale')->value;?>
  </script>
  <script src="../js/strptime.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" <?php echo $_smarty_tpl->getVariable('onload')->value;?>
>

<?php $_smarty_tpl->tpl_vars["tab_width"] = new Smarty_variable("300", null, null);?>

<table height="100%" cellspacing="0" cellpadding="0" width="320" border="0">
  <tr>
    <td valign="top" align="center"> <!-- This is to centrally align all our content. -->

      <!-- Top image -->
      <table cellspacing="0" cellpadding="0" width="100%" border="0">
        <tr>
<?php if ($_smarty_tpl->getVariable('user')->value->custom_logo){?>
          <td align="center">
<?php }else{ ?>
          <td bgcolor="#a6ccf7" background="../images/top_bg.gif" align="center">
<?php }?>
            <table cellspacing="0" cellpadding="0" width="<?php echo $_smarty_tpl->getVariable('tab_width')->value;?>
" border="0">
              <tr>
                <td valign="top">
                  <table cellspacing="0" cellpadding="0" width="100%" border="0">
                    <tr><td height="6" colspan="2"><img width="1" height="6" src="../images/1x1.gif" border="0"></td></tr>
                    <tr valign="top">
<?php if ($_smarty_tpl->getVariable('user')->value->custom_logo){?>
                      <td height="55" align="center"><img alt="Time Tracker" width="300" height="43" src="<?php echo $_smarty_tpl->getVariable('mobile_custom_logo')->value;?>
" border="0"></td>
<?php }else{ ?>
                      <td height="55" align="center"><img alt="Anuko Time Tracker" width="300" height="43" src="../images/tt_logo.png" border="0"></td>
<?php }?>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- End of top image -->

      <!-- Output errors -->
<?php if (!$_smarty_tpl->getVariable('errors')->value->isEmpty()){?>
      <table cellspacing="4" cellpadding="7" width="<?php echo $_smarty_tpl->getVariable('tab_width')->value;?>
" border="0">
        <tr>
          <td class="error">
  <?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors')->value->getErrors(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
?>
            <?php echo $_smarty_tpl->tpl_vars['error']->value['message'];?>
<br> 
  <?php }} ?>
          </td>
        </tr>
      </table>
<?php }?>
      <!-- End of output errors -->

      <!-- Output messages -->
<?php if (!$_smarty_tpl->getVariable('messages')->value->isEmpty()){?>
      <table cellspacing="4" cellpadding="7" width="<?php echo $_smarty_tpl->getVariable('tab_width')->value;?>
" border="0">
        <tr>
          <td class="info_message">
  <?php  $_smarty_tpl->tpl_vars['message'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('messages')->value->getErrors(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['message']->key => $_smarty_tpl->tpl_vars['message']->value){
?>
            <?php echo $_smarty_tpl->tpl_vars['message']->value['message'];?>
<br> 
  <?php }} ?>
          </td>
        </tr>
      </table>
<?php }?>
      <!-- End of output messages -->