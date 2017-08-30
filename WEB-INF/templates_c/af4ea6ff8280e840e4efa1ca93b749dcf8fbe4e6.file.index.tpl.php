<?php /* Smarty version Smarty-3.0.7, created on 2016-03-24 06:59:19
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146690339456f3d69704d6b5-84338321%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af4ea6ff8280e840e4efa1ca93b749dcf8fbe4e6' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/index.tpl',
      1 => 1455031752,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146690339456f3d69704d6b5-84338321',
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