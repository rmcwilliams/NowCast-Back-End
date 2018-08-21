<?php 
	/*This php file checks to see if there is data in the database already that is associated with the beach name and date the user entered. If so, the program loads the data
	to the form and prepares the application to make an update. If there isn't data in the database for these variables, the program prepares the application to make an insert.
	*/
	//connect ot database
	require_once('../dbConnect.php');
	//get beach and date values from form
	$beach = $_GET['site'];
	$date = $_GET['date'];

	$check = "SELECT * FROM PB_CONDITIONS WHERE BEACH_NAME = '$beach' AND DATE = '$date'";
    // Run the query
    $res = $con->query($check);

	//maybe use $field_info = mysqli_fetch_assoc($res); instead of mysql_fetch_array
	$result = mysqli_fetch_assoc($res); //test
	
	//checks to see if there is any records in the database with the same beach name and date. 
	if (mysqli_num_rows($res) == 0) {
		//There was no previous record of the beach name and date so this means we have to insert
        $win = "INSERT";
		//array sent to field.php form
        $data = array(
		    'WIN'				=> $win
	    );
    }
	//Data exists in the database
	else {
		//We have to update since there was data in the database
		$win = "EDIT";
		//array with all the values from the database
		$data = array(
		'TIME'						=> $result["TIME"],
		'NOWCAST_PROBABILITY'		=> $result["NOWCAST_PROBABILITY"],
		'NOWCAST_ECOLI'				=> $result["NOWCAST_ECOLI"],
		'BEACH_CONDITIONS'			=> $result["BEACH_CONDITIONS"],
		'BEACH_REASON'				=> $result["BEACH_REASON"],
		'WIN'						=> $win
	
	);
		
	}

    // Always close the connection
    mysqli_close($con);
	echo (json_encode($data));
	
?>