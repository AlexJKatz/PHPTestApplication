<?php
 // Model.php
 // Connection between restfull API and DB
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

	function add_user($name,$surname,$email){
		$mysqli = $this->mysqli;
		$sql = "INSERT INTO users VALUES(NULL, ?, ?, ?)";
		
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('sss',$name,$surname,$email);
		$stmt->execute();
		$stmt->close();
 	}

 	function get_user_id($name,$surname,$email){
	 	$mysqli = $this->mysqli;
 		$users = array();
 		$sql = 'SELECT * FROM users WHERE var_name ="'.$name.'" AND var_surname = "'.$surname.'" AND var_email = "'.$email.'"';

 		if($stmt = $mysqli->prepare($sql)){
 			$stmt->execute();
 			$stmt->bind_result($int_user_id,$var_name,$var_surname,$var_email);

 			while($stmt->fetch()){
 				$user = array(
 				'int_user_id' => $int_user_id,
 				'var_name' =>$var_name,
 				'var_surname' => $var_surname,
 				'var_email' => $var_email
 			);
 				array_push($users,$user);
 			}
 		}
 		return $users[0]['int_user_id'];
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

 	function add_reservation($user_id, $arrival, $checkout, $hotel_id){

		$mysqli = $this->mysqli;
		$sql = "INSERT INTO reservation VALUES('".$user_id."','".$arrival."' ,'".$checkout."','".$hotel_id."')";
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$stmt->close();
 	}

 	function get_all_reservations(){
		$mysqli = $this->mysqli;
		$results = [];
		$sql = 'SELECT users.var_name ,
					   users.var_surname,
					   users.var_email,
					   reservation.dte_date_arrive,
					   reservation.dte_date_out,
					   hotels.var_hotel_name 
				FROM users
				INNER JOIN reservation ON reservation.int_user_id = users.int_user_id
				INNER JOIN hotels ON hotels.int_hotel_id = reservation.int_hotel_id';

				if($stmt = $mysqli->prepare($sql)){
 			$stmt->execute();
 			$stmt->bind_result($user_name,$user_surname,$user_email,$dte_arrival,$dte_checkout,$hotel_name);

 			while($stmt->fetch()){
 				$result = array(
	 				'var_name' => $user_name,
	 				'var_surname' => $user_surname,
	 				'var_email' => $user_email,
	 				'dte_date_arrive' => $dte_arrival,
	 				'dte_date_out' => $dte_checkout,
	 				'var_hotel_name' => $hotel_name
 				);

 				array_push($results,$result);
 			}

 		}
 		$mysqli->close();
		return $results;
 	}

 	function filter_reservations($type,$input){
		$mysqli = $this->mysqli;
		$results = [];
		$sql = 'SELECT users.var_name ,
					   users.var_surname,
					   users.var_email,
					   reservation.dte_date_arrive,
					   reservation.dte_date_out,
					   hotels.var_hotel_name 
				FROM users
				INNER JOIN reservation ON reservation.int_user_id = users.int_user_id
				INNER JOIN hotels ON hotels.int_hotel_id = reservation.int_hotel_id
				WHERE '.$type.' LIKE "%'.$input.'%"';

				if($stmt = $mysqli->prepare($sql)){
 			$stmt->execute();
 			$stmt->bind_result($user_name,$user_surname,$user_email,$dte_arrival,$dte_checkout,$hotel_name);

 			while($stmt->fetch()){
 				$result = array(
	 				'var_name' => $user_name,
	 				'var_surname' => $user_surname,
	 				'var_email' => $user_email,
	 				'dte_date_arrive' => $dte_arrival,
	 				'dte_date_out' => $dte_checkout,
	 				'var_hotel_name' => $hotel_name
 				);

 				array_push($results,$result);
 			}

 		}
 		$mysqli->close();
		return $results;
 	}

}

?>