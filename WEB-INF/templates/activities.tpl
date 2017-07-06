{literal}
<script>
    function chLocation(newLocation) { document.location = newLocation; }
</script>
{/literal}

{$forms.activityForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
  <td valign="top">

  <div style="padding:0 0 10 0;">
  <table border="0" bgcolor="#efefef" width="720"><tr><td>
	  <table cellspacing="1" cellpadding="3" border="0">
	    <tr>
	      <td colspan="2"><b>{$i18n.label.filter}:</b></td>
	      <td>&nbsp;</td>
	    </tr>
	    <tr>
	      <td>{$i18n.form.filter.project}:</td><td>{$forms.activityForm.f_project.control}</td>
	      <td><noscript>{$forms.activityForm.btsubmit.control}</noscript></td>
	    </tr>
	  </table>
  </td></tr></table>
  </div>
  
  {if ($user->isManager() || $user->isCoManager())}
	<table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
    <tr>
	  <td width="10%" class="tableHeader">{$i18n.form.activity.th.code}</td>
      <td width="40%" class="tableHeader">{$i18n.form.activity.th.name}</td>
	  <td width="30%" class="tableHeader">{$i18n.form.activity.th.project}</td>
      <td class="tableHeader">{$i18n.form.activity.th.edit}</td>
      <td class="tableHeader">{$i18n.form.activity.th.del}</td>
    </tr>
    {if $activity_list}
    {foreach from=$activity_list item=activity}
    <tr valign="top" bgcolor="{cycle values="#f5f5f5,#dedee5"}">
		<td>{$activity.a_code}</td>
    	<td>{$activity.a_name}</td>
		<td>
    	{if $activity.aprojects_all}
    		{$i18n.controls.all}
    	{else}
	    	{if $activity.aprojects}
		    	{foreach from=$activity.aprojects item=project}
		    	{$project.p_name}<br>
		    	{/foreach}
	    	{else}
	    		{$i18n.controls.notbind}
	    	{/if}
	   	{/if}
    	</td>
    	<td><a href="activity_edit.php?act_id={$activity.a_id}">{$i18n.forward.edit}</a></td>
       	<td><a href="activity_delete.php?act_id={$activity.a_id}">{$i18n.forward.delete}</a></td>
    </tr>
    {/foreach}
    {/if}
    </table>
    
    <table width="100%">
    <tr>
      <td align="center">
        <br>
       <form>
         <input type="button" onclick="chLocation('activity_add.php');" value="{$i18n.button.act_add}">
        </form>
      </td>
    </tr>
  	</table>
  	
  {else}
  
    <table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
    <tr>
      <td class="tableHeader">{$i18n.form.activity.th.name}</td>
      <td class="tableHeader">{$i18n.form.activity.th.project}</td>
    </tr>
    {if $activity_list}
    {foreach from=$activity_list item=activity}
    <tr valign="top" bgcolor="{cycle values="#f5f5f5,#dedee5"}">
    	<td>{$activity.a_name}</td>
    	<td>
    	{if $activity.aprojects_all}
    		{$i18n.controls.all}
    	{else}
	    	{if $activity.aprojects}
		    	{foreach from=$activity.aprojects item=project}
		    	{$project.p_name}<br>
		    	{/foreach}
	    	{else}
	    		{$i18n.controls.notbind}
	    	{/if}
	    {/if}
    	</td>
    </tr>
    {/foreach}
    {/if}
    </table>
  {/if}
  
  </td>
  </tr>
</table>
{$forms.activityForm.close}