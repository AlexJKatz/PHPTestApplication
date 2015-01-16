// Main.JS
// Handles Page transitioning aswell as onLoad events for pages

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
				$('#welcomeMain').foundation();
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
					// if(){
					
					// }
				})
			})
		});


	})



	$('.search').click(function(){

		// Page Load
		$('#welcomeMain').load('http://localhost/PHPtestapplication/content/search.html',function(){
			// Page completed Loading
			$('.loader').hide();	

			// Inital results found and populated
			$.get( "http://localhost/PHPtestapplication/api/?type=search", function( data ) {
				var response = data.data,
				html = '';
				$.each(response,function(index,value){
					html += '<div class="row"><div class="small-2 medium-2 large-2 columns"><label>'+value.var_name+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_surname+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_email+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_hotel_name+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.dte_date_arrive+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.dte_date_out+'</label></div></div>';
				});
				
				$('.resultsPage').html(html);
				
				// Page Javascript 
				// Dynamic Searches
				$('.searchName').on('keyup',function(){
					html = '';
					$.get( "http://localhost/PHPtestapplication/api/?type=search&filter=name&input="+$('.searchName').val(), function( data ) {
						var response = data.data
						$.each(response,function(index,value){
							html += '<div class="row"><div class="small-2 medium-2 large-2 columns"><label>'+value.var_name+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_surname+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_email+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_hotel_name+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.dte_date_arrive+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.dte_date_out+'</label></div></div>';
						});
						$('.resultsPage').html(html);
					})
				})

				$('.searchSurname').on('keyup',function(){
					html = '';
					$.get( "http://localhost/PHPtestapplication/api/?type=search&filter=surname&input="+$('.searchSurname').val(), function( data ) {
						var response = data.data
						$.each(response,function(index,value){
							html += '<div class="row"><div class="small-2 medium-2 large-2 columns"><label>'+value.var_name+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_surname+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_email+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_hotel_name+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.dte_date_arrive+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.dte_date_out+'</label></div></div>';
						});
						$('.resultsPage').html(html);
					})
				})

				$('.searchEmail').on('keyup',function(){
					html = '';
					$.get( "http://localhost/PHPtestapplication/api/?type=search&filter=email&input="+$('.searchEmail').val(), function( data ) {
						var response = data.data
						$.each(response,function(index,value){
							html += '<div class="row"><div class="small-2 medium-2 large-2 columns"><label>'+value.var_name+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_surname+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_email+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.var_hotel_name+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.dte_date_arrive+'</label></div><div class="small-2 medium-2 large-2 columns"><label>'+value.dte_date_out+'</label></div></div>';
						});
						$('.resultsPage').html(html);
					})
				})
			})
				
		});
	})	

	// Page Load
	$('.welcome').click(function(){
		// Page completed Loading
		$('#welcomeMain').load('http://localhost/PHPtestapplication/content/welcome.html',function(){
			$('#welcomeMain').foundation();
		});
	})
})	
