<?php /* Smarty version Smarty-3.0.7, created on 2016-03-24 08:48:36
         compiled from "C:\wamp64\www\ktt/WEB-INF/templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150356f3a9e4616f89-63494656%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '523fb20b23661b64981b4c78b1bf38b858ebd999' => 
    array (
      0 => 'C:\\wamp64\\www\\ktt/WEB-INF/templates\\login.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150356f3a9e4616f89-63494656',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script>
<!--
function get_date() {
  var date = new Date();
  return date.strftime("%Y-%m-%d");
}
//-->
</script>
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <?php echo $_smarty_tpl->getVariable('forms')->value['loginForm']['open'];?>
      <?php $_template = new Smarty_Internal_Template("login.".(@AUTH_MODULE).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
      <?php echo $_smarty_tpl->getVariable('forms')->value['loginForm']['close'];?>
    </td>
  </tr>
</table>
<?php if (!empty($_smarty_tpl->getVariable('about_text',null,true,false)->value)){?>
  <div id="LoginAboutText"> <?php echo $_smarty_tpl->getVariable('about_text')->value;?>
 </div>
<?php }?>