<?php
    /* Inserts data the user entered into the database */
    // Connect to database
    require_once('../dbConnect.php');
    // Setup sql query to insert the Field data from the form
    $FieldVarList = "";
    $FieldValueList = "";
    $userLogin = $_SESSION['username'];
    // Loop through _POSTed data and accumulate keys and values for SQL statement
    foreach ($_POST as $key => $value) {
        $FieldVarList .= "$key,";
        $FieldValueList .= "'$value',";
    }

    $FieldVarList .= "USER,";
    $FieldValueList .= "'$userLogin',";

    // Create SQL statement to insert data.
    $sqlins = "INSERT INTO INT_FIELD(" . substr(htmlspecialchars($FieldVarList), 0, -1) . ") 
           VALUES(" . substr(htmlspecialchars($FieldValueList), 0, -1) . ")";
    
    // Let's check if the record is already in our system
    $check = "SELECT * FROM INT_FIELD WHERE BEACH_NAME = '" . htmlspecialchars($_POST['BEACH_NAME']) . 
       "' AND DATE = '" . htmlspecialchars($_POST['DATE']). "'";

    // Run the query
    $res = $con->query($check);

    // Record does not exist, add it to database.
    if (mysqli_num_rows($res) == 0) {
        if ($con->query($sqlins) === true) {
            echo "Record added.\n";
        } else {
            echo "Record was unable to be added.";
        }
    } else {
        echo "Record already exists\n";
    }
    
    // Always close the connection
    mysqli_close($con);

?>