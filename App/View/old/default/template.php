<?php if(!isset($isAjax) || $isAjax == false) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>css/framework.css"/>
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>style.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>css/formbuilder.css"/>	
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>css/style.css"/>
	<script type="text/javascript" language="javascript" src="<?php echo $baseUrl; ?>scripts/jquery1.4.2.min.js"></script>
	<script type="text/javascript">var baseUrl = "<?php echo $baseUrl; ?>";</script>
	<?php include_once($viewDir . 'framework/javascript.php'); ?>
	<?php include_once($viewDir . 'framework/stylesheet.php'); ?>
	<title>PPI framework | Open Source PHP Framework</title>
	
	<style type="text/css">
#wrapper {
margin:0 auto;
position:relative;
text-align:left;
width:985px;
margin-bottom: 200px;
}
	</style>	
</head>

<body>
		<header>

			<div class="wrap">
				<div id="logo">
					<h1>PPI framework</h1>
					<span>Open Source PHP Framewo rk</span>
				</div>
				<nav>
				<ul>
					<li class="img"><a href="#"><img src="images/icons/home.png" alt="Home" title="Home"/></a></li>
					<li><a href="#" class="current">Activity</a></li>
					<li><a href="#">Issues</a>
						<ul>
							<li><a href="#">Forums</a></li>
							<li><a href="#">Credits</a></li>
						</ul>
					</li>
					<li><a href="#">News</a></li>
					<li><a href="#">Wiki</a></li>
					<li><a href="#">Track</a></li>
				</ul>
			</nav>
			</div>
		</header>
		
		<div id="wrapper" style="">
		<?php include $viewDir . "framework/flashmessage.php" ?>
		<?php include_once($viewDir . $actionFile); ?>
		</div>
		
		<footer>
			<div class="wrap">
				<ul id="footerLinks">
					<li class="fcol"><h5>Site Navigation</h5>
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Download</a></li>
							<li><a href="#">News</a></li>
							<li><a href="#">Docs</a></li>
							<li><a href="#">Bugs</a></li>
							<li><a href="#">Forums</a></li>
						</ul>
					</li>
					<li class="fcol"><h5>Site Navigation</h5>
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Download</a></li>
							<li><a href="#">News</a></li>
							<li><a href="#">Docs</a></li>
							<li><a href="#">Bugs</a></li>
							<li><a href="#">Forums</a></li>
						</ul>
					</li>
					<li class="fcol"><h5>Site Navigation</h5>
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Download</a></li>
							<li><a href="#">News</a></li>
							<li><a href="#">Docs</a></li>
							<li><a href="#">Bugs</a></li>
							<li><a href="#">Forums</a></li>
						</ul>
					</li>
					<li class="fcol"><h5>Site Navigation</h5>
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Download</a></li>
							<li><a href="#">News</a></li>
							<li><a href="#">Docs</a></li>
							<li><a href="#">Bugs</a></li>
							<li><a href="#">Forums</a></li>
						</ul>
					</li>
				</ul>
				
				<section id="copyleft">
					<h5>PPI Framework</h5>
					<p>Copyright @2010 PPI framework. All rights reserved.</p>
					<a href="http://blazed-designs.com" id="by" target="_blank">Design by Blazed Designs</a>
					<div id="legal">
						<a href="#">Terms & Conditions</a> | 
						<a href="#">Privacy</a> | 
						<a href="#">Contact Us</a>
					</div>
				</section>
			</div>
		</footer>		
		
	</body>
</html> 
<?php } else { ?>
			<?php include_once($viewDir . $actionFile); ?>
<?php } ?>