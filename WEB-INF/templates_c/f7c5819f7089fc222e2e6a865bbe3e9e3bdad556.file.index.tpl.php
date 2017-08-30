<?php /* Smarty version Smarty-3.0.7, created on 2016-03-24 08:48:35
         compiled from "C:\wamp64\www\ktt/WEB-INF/templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2412156f3a9e3d9ed35-50346992%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7c5819f7089fc222e2e6a865bbe3e9e3bdad556' => 
    array (
      0 => 'C:\\wamp64\\www\\ktt/WEB-INF/templates\\index.tpl',
      1 => 1455031752,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2412156f3a9e3d9ed35-50346992',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<?php if ($_smarty_tpl->getVariable('content_page_name')->value){?><?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('content_page_name')->value), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?><?php }?>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>