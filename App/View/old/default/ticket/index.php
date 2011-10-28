<table class="list issues">
	<thead>
	    <tr>

	    	<th>ID</th>

			<th>Type</th>

			<th>Priority</th>

	        <th>Assigned to</th>

	        <th>Title</th>

	        <th>Target version</th>
		</tr>
	</thead>

	<tbody>
		<?php if(count($tickets) > 0): ?>
	 		<?php foreach($tickets as $ticket):?>
				<tr class="hascontextmenu odd issue status-1 priority-2" id="issue-3204">
					<td class="id"><?php echo $ticket['id'];?></td>
			        <td class="type"><?php echo ucfirst($ticket['ticket_type']);?></td>
			        <td class="severity"><?php echo ucfirst($ticket['severity']);?></td>

			        <td class="title"><?php echo ucfirst($ticket['title']);?></td>
			        <td class="user_name"><?php echo ucwords($ticket['user_fn'] . ' ' . $ticket['user_ln']);?> </td>
			        <td class="created"><?php echo date('d/m/Y', $ticket['created']);?></td>
				</tr>
			<?php endforeach;?>
		<?php else:?>
			<tr><td colspan="5">No tickets present</td></tr>
		<?php endif;?>
	</tbody>
</table>

<style type="text/css">
.issues th, .issues td { padding-left: 10px; }
</script>