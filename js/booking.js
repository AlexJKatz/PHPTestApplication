Booking = {

	submit_form : function(){
			
		var arrival_day = Validation.clean_date($('.daySelect_arrival option:selected').val()),
			arrival_month = Validation.clean_date($('.monthSelect_arrival option:selected').val()),
			checkout_day = Validation.clean_date($('.daySelect_checkout option:selected').val()),
			checkout_month = Validation.clean_date($('.monthSelect_checkout option:selected').val()),

			form = {
				'name' 		: name = $('input[name="fName"]').val(),
				'surname' 	: surname = $('input[name="lName"]').val(),
				'email' 	: email = $('input[name="email"]').val(),
				'arrival' 	: arrival  = $('.yearSelect_arrival option:selected').val()  + '-' + arrival_month + '-' + arrival_day,
				'checkout' 	: checkout = $('.yearSelect_checkout option:selected').val()  + '-' + checkout_month + '-' + checkout_day,
				'hotelID'	: hotel_id = $('.resort option:selected').val()
			}

			
			$.ajax({
			  url: "http://localhost/PHPTestApplication/api/",
			  type:'POST',
			  data: form,
			  success:function(data){
			  	var response = JSON.parse(data.data);
		  		if(response == true){
		  			$('.successLabel').css('display','block')
		  		}
			  },
			});
			
			
			
			
	}


}