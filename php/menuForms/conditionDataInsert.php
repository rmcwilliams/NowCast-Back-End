<?php
    // Connect to database
    require_once ('../dbConnect.php');

    // Setup sql query to insert the Field data from the form
    $Update = "";

    $FieldList = "";
    $userLogin = $_SESSION['username'];
    // Loop through _POSTed data and accumulate keys and values for SQL statement
    foreach ($_POST as $key => $value) {
        $FieldList .= "$key = '$value',";
    }
        $FieldList .= "USER_ID = '$userLogin' "; //took out comma at end, maybe fixed edit problem
    // Create SQL statement to insert data.
    
    $Update = $FieldList;
    $sqlins = "UPDATE PB_CONDITIONS SET " . substr($Update, 0, -1) . 
        " WHERE BEACH_NAME='" . $_POST['BEACH_NAME'] . "' AND DATE='" . $_POST['DATE'] . "'";
  
    // Record does not exist, add it to database.
    if ($con->query($sqlins) === true) {
        echo "Record updated in PB_CONDITIONS table<br>";
    } else {
        echo "Error (int): " . $sqlins . "<br>" . $con->error;
    }
    
    echo $sqlins;
    // always close the connection
    mysqli_close($con);
?>