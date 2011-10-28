<article class="content box_1" style="margin-top: 20px; padding: 25px; text-align: left; position: relative;">
	<?php include($viewDir . 'formrenderer.php'); ?>
</article>
<script type="text/javascript" src="<?php echo $baseUrl; ?>scripts/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode: "textareas",
		theme: "advanced",
		theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull|,bullist,numlist,outdent,indent,undo,redo,link,unlink,anchor,hr,removeformat,|,codehighlighting",
		theme_advanced_buttons2: "",
		theme_advanced_buttons3: "",
		theme_advanced_resizing : true,
		theme_advanced_toolbar_location : "top",
		plugins: "codehighlighting",
		skin: "o2k7",
		skin_variant: "black",
	});
	jQuery(document).ready(function() {
		$('#create-ticket-button').click(function() {
			tinyMCE.triggerSave();
		});
	});
</script>