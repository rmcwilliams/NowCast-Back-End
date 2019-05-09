<?php
    // Connect to database
    require_once ('../dbConnect.php');

    //variables for SQL query
    $columnList = "";
    $valueList = "";

    $userLogin = $_SESSION['username'];
    // Loop through _POSTed data and accumulate keys and values for SQL statement
    foreach ($_POST as $key => $value) {
        $columnList .= "$key, ";
        $valueList .= "'$value', ";
    }
    $columnList .= "ERROR_TYPE, LAB_ECOLI, BEACH_TIME, COOP_ID, USER_ID";
    $valueList .= "'', '', '', '', '$userLogin'";

    $sqlins = "INSERT INTO PB_CONDITIONS (" . htmlspecialchars($columnList) . ") VALUES (" . htmlspecialchars($valueList) . ")";
    // Record does not exist, add it to database.
    if ($con->query($sqlins) === true) {
        echo "Record inserted into PB_CONDITIONS table.\n";
    } else {
        echo "Error: " . $sqlins . "\n" . $con->error;
    }
    
    //echo $sqlins;
    // always close the connection
    mysqli_close($con);
?>