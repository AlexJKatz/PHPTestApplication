<?php
require('model.php');

	header("Content-Type:application/json");

	if(!empty($_GET['type'])){

		$request = $_GET;

		switch($request['type']){
			case 'hotels':
			if(!array_key_exists("id",$request)){
				$model = new Model();
				$hotels = $model->get_hotels();
				$data = json_encode($hotels);
				echo deliver_response(200,'Okay Response',$data);
			}else{
				$model = new Model();
				$hotel = $model->get_hotel($request['id']);
				$data = json_encode($hotel);
				echo deliver_response(200,'Okay Response',$data);
			}
				break;
			case 'user':
				$model = new Model();
				echo deliver_response(200,'Okay Response','put');
				break;
			case 'reservation':
				$model = new Model();
				$booked = $model->check_dates($request['arrival'],$request['checkout'],$request['hotelID']);
				echo deliver_response(200,'Okay Response',$booked);
				break;
			default:
				echo deliver_response(500,'invalid Response','');
				break;
		}	
	}else{
		echo deliver_response(500,'invalid Response','');
	}		


	function deliver_response($status,$status_message,$data){
		header("HTTP/1.1 $status $status_message");

		$response['status'] = $status;
		$response['status_message'] = $status_message;
		$response['data'] = $data;

		$json_response = json_encode($response);
		echo $json_response;
	}	








?>