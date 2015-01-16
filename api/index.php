<?php

// PHPTestApplication Restful API v1.0 
// Author : Alex J Katz

require('model.php');

	header("Content-Type:application/json");

	// GET HANDLER
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
			case 'search':
				if(!array_key_exists('filter',$request)){
					$model = new Model();
					$results = $model->get_all_reservations();
					$data = json_encode($results);
					echo deliver_response(200,'Okay Response',$results);
				}else{
					switch($request['filter']){
						case 'name':
							$model = new Model();
							$results = $model->filter_reservations('var_name',$request['input']);
							$data = json_encode($results);
							echo deliver_response(200,'Okay Response',$results);
							break;
						case 'surname':
							$model = new Model();
							$results = $model->filter_reservations('var_surname',$request['input']);
							$data = json_encode($results);
							echo deliver_response(200,'Okay Response',$results);
							break;
						case 'email':
							$model = new Model();
							$results = $model->filter_reservations('var_email',$request['input']);
							$data = json_encode($results);
							echo deliver_response(200,'Okay Response',$results);
							break;
						default:
							break;

					}
				}
				break;
			default:
				echo deliver_response(500,'invalid Response','');
				break;
		}	
	}

	// POST HANDLER
	if(!empty($_POST)){
		$request = $_POST;
		$model = new Model();
		$model->add_user($request['name'],$request['surname'],$request['email']);
		$user_id = $model->get_user_id($request['name'],$request['surname'],$request['email']);
		$model->add_reservation($user_id,$request['arrival'],$request['checkout'],$request['hotelID']);
		echo deliver_response(200,'OK',true);
	}		

	// Translate response to JSON and echo to client
	function deliver_response($status,$status_message,$data){
		header("HTTP/1.1 $status $status_message");

		$response['status'] = $status;
		$response['status_message'] = $status_message;
		$response['data'] = $data;

		$json_response = json_encode($response);
		echo $json_response;
	}	
?>