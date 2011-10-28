<div class="wrap">
    <a href="<?php echo $baseUrl; ?>">Home</a>&nbsp;
    &raquo;&nbsp;<span><a href="<?php echo $baseUrl;?>ticket/index/filter/cat/<?php echo $repo; ?>"><?php echo $repo;?></a></span>
	&raquo;&nbsp;<span style="font-size: 1.0em;"><?php echo $aTicket['title']; ?></span>
</div>


<section class="content-box" style="margin-top: 12px; padding: 25px; text-align: left;">
	<div class="ticket">
		<div class="ticket-info rel" style="position: relative;">
			<div class="ticket-num abs"><h1 style="font-size: 18px;">#<?php echo $aTicket['id']; ?></h1></div>
			<?php if($isLoggedIn && $authInfo['role_name'] !== 'member'): ?>
			<div class="ticket-edit-icon" style="position: absolute; top: 1px; right: 5px;">
			    <a href="<?php echo $baseUrl; ?>ticket/edit/<?php echo $aTicket['id']; ?>" title="Edit Ticket"><img src="<?php echo $baseUrl; ?>images/ticket_edit.png" alt="Edit Ticket"></a>
			</div>
			<?php endif; ?>
			<h1 style="font-size: 16px; margin-bottom: 12px;"><?php echo $aTicket['title']; ?></h1>
			<p class="date">Reported by <a href="https://github.com/<?php echo $aTicket['username']; ?>" target="_blank"><?php echo $aTicket['user_fullname']; ?></a>&nbsp;|
				&nbsp;<?php echo $aTicket['created']; ?>
				<?php echo $aTicket['user_fullname']  != '' ? '| Assigned to: <a href="https://github.com/' . $aTicket['username'] . '" target="_blank">' . $aTicket['user_fullname'] . '</a>' : ''; ?>
			</p>
			<div style="margin-top: 25px;" class="ticket-content"><?php echo nl2br($aTicket['content']); ?></div>
		</div>
		<div class="ticket-replies">
			<div class="ticket-reply">

			</div>
		</div>
	</div>
</section>

<section class="content-box" style="margin-top: 25px; padding: 25px; text-align: left;">
	<div class="comment" style="">
		<?php if(count($aComments) > 0): ?>
		<div class="comment-list rel">
			<h1 style="font-size: 16px; margin-bottom: 12px;">Comments to this ticket : </h1>
			<?php foreach($aComments as $comment): ?>
			<div class="comment content-box" style="padding-bottom: 20px;">
				<p class="date">
				    <a href="https://github.com/<?php echo $comment['login']; ?>" target="_blank"><?php echo $comment['username']; ?></a>&nbsp;|&nbsp;Created: <?php echo $comment['created']; ?>&nbsp;|&nbsp;<a href="#permalink-for-comment-<?php echo $comment['id']; ?>" name="permalink-for-comment-<?php echo $comment['id']; ?>">Permalink</a></p>
				<div style="margin-top: 25px;" class="ticket-content"><?php echo nl2br($comment['content']); ?></div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php else: ?>
		<p><strong>No comments have been left.</strong></p>
		<?php endif; ?>
		<?php if($isLoggedIn): ?>
		<div class="comment-create-container" style="margin-top: 20px;"></div>
		<form action="<?php echo $baseUrl; ?>ticket/ccreate" method="post" id="create-comment-form">
			<textarea id="comment_content" name="content" rows="10" cols="50" style="width: 600px; height: 300px;"></textarea>
			<input type="hidden" name="ticket_id" value="<?php echo $aTicket['id']; ?>" />
			<button id="create_ticket" type="submit"><span class="button green">Comment</span></button>
		</form>
		<?php endif; ?>
	</div>
</section>