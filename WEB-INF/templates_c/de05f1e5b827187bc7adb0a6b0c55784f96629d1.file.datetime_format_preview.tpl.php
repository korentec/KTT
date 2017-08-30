<?php /* Smarty version Smarty-3.0.7, created on 2016-02-18 17:15:11
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs/WEB-INF/templates\datetime_format_preview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2245556c5dfffd5a701-68250579%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de05f1e5b827187bc7adb0a6b0c55784f96629d1' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs/WEB-INF/templates\\datetime_format_preview.tpl',
      1 => 1446137723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2245556c5dfffd5a701-68250579',
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
