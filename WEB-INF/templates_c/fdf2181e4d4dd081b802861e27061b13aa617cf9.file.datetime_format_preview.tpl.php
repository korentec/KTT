<?php /* Smarty version Smarty-3.0.7, created on 2016-04-03 07:03:28
         compiled from "/home/korentecco/public_html/ktt/WEB-INF/templates/datetime_format_preview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7080095945701069004ae11-85048719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fdf2181e4d4dd081b802861e27061b13aa617cf9' => 
    array (
      0 => '/home/korentecco/public_html/ktt/WEB-INF/templates/datetime_format_preview.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7080095945701069004ae11-85048719',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script>
function MakeFormatPreview(id, selectElement)
{
  var dst = document.getElementById(id);
  if (dst) {
    var date = new Date();
    date.locale = "<?php echo $_smarty_tpl->getVariable('user')->value->lang;?>
";
    var format;
    if (selectElement.value != "") {
      format = selectElement.value;
    } else {
      format = selectElement.options[0].text;
    }
    dst.innerHTML = "<i>" + date.strftime(format) + "</i>";
  }
}
</script>
