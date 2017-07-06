<?php /* Smarty version Smarty-3.0.7, created on 2016-03-24 06:59:19
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17246552356f3d6971d0962-17414216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6243d97f8383019e36c62ca63757cc2a66cdfba' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/login.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17246552356f3d6971d0962-17414216',
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