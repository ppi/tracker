jQuery(document).ready(function($) {
	$('#ticket_search').submit(function() {
		if(jQuery.trim($('#ticket_keyword').val()) != "") {
			window.location.href = baseUrl + "home/search/keyword/" + $('#ticket_keyword').val();
		}
		return false;
	});

	$('#create-ticket-button').click(function() {
		window.location.href = baseUrl + 'ticket/create';
	});
});