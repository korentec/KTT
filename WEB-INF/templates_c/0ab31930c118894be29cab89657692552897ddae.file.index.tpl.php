<?php /* Smarty version Smarty-3.0.7, created on 2016-02-17 13:47:44
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2297956c45de04cb022-48944495%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ab31930c118894be29cab89657692552897ddae' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\index.tpl',
      1 => 1455031752,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2297956c45de04cb022-48944495',
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