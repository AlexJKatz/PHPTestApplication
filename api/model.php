<?php

 class Model{
 	var $mysqli = '';
 	// Constructor Creates MYSQLi Connection
 	function __construct(){
 		$hostname = 'localhost';
 		$username = 'root';
 		$password = "";
 		$dbname = 'phptestapplication';
 		$this->mysqli = @new mysqli($hostname,$username,$password,$dbname);
 	}

    // HOTEL CALLS TO DB
 	function get_hotels(){
 		$mysqli = $this->mysqli;
 		$hotels = array();
 		$sql = 'SELECT * FROM hotels';

 		if($stmt = $mysqli->prepare($sql)){
 			$stmt->execute();
 			$stmt->bind_result($id,$name,$city,$img,$desc);

 			while($stmt->fetch()){
 				$hotel = array(
 				'id' => $id,
 				'name' =>$name,
 				'city' => $city,
 				'img' => $img,
 				'desc' => $desc
 			);
 				array_push($hotels,$hotel);
 			}
 		}
 		$mysqli->close();
 		return $hotels;
 	}

 	function get_hotel($id){
 		$mysqli = $this->mysqli;
 		$hotels = array();
 		$sql = 'SELECT * FROM hotels WHERE int_hotel_id ='.$id;

 		if($stmt = $mysqli->prepare($sql)){
 			$stmt->execute();
 			$stmt->bind_result($id,$name,$city,$img,$desc);

 			while($stmt->fetch()){
 				$hotel = array(
 				'id' => $id,
 				'name' =>$name,
 				'city' => $city,
 				'img' => $img,
 				'desc' => $desc
 			);
 				array_push($hotels,$hotel);
 			}
 		}
 		$mysqli->close();
 		return $hotels;
 	}

    // USER CALLS TO DB
 	function get_user(){
 	}

 	// RESERVATION CALLS TO DB
 	function check_dates($arrive,$checkout,$hotel_id){
		$mysqli = $this->mysqli;
		$results = [];
		$sql = 'SELECT * FROM reservation where int_hotel_id = '.$hotel_id.' AND  dte_date_arrive BETWEEN "'.$arrive.'" AND "'.$checkout.'"';

		if($stmt = $mysqli->prepare($sql)){
 			$stmt->execute();
 			$stmt->bind_result($user_id,$dte_date_arrive,$dte_date_checkout,$int_hotel_id);

 			while($stmt->fetch()){
 				$result = array(
	 				'int_user_id' => $user_id,
	 				'dte_date_arrive' =>$dte_date_arrive,
	 				'dte_date_checkout' => $dte_date_checkout,
	 				'int_hotel_id' => $int_hotel_id
 				);

 				array_push($results,$result);
 			}

 		}
 		$mysqli->close();

 		if(!empty($results)){
 			return true;
 		}else{
 			return false;
 		}
 		
 	}

}

?>