// Validation.JS 
// Validates form inputs and checks wether dates have been used via AJAX

Validation = {
	
	validate_form : function(){
		var that = this;

		if(that.validate_name()){
			$('.error_name').css('display','none')	
			if(that.validate_surname()){
				$('.error_surname').css('display','none')
				if(that.validate_email()){
					$('.error_email').css('display','none')
						that.check_dates();
				}else{
					$('.error_email').css('display','block')
				}
			}else{
				$('.error_surname').css('display','block')
			}
		}else{
			$('.error_name').css('display','block')	
		}
	},

	validate_name : function(){
		var input = $('input[name="fName"]').val();
		return /^[a-zA-Z()]+$/.test(input);
	},

	validate_surname : function(){
		var input = $('input[name="lName"]').val();
		return /^[a-zA-Z()]+$/.test(input);
	},

	validate_email : function(){
		var input = $('input[name="email"]').val(),
		    pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    	return pattern.test(input);
	},	

	check_dates : function(){
		var that = this,
			booked = '',
			hotel_id = $('.resort option:selected').val(),
			arrival_day = that.clean_date($('.daySelect_arrival option:selected').val()),
			arrival_month = that.clean_date($('.monthSelect_arrival option:selected').val()),
			checkout_day = that.clean_date($('.daySelect_checkout option:selected').val()),
			checkout_month = that.clean_date($('.monthSelect_checkout option:selected').val()),
			arrival  = $('.yearSelect_arrival option:selected').val()  + '-' + arrival_month + '-' + arrival_day,
			checkout = $('.yearSelect_checkout option:selected').val()  + '-' + checkout_month + '-' + checkout_day;
			
		     $.get("http://localhost/PHPtestapplication/api/?type=reservation&arrival="+arrival+"&checkout="+checkout+"&hotelID="+hotel_id).done(function(data){
		 		var response = JSON.parse(data.data);
			 	if(response === false){
					$('.error_dates').css('display','none');
					Booking.submit_form();		 	
			 	}else{
			 		$('.error_dates').css('display','block');
			 	}
			 });
	},

	clean_date : function(input){

		if(parseInt(input) < 10){
			var x = '0'+ (input);
			return x ;
		}else{
			return input;
		}
	},

	return_validation : function(reply){
		return reply;
	}
}