$(document).ready(function(){

// Booking HTML Javascript
	$('.create').click(function(){
		var html = '';
		// Page Load
		$('.loader').show();
		$.get( "http://localhost/PHPtestapplication/api/?type=hotels", function( data ) {
			var response = JSON.parse(data.data);
			$.each(response,function(index,value){
				html += "<option value='"+value.id+"'>" + value.name + '</option>';
			})
			// Page completed Loading
			$('#welcomeMain').load('http://localhost/PHPtestapplication/content/booking.html',function(){
				$(document).foundation();
				$('.resort').html(html);
				$('.loader').hide();	

				// Page Javascript 
				$('.resort').change(function(){
					$.get( "http://localhost/PHPtestapplication/api/?type=hotels&id="+$(this).val(), function( data ) {
						var response = JSON.parse(data.data);
						$('.preview').attr('src','./img/'+response[0].img);
					});
				})

				$('.submit').click(function(e){
					//Validation
					e.preventDefault();
					Validation.validate_form();
				})
			})
		});


	})



	$('.search').click(function(){
		$('#welcomeMain').load('http://localhost/PHPtestapplication/content/search.html');
	})

	$('.welcome').click(function(){
		$('#welcomeMain').load('http://localhost/PHPtestapplication/content/welcome.html');
	})

	


})	
