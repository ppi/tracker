{if $aFields|@count > 0}
<table>
	<tr>
		<th>Name</th>
		<th>Label</th>
		<th>Type</th>
		<th></th>
		<th></th>
	</tr>
{/if}
{foreach from=$aFields item=aField}
	<tr>
		<td>{$aField.name}</td>
		<td>{$aField.label}</td>
		<td>{$aField.type}</td>
		<td></td>
		<td></td>
	</tr>
{foreachelse}
<p style="margin: 0;">You have no fields created</p>
{/foreach}
{if $aFields|@count > 0}
</table>
{/if}