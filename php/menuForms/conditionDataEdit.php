<?php
    // Connect to database
    require_once ('../dbConnect.php');

    // Setup sql query to insert the Field data from the form
    $Update = "";

    // Loop through _POSTed data and accumulate keys and values for SQL statement
    foreach ($_POST as $key => $value) {

          $FieldList .= "$key='$value',";

    }
	$userLogin = $_SESSION['username'];
	$FieldList .= "USER_ID = '$userLogin' "; //took out comma at end, maybe fixed edit problem
	$Update = htmlspecialchars($FieldList);
    // Create SQL statement to insert data.
       $sqlins = "UPDATE PB_CONDITIONS SET " . substr($Update, 0, -1) . 
          " WHERE BEACH_NAME='" . htmlspecialchars($_POST['BEACH_NAME']) . "' AND DATE='" . htmlspecialchars($_POST['DATE']) . "'";

    // Record does not exist, add it to database.
    if ($con->query($sqlins) === true) {
        echo "Record updated in PB_CONDITIONS table.\n";
    } else {
        echo "Record was unable to be updated in PB_CONDITIONS table.";
    }

    //always close the connection
    mysqli_close($con);
?>