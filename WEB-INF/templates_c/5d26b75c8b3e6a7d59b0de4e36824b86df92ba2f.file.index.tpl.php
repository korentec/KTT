<?php /* Smarty version Smarty-3.0.7, created on 2016-03-27 02:30:12
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38373187956f78c0463b217-55573015%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d26b75c8b3e6a7d59b0de4e36824b86df92ba2f' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/index.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38373187956f78c0463b217-55573015',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("mobile/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<?php if ($_smarty_tpl->getVariable('content_page_name')->value){?><?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('content_page_name')->value), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?><?php }?>