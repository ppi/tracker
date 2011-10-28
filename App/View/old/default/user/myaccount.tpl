<div id="dashboard_tabs" class="tabs-nav" style="width: 100%;">
	<ul>
		<li><a href="#my_account">My Account</a></li>	
		<li><a href="#update_account">Update account</a></li>	
		<li><a href="#change_password">Change your password</a></li>
		<li><a href="#change_email">Change your email</a></li>
		<li><a href="#cancel_membership">Cancel Membership</a></li>
	</ul>
	<div id="my_account">
		<p>Name</p>		
		<p>Email</p>		
		<p>Address</p>		
		<p>Phone</p>		
		<p>Postcode</p>		
	</div>
	<div id="update_account">
		<p>Name: <input type="text" name="" value="value here" /></p>		
		<p>Email: <input type="text" name="" value="value here" /></p>		
		<p>Address: <input type="text" name="" value="value here" /></p>		
		<p>Phone: <input type="text" name="" value="value here" /></p>		
		<p>Postcode: <input type="text" name="" value="value here" /></p>			
	</div>
	<div id="change_password">
		<p>current password</p>
		<p>new password</p>
		<p>confirm new password</p>
	</div>
	<div id="change_email">
		<p>Current email: (readonly box)</p>
		<p>New Email</p>
		<p>Confirm New Email</p>
		<p>Password (enter your pw here for confirmation)</p>
	</div>
	<div id="cancel_membership">
		<p>Please confirm your password</p>
	</div>
</div>
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$('#dashboard_tabs').tabs({
	    select: function(event, ui) {
			var myUrl = $(ui.tab).attr('href').replace('#','');
			if(myUrl == 'pm') {
				window.location = baseUrl + myUrl;
			}
	    }
	}); 	
});
{/literal}
</script>