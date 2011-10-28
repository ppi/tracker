<div id="ppcontent">

    <table cellspacing="0" class="widefat fixed" id="admin_users_list">
        <thead>
        <tr class="thead">
        	<th style="" class="manage-column column-username" id="username" scope="col">Username</th>
        	<th style="" class="manage-column column-name" id="name" scope="col">Name</th>
        	<th style="" class="manage-column column-email" id="" scope="col">E-mail</th>
        	<th style="" class="manage-column column-role" id="role" scope="col">Role</th>
        	<th style="" class="manage-column column-posts num" id="posts" scope="col">Registered</th>
        </tr>
        </thead>


        <tbody class="list:user user-list">
            {foreach from=$users item=user}
            	<tr class="alternate" id="user-1">
                    <td class="username column-username">
                        <strong><a href="{$baseUrl}admin/user/view/{$user.id}">{$user.$usernameField}</a></strong><br />
                        <div class="row-actions">
                            <span class="edit"><a href="{$baseUrl}admin/user/edit/{$user.id}/schoolid/{$schoolID}">Edit</a></span>&nbsp;|
                            <span class="edit"><a onclick="return confirm('Are you sure?');" href="{$baseUrl}admin/user/delete/{$user.id}/schoolid/{$schoolID}">Delete</a>
                        </div>
                    </td>
                    <td class="name column-name">{$user.first_name} {$user.last_name}</td>
                    <td class="email column-email"><a title="e-mail: {$user.email}" href="mailto:{$user.email}">{$user.email}</a></td>
                    <td class="role column-role">{$user.role_name|ucfirst}</td>
                    <td class="posts column-posts num">{$user.created|date_format}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>

</div>
{literal}
<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function($) {
	oTable = $('#admin_users_list').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	});
});
</script>
{/literal}

