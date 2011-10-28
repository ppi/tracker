<div class="wrap">
    <a href="<?php echo $baseUrl; ?>">Home</a>&nbsp;
    &raquo;&nbsp;<span>Filter tickets by: <strong><?php echo $filter; ?></strong></span>
</div>

<div class="wrap" style="margin-top: 20px;">
	<article class="content-box">
		<table class="issues" id="ticket_list_table" cellspacing="0" cellpadding="0">
			<thead>
			   </tr>
			    <th>ID</th>
				<th>Title</th>
				<th>Status</th>
				<th>Type</th>
				<th>Severity</th>
				<th>Assigned To</th>
			   </tr>
			</thead>
			<tbody>
				<?php if(count($tickets) > 0): ?>
					<?php
					foreach($tickets as $ticket):
						$urlTitle = str_replace(' ', '-', $ticket['title']);
					?>
						<tr>
						<td><?php echo $ticket['id']; ?></td>
						<td class="" style="text-align: left;"><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . $ticketParams['repo'] .'/' . $urlTitle; ?>" title=""><?php echo ucfirst($ticket['title']);?></a></td>
						<td class="ttstate"><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . $ticketParams['repo'] . '/'  . $urlTitle; ?>" title=""><?php echo ucfirst($ticket['status']); ?></a></td>
						<td><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . $ticketParams['repo'] . '/'  . $urlTitle; ?>" title=""><?php echo ucwords(str_replace('_', ' ', $ticket['ticket_type']));?></a></td>
						<td><a href="<?php echo $baseUrl . 'ticket/view/' . $ticket['id'] . '/' . $ticketParams['repo'] . '/'  . $urlTitle; ?>" title=""><?php echo ucfirst($ticket['severity']);?></a></td>
						<td><a href="http://github.com/<?php echo $ticket['username']; ?>" title="" target="_blank"><?php echo $ticket['user_fullname'];?></a></td>
						</tr>
					<?php endforeach;?>
				<?php else:?>
					<tr><td colspan="5">No tickets present</td></tr>
				<?php endif;?>
			</tbody>
		</table>
	</article>
</div>
