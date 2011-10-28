<div id="ppcontent">

    <table cellspacing="0" class="widefat fixed" id="admin_users_menu">
        <thead>
        <tr class="thead">
        	<th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox" /></th>
        	<th style="" class="manage-column column-username" id="username" scope="col">Username</th>
        	<th style="" class="manage-column column-name" id="name" scope="col">Name</th>
        	<th style="" class="manage-column column-email" id="email" scope="col">E-mail</th>
        	<th style="" class="manage-column column-role" id="role" scope="col">Role</th>
        	<th style="" class="manage-column column-posts num" id="posts" scope="col">Registered</th>
        </tr>
        </thead>

        <tfoot>
        <tr class="thead">
        	<th style="" class="manage-column column-cb check-column" scope="col"><input type="checkbox" /></th>
        	<th style="" class="manage-column column-username" scope="col">Username</th>
        	<th style="" class="manage-column column-name" scope="col">Name</th>
        	<th style="" class="manage-column column-email" scope="col">E-mail</th>
        	<th style="" class="manage-column column-role" scope="col">Role</th>
        	<th style="" class="manage-column column-posts num" scope="col">Registered</th>
        </tr>
        </tfoot>

        <tbody class="list:user user-list" id="users">

            <?php foreach($users as $user) { ?>

            	<tr class="alternate" id="user-1">
                    <th class="check-column" scope="row"><input type="checkbox" value="1" class="administrator" id="user_1" name="users[]" /></th>
                    <td class="username column-username">
                        <strong><a href="<?php echo $baseUrl; ?>admin/user/view/{$user.id}"><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></a></strong><br />
                        <div class="row-actions">
                            <span class="edit"><a href="<?php echo $baseUrl; ?>admin/user/edit/<?php echo $user['id'] ?>">Edit</a></span>&nbsp;|&nbsp;
                            <span class="edit"><a href="<?php echo $baseUrl; ?>admin/user/delete/<?php echo $user['id']; ?>">Delete</a>
                        </div>
                    </td>
                    <td class="name column-name"><?php echo $user['first_name'] ?> <?php echo $user['last_name']; ?></td>
                    <td class="email column-email"><a title="e-mail: <?php echo $user['email']; ?>" href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a></td>
                    <td class="role column-role"><?php echo ucfirst($user['role_name']); ?></td>
                    <td class="posts column-posts num"><?php echo date('d/m/Y', $user['created']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="tablenav">


    <div class="alignleft actions">
        <select name="action2">
            <option selected="selected" value="">Bulk Actions</option>
            <option value="delete">Delete</option>
        </select>
        <input type="submit" class="button-secondary action" id="doaction2" name="doaction2" value="Apply" />
    </div>

    <br class="clear" />
    </div>


</div>
