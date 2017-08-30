<?php /* Smarty version Smarty-3.0.7, created on 2016-03-27 02:30:12
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142290367156f78c046e3d58-85207783%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '935fd2b3c719d381c2b7d606b4cb9fa6be1d149f' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/mobile/login.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142290367156f78c046e3d58-85207783',
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
      <?php $_template = new Smarty_Internal_Template("mobile/login.".(@AUTH_MODULE).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
      <?php echo $_smarty_tpl->getVariable('forms')->value['loginForm']['close'];?>
    </td>
  </tr>
</table>