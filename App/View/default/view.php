<section class="box_1" style="margin-top: 25px; padding: 25px; text-align: left;">
	<div class="ticket">
		<div class="ticket-info rel" style="position: relative;">
			<div class="ticket-num abs" style="position: absolute; top: 5px; right: 5px;"><h1 style="font-size: 18px;">#<?php echo $aTicket['id']; ?></h1></div>
			<h1 style="font-size: 16px; margin-bottom: 12px;"><?php echo $aTicket['title']; ?></h1>
			<p class="date">Reported by <?php echo $aTicket['user_fn'] . ' ' . $aTicket['user_ln']; ?> | <?php echo date('F dS, Y @ H:i', $aTicket['created']); ?></p>
			<div style="margin-top: 25px;" class="ticket-content"><?php echo nl2br($aTicket['content']); ?></div>
		</div>
		<div class="ticket-replies">
			<div class="ticket-reply">
				
			</div>
		</div>
	</div>
</section>

<section class="box_1" style="margin-top: 25px; padding: 25px; text-align: left;">
	<div class="comment" style="">
		<?php if(count($aComments) > 0): ?>
		<div class="comment-list rel">
			<h1 style="font-size: 16px; margin-bottom: 12px;">Comments and changes to this ticket</h1>
			<?php foreach($aComments as $comment): ?>
			<div class="comment" style="margin: 20px; padding-bottom: 20px; border-bottom: 1px solid #E0E0E0;">
				<p class="date"><?php echo $comment['first_name'] . ' ' . $comment['last_name']; ?> | Created: <?php echo date('F dS, Y @ H:i', $comment['created']); ?></p>
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
		<script src="<?php echo $baseUrl; ?>scripts/tinymce/tiny_mce.js" type="text/javascript"></script>
		<script language="javascript" type="text/javascript">
			tinyMCE.init({
				mode: "textareas",
				theme: "advanced",
				skin: "o2k7",
				skin_variant: "black",
				theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull|,bullist,numlist,outdent,indent,undo,redo,link,unlink,anchor,hr,removeformat,|,codehighlighting",
				theme_advanced_buttons2: "",
				theme_advanced_buttons3: "",
				theme_advanced_buttons3_add_before: "codehighlighting",
				theme_advanced_resizing : true,
				theme_advanced_toolbar_location : "top",
				plugins: "codehighlighting"
			});
			jQuery(document).ready(function() {
				$('#create-comment-form').submit(function() {
					tinyMCE.triggerSave();
					if(jQuery.trim($('#comment_content').val()) == "") {
						alert('You must enter a comment to continue.');
						return false;
					}
				});


			});
	
		</script>
		<?php else: ?>
		<p style="margin: 5px; margin-left: 0;">You must be logged in to post comments. Click here to <a href="<?php echo $baseUrl; ?>user/login" title="Sign in">Sign in</a> or <a href="<?php echo $baseUrl; ?>user/register">Register</a></p>
		<?php endif; ?>
		<script type="text/javascript">
		hljs.initHighlightingOnLoad();	
		</script>
	</div>
</section>