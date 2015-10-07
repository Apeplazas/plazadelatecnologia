$(document).ready(function(){
	
	var cookie = $.cookie('demoCookie');
	
	// If the cookie has been set in a previous page load, show it in the div directly:
	if(cookie) $('.jq-text').text(cookie).show();
	
						   
	$('.fields a').click(function(e){
		var text = $('#inputBox').val();
		
		// Setting a cookie with a seven day validity:
		$.cookie('demoCookie',text,{expires: 7, path: '/', domain: 'http://localhost:8888/ptv8'});
		
		$('.jq-text').text(text).slideDown('slow');
		
		e.preventDefault();
	});
	
	$('#form1').submit(function(e){ e.preventDefault(); })
})
