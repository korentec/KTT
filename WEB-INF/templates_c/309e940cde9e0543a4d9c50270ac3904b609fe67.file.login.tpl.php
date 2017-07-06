<?php /* Smarty version Smarty-3.0.7, created on 2016-02-17 13:47:44
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1368956c45de0e25a22-31398122%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '309e940cde9e0543a4d9c50270ac3904b609fe67' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\login.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1368956c45de0e25a22-31398122',
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