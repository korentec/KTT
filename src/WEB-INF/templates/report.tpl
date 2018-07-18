<script>

  function chLocation(newLocation) { 
    document.location = newLocation; 
  }
  
  function checkAllApproved(bool) {
    event.preventDefault();
    const approveds = document.getElementsByName('approved[]');
    approveds.forEach(approved => {
      approved.checked = bool;
    });
  }

</script>

{$forms.reportForm.open}
<table width="720">
  <td valign="top">
    <table border="0" cellpadding="3" cellspacing="1" width="100%">
      <tr>
        <td valign="top" class="sectionHeaderNoBorder" align="center">{$i18n.form.report.export} <a href="tofile.php?type=xml">XML</a> {$i18n.label.or} <a href="tofile.php?type=csv">CSV</a></td>
      </tr>
    </table>
    <table border="0" cellpadding="3" cellspacing="1" width="100%">
<!-- totals only report -->
{if $bean->getAttribute('chtotalsonly')}
      <tr>
        <td class="tableHeader">{$group_by_header|escape:'html'}</td>
        {if $bean->getAttribute('chduration')}<td class="tableHeaderCentered" width="5%">{$i18n.label.duration}</td>{/if}
        {if $bean->getAttribute('chcost')}<td class="tableHeaderCentered" width="5%">{$i18n.label.cost}</td>{/if}
      </tr>
  {foreach $subtotals as $subtotal}
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{if $subtotal['name']}{$subtotal['name']|escape:'html'}{else}&nbsp;{/if}</td>
        {if $bean->getAttribute('chduration')}<td class="cellRightAlignedSubtotal">{$subtotal['time']}</td>{/if}
        {if $bean->getAttribute('chcost')}<td class="cellRightAlignedSubtotal">{if $user->canManageTeam() || $user->isClient()}{$subtotal['cost']}{else}{$subtotal['expenses']}{/if}</td>{/if}
      </tr>
  {/foreach}
      <!-- print totals -->
      <tr><td>&nbsp;</td></tr>
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{$i18n.label.total}</td>
        {if $bean->getAttribute('chduration')}<td nowrap class="cellRightAlignedSubtotal">{$totals['time']}</td>{/if}
        {if $bean->getAttribute('chcost')}<td nowrap class="cellRightAlignedSubtotal">{$user->currency|escape:'html'} {if $user->canManageTeam() || $user->isClient()}{$totals['cost']}{else}{$totals['expenses']}{/if}</td>{/if}
      </tr>
{else}
<!-- normal report -->    
      <tr>
       <td class="tableHeaderCentered">{$i18n.label.date}</td>
  {if $user->canManageTeam() || $user->isClient()}<td class="tableHeaderCentered">{$i18n.label.user}</td>{/if}
  {if $bean->getAttribute('chclient')}<td class="tableHeaderCentered">{$i18n.label.client}</td>{/if}
  {if $bean->getAttribute('chproject')}<td class="tableHeaderCentered">{$i18n.label.project}</td>{/if}
  {if $bean->getAttribute('chactivity')}<td class="tableHeaderCentered">פעילות</td>{/if}
  {if $bean->getAttribute('chtask')}<td class="tableHeaderCentered">{$i18n.label.task}</td>{/if}
  {if $bean->getAttribute('chcf_1')}<td class="tableHeaderCentered">{$custom_fields->fields[0]['label']|escape:'html'}</td>{/if}
  {if $bean->getAttribute('chstart')}<td class="tableHeaderCentered" width="5%">{$i18n.label.start}</td>{/if}
  {if $bean->getAttribute('chfinish')}<td class="tableHeaderCentered" width="5%">{$i18n.label.finish}</td>{/if}
  {if $bean->getAttribute('chduration')}<td class="tableHeaderCentered" width="5%">{$i18n.label.duration}</td>{/if}
  <td class="tableHeaderCentered" width="10%">{$i18n.label.location}</td>
 
  {if $bean->getAttribute('chnote')}<td class="tableHeader">{$i18n.label.note}</td>{/if}
  {if $bean->getAttribute('chcost')}<td class="tableHeaderCentered" width="5%">{$i18n.label.cost}</td>{/if}
  {if $bean->getAttribute('chinvoice')}<td class="tableHeader">{$i18n.label.invoice}</td>{/if}  
  <td class="tableHeaderCentered"width="18%">
      <div>{$i18n.label.approved}</div>
      {if $user->isCoManager() || $user->isManager()}
        <div style="font-weight: normal;">
          <a href="#" onclick="checkAllApproved(true)">{$i18n.label.select_all}</a>&nbsp;/&nbsp;
          <a href="#" onclick="checkAllApproved(false)">{$i18n.label.select_none}</a>
        </div>
      {/if}
  </td>
  </tr>
  {foreach $report_items as $item}
    <!-- print subtotal for a block of grouped values -->
    {$cur_date = $item.date}      
    {if $print_subtotals}
      {$cur_grouped_by = $item.grouped_by}
      {if $cur_grouped_by != $prev_grouped_by && !$first_pass}
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{$i18n.label.subtotal}
        {if $user->canManageTeam() || $user->isClient()}<td class="cellLeftAlignedSubtotal">{if $group_by == 'user'}{$subtotals[$prev_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
        {if $bean->getAttribute('chclient')}<td class="cellLeftAlignedSubtotal">{if $group_by == 'client'}{$subtotals[$prev_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
        {if $bean->getAttribute('chproject')}<td class="cellLeftAlignedSubtotal">{if $group_by == 'project'}{$subtotals[$prev_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
        {if $bean->getAttribute('chactivity')}<td class="cellLeftAlignedSubtotal">{if $group_by == 'a_name'}{$subtotals[$prev_grouped_by]['name']}</td>{/if}{/if}
        {if $bean->getAttribute('chtask')}<td class="cellLeftAlignedSubtotal">{if $group_by == 'task'}{$subtotals[$prev_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
        {if $bean->getAttribute('chcf_1')}<td class="cellLeftAlignedSubtotal">{if $group_by == 'cf_1'}{$subtotals[$prev_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
        {if $bean->getAttribute('chstart')}<td></td>{/if}
        {if $bean->getAttribute('chfinish')}<td></td>{/if}
        {if $bean->getAttribute('chduration')}<td class="cellRightAlignedSubtotal">{$subtotals[$prev_grouped_by]['time']}</td>{/if}
        <td></td>
      
        {if $bean->getAttribute('chnote')}<td></td>{/if}
        {if $bean->getAttribute('chcost')}<td class="cellRightAlignedSubtotal">{if $user->canManageTeam() || $user->isClient()}{$subtotals[$prev_grouped_by]['cost']}{else}{$subtotals[$prev_grouped_by]['expenses']}{/if}</td>{/if}
        {if $bean->getAttribute('chinvoice')}<td></td>{/if}
      </tr>
      <tr><td>&nbsp;</td></tr>
      {/if}
    {$first_pass = false} 
    {/if}
      <!--  print regular row --> 
      {if $cur_date != $prev_date}
        {if $report_row_class == 'rowReportItem'} {$report_row_class = 'rowReportItemAlt'} {else} {$report_row_class = 'rowReportItem'} {/if}
      {/if}
      <tr class="{$report_row_class}">
        <td class="cellLeftAligned">{$item.date}</td>
    {if $user->canManageTeam() || $user->isClient()}<td class="cellLeftAligned">{$item.user|escape:'html'}</td>{/if}
    {if $bean->getAttribute('chclient')}<td class="cellLeftAligned">{$item.client|escape:'html'}</td>{/if}
    {if $bean->getAttribute('chproject')}<td class="cellRightAligned">{$item.project|escape:'html'}</td>{/if}
    {if $bean->getAttribute('chactivity')}<td class="cellRightAligned">{$item.a_name}</td>{/if}
    {if $bean->getAttribute('chtask')}<td class="cellLeftAligned">{$item.task|escape:'html'}</td>{/if}
     
    {if $bean->getAttribute('chcf_1')}<td class="cellLeftAligned">{$item.cf_1|escape:'html'}</td>{/if}
    {if $bean->getAttribute('chstart')}<td nowrap class="cellRightAligned">{$item.start} {if 1==$item.start_dirty}(*){/if}</td>{/if}
    {if $bean->getAttribute('chfinish')}<td nowrap class="cellRightAligned">{$item.finish}{if 1==$item.duration_dirty}(*){/if}</td>{/if}
    {if $bean->getAttribute('chduration')}<td class="cellRightAligned">{$item.duration}</td>{/if}
    <td class="cellRightAligned">{$item.l_name}</td>
   
    {if $bean->getAttribute('chnote')}<td class="cellRightAligned">{$item.note|escape:'html'}</td>{/if}
    {if $bean->getAttribute('chcost')}<td class="cellRightAligned">{if $user->canManageTeam() || $user->isClient()}{$item.cost}{else}{$item.expense}{/if}</td>{/if}
    {if $bean->getAttribute('chinvoice')}
        <td class="cellRightAligned">{$item.invoice|escape:'html'}</td>
      {if $use_checkboxes}
        {if 1 == $item.type}<td bgcolor="white"><input type="checkbox" name="log_id_{$item.id}"></td>{/if}
        {if 2 == $item.type}<td bgcolor="white"><input type="checkbox" name="item_id_{$item.id}"></td>{/if}
      {/if}
    {/if}
    <td style="text-align: center;">
    {if $user->isCoManager() || $user->isManager()}    
        <input type="checkbox" name="approved[]" value="{$item.id}" {if 1==$item.approved}checked{/if}>
        <input type="hidden" name="hdn_log_id_{$item.id}">    
    {elseif 1==$item.approved}
        <span style="font-family:webdings;font-size:18pt;">a</span>
    {/if}
    </td>
    </tr>
    {$prev_date = $item.date}
    {if $print_subtotals} {$prev_grouped_by = $item.grouped_by} {/if}
  {/foreach}
  <!-- print a terminating subtotal -->
  {if $print_subtotals}      
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{$i18n.label.subtotal}
    {if $user->canManageTeam() || $user->isClient()}<td class="cellLeftAlignedSubtotal">{if $group_by == 'user'}{$subtotals[$cur_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
    {if $bean->getAttribute('chclient')}<td class="cellLeftAlignedSubtotal">{if $group_by == 'client'}{$subtotals[$cur_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
    {if $bean->getAttribute('chproject')}<td class="cellLeftAlignedSubtotal">{if $group_by == 'project'}{$subtotals[$cur_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
    {if $bean->getAttribute('chtask')}<td class="cellLeftAlignedSubtotal">{if $group_by == 'task'}{$subtotals[$cur_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
    {if $bean->getAttribute('chcf_1')}<td class="cellLeftAlignedSubtotal">{if $group_by == 'cf_1'}{$subtotals[$cur_grouped_by]['name']|escape:'html'}</td>{/if}{/if}
    {if $bean->getAttribute('chstart')}<td></td>{/if}
    {if $bean->getAttribute('chfinish')}<td></td>{/if}
    {if $bean->getAttribute('chduration')}<td class="cellRightAlignedSubtotal">{$subtotals[$cur_grouped_by]['time']}</td>{/if}
       <td></td>
    {if $bean->getAttribute('chnote')}<td></td>{/if}
    {if $bean->getAttribute('chcost')}<td class="cellRightAlignedSubtotal">{if $user->canManageTeam() || $user->isClient()}{$subtotals[$cur_grouped_by]['cost']}{else}{$subtotals[$cur_grouped_by]['expenses']}{/if}</td>{/if}
    {if $bean->getAttribute('chinvoice')}<td></td>{/if}
      </tr>
  {/if}
  <!-- print totals -->
      <tr><td>&nbsp;</td></tr>
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{$i18n.label.total}</td>
    {if $user->canManageTeam() || $user->isClient()}<td></td>{/if}
    {if $bean->getAttribute('chclient')}<td></td>{/if}
    {if $bean->getAttribute('chproject')}<td></td>{/if}
    {if $bean->getAttribute('chactivity')}<td></td>{/if}
    {if $bean->getAttribute('chtask')}<td></td>{/if}
    {if $bean->getAttribute('chcf_1')}<td></td>{/if}
    {if $bean->getAttribute('chstart')}<td></td>{/if}
    {if $bean->getAttribute('chfinish')}<td></td>{/if}
    {if $bean->getAttribute('chduration')}<td class="cellRightAlignedSubtotal">{$totals['time']}</td>{/if}
       <td></td>
    {if $bean->getAttribute('chnote')}<td></td>{/if}
    {if $bean->getAttribute('chcost')}<td nowrap class="cellRightAlignedSubtotal">{$user->currency|escape:'html'} {if $user->canManageTeam() || $user->isClient()}{$totals['cost']}{else}{$totals['expenses']}{/if}</td>{/if}
    {if $bean->getAttribute('chinvoice')}<td></td>{/if}
    <td></td>
      </tr>
{/if}
    </table>
  </td>
</tr>
</table>
{if $use_checkboxes && $report_items}
<table width="720" cellspacing="4" cellpadding="4" border="0">
  <tr>
    <td align="right">
      <table>
        <tr><td>{$forms.reportForm.recent_invoice.control} {$forms.reportForm.btn_submit.control}</td></tr>
      </table>
    </td>
  </tr>
</table>
{/if}


<table width="720" cellspacing="4" cellpadding="4" border="0">
<tr>
  <td align="center">
  <table>
  <tr>
    <td><input type="button" onclick="chLocation('report_send.php');" value="{$i18n.button.send_by_email}"></td>
    {if $user->isCoManager() || $user->isManager()}<td><input type="submit" name="btnSave" value="{$i18n.button.save}"></td>{/if}
  </tr>
  </table>
  </td>
</tr>
</table>
{$forms.reportForm.close}