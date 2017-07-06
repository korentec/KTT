{$forms.activityForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tbody>
    <tr>
      <td>

          <table id="table1" cellspacing="1" cellpadding="2" border="0">
            <tr>
              <td align="right">{$i18n.form.activity.name} (*):</td>
              <td>{$forms.activityForm.name.control}</td>
            </tr>
			<tr>
              <td align="right">{$i18n.form.activity.code}:</td>
              <td>{$forms.activityForm.code.control}</td>
            </tr>
            <tr valign="top">
              <td align="right">{$i18n.form.people.projects}:</td>
              <td>{$forms.activityForm.projects.control}</td>
            </tr>
            <tr>
              <td></td>
              <td>{$i18n.label.req_fields}</td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="center" height="50">{$forms.activityForm.btsubmit.control}</td>
            </tr>
          </table>

      </td>
    </tr>
  </tbody>
</table>
{$forms.activityForm.close}