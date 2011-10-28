<?php
if(isset($isAjax) && $isAjax == false):
	include_once($viewDir . $actionFile);
else:
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<?php include($viewDir . 'elements/head.php'); ?>
<body>
<?php include($viewDir . 'elements/header.php'); ?>
<div id="wrapper">
	<section class="main-content-container">
		<!-- .main-content-contrainer-inner -->
		<div class="main-content-container-inner">
			<div class="header-separator"><div class="fl green-2"></div><div class="fl green-3"></div><div class="fl green-4"></div></div>
			<!-- .main-content -->
			<div class="fl main-content">
			<?php include_once($viewDir . $actionFile); ?>
			</div>
			<!-- /.main-content -->
		</div>
		<!-- /.main-content-contrainer-inner -->
	</section>
</div> <!-- #wrapper -->
</body>
</html>
<?php
endif;
?>