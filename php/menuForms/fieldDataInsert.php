<?php
    /* Inserts data the user entered into the database */
    // Connect to database
    require_once('../dbConnect.php');
    // Setup sql query to insert the Field data from the form
    $FieldVarList = "";
    $FieldValueList = "";
    $userLogin = $_SESSION['username'];
    // Loop through _POSTed data and accumulate keys and values for SQL statement
    $errorMsg = "";
    foreach ($_POST as $key => $value) {
        //some validation
        if ($key == 'TIME' && !ctype_digit($value)) {
            $errorMsg .= "Time needs to be numerical.\n";
        } else if ($key == 'LAKE_SPCOND' && !ctype_digit($value)) {
            $errorMsg .= "Swim Area Conductance needs to be numerical.\n";
        } else if ($key == "CLOUD_CAT" &&($value != "1" && $value != "2" && $value != "3" && $value != "4" && $value != "5")) {
            $errorMsg .= "Please choose a valid choice for Cloud Cover.\n";
        }
        // add more validation later...

        $FieldVarList .= "$key,";
        $FieldValueList .= "'$value',";
    }

    if ($errorMsg != "") {
        echo $errorMsg;
        // close mysql connection here?
        exit(1);
    }

    $FieldVarList .= "USER,";
    $FieldValueList .= "'$userLogin',";

    // Create SQL statement to insert data.
    $sqlins = "INSERT INTO INT_FIELD(" . substr($FieldVarList, 0, -1) . ") 
           VALUES(" . substr($FieldValueList, 0, -1) . ")";
    
    // Let's check if the record is already in our system
    $check = "SELECT * FROM INT_FIELD WHERE BEACH_NAME = '" . $_POST['BEACH_NAME'] . 
       "' AND DATE = '" . $_POST['DATE']. "'";

    // Run the query
    $res = $con->query($check);

    // Record does not exist, add it to database.
    if (mysqli_num_rows($res) == 0) {
        if ($con->query($sqlins) === true) {
            echo "Record added\n";
        } else {
            echo "Error: " . $sqlins . "<br>" . $con->error;
        }
    } else {
        echo "Record already exists\n";
    }
    
    // Always close the connection
    mysqli_close($con);

?>