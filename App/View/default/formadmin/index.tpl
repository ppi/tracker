<script>
{literal}
	$(document).ready(function() {
		$("#form_chooser").accordion({
			autoHeight: false
		});
		$('.formChoose').click(function() {
			var formName = $(this).html();
			$('#current_form').val(formName);			
			{/literal}
			$.get('{$baseUrl}formadmin/listfields/formname/' + formName, function(data)
			{literal}
			{
				$('#formadmin_content').html(data);
			});
		});

		$('.edit_form').click(function() {
		
			var formName = $(this).attr('id');
			{/literal}
			$.get('{$baseUrl}formadmin/getforminfo/formname/' + formName, function(data)
			{literal}
			{
				$('#formadmin_content').html(data);
			});			
		});		
			$.get('{/literal}{$baseUrl}formadmin/listfields/formname/' + $('#current_form').val(), function(data)
			{literal}
			{
				$('#formadmin_content').html(data);
			});		
	});
		function updateFormInfo() {
			$.post('{/literal}{$baseUrl}{literal}formadmin/getforminfo/formname/' + $('#current_form').val(),
					{
					title: $('#formadmin_getforminfo_title').val(), 
					name: $('#formadmin_getforminfo_name').val(),
					submit_text: $('#formadmin_getforminfo_submit_text').val(),
					table: $('#formadmin_getforminfo_table').val(),
					description: $('#formadmin_getforminfo_description').val()
					} 
			);
			return false;		
		}	
{/literal}
</script>
<div id="form_chooser" style="float: left; width:200px;">
{assign var=i value=0}
{foreach from=$aForms item=aForm}
	{assign var=i value=`$i+1`}
	{if $i == 1}
		{assign var=currentForm value=$aForm.name}
	{/if}		
	<h3 style="font-size: 12px;"><a href="#" class="formChoose" style="padding-bottm: 0px;">{$aForm.name}</a></h3>
	<ul><li><a id="{$aForm.name}" class="edit_form" href="#">Edit Form</a></li><li>Change Properties</li><li>Sort Fields</li></ul>
{/foreach}
<input type="hidden" id="current_form" value="{$currentForm}" />
</div>
<div id="formadmin_content" style="width: 70%; float: left; padding-left: 20px; border: 0px solid green;">&nbsp;dd</div>
<div style="clear: left;">&nbsp;</div>
<style type="text/css">
{literal}
#form_chooser h3 {
	margin: 0px;
}
#form_chooser ul li {
	font-size: 12px;
}
{/literal}
</style>