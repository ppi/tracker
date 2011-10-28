<?php
  header("HTTP/1.1 404 Not Found");
?>
<html>
<head>
<title>404 Page Not Found</title>
</head>
<body style="font-family: Times new roman, arial, tahoma; background:#D7D7BD none repeat scroll 0 0;">
	<div id="content" align="center" style="padding: 78px 12px 12px 12px; height: 200px; color: #333333; border: 1px dashed #CCCCCC; margin: 0 auto; background:#FFFFFF none repeat scroll 0 0; width: 600px;">
    <?php if($p_bUseImage === true) { ?>
		<div style="float: left; padding-top: 15px; margin-left: 90px;">
			<img src="<?php echo $oConfig->system->base_url; ?>images/framework/software-update-urgent.png" alt="warning">
		</div>
    <?php } ?>
		<div style="float: left; padding-left: 20px;">
			<h1 style="margin-bottom: 2px;"><?php echo $heading; ?></h1>
			<?php echo $message; ?>		
		</div>
		<div style="clear: both;"></div>
	</div>
</body>
</html>