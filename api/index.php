<?php


header("Content-Type:application/json");

if(!empty($_GET['name'])){
	echo 'something';
}else{
	echo 'nothing';
}



function deliver_response($status,$status_message){
	header("HTTP/1.1 $status $status_message");

	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;

	$json_response = json_encode($response);
	echo $json_response;
}

?>