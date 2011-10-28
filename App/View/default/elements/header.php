<div id="header">
    <div class="header-container">
		<div class="fl header-left"></div>
		<div class="fl rel header-middle">
			<a href="<?php echo $baseUrl; ?>" title="PPI Framework"><img class="abs" src="<?php echo $baseUrl; ?>images/icons-logo.png" alt="PPI Logo"></a>
			<span>
				<nav>
<!--					<a href="--><?php //echo $baseUrl; ?><!--" title="Home">Home</a>-->
					<?php if($isLoggedIn): ?>
					<!-- <li><a href="--><?php //echo $baseUrl; ?><!--ticket/create" title="Logout">Create ticket</a></li>-->
					<a href="<?php echo $baseUrl; ?>user/logout" title="Logout">Logout</a>
					<span>Greetings, <?php echo $authInfo['first_name']; ?></span>
					<?php else: ?>
<!--					<a href="--><?php //echo $baseUrl; ?><!--user/login" title="Login">Login</a>-->
<!--					<a href="--><?php //echo $baseUrl; ?><!--user/register" title="Login">Sign up</a>-->
					<?php endif; ?>
				</nav>
			</span>
		</div>
		<div class="fl header-right"></div>
	</div>
</div>
<div class="clearfix"></div>
<div class="header-separator"></div>