<?php
    // Initialize variables.

    // Parse all of the values POSTed from the Publish Data page.
    $beach = $_POST["BEACH_NAME"];
    $date = $_POST["DATE"];
    $time = $_POST["TIME"];

    // Connect to database
    require_once ('../dbConnect.php');
    $userLogin = $_SESSION['username'];
    // Retrieve COOP_ID for selected beach.
    $sql = "SELECT COOP_ID FROM SYS_BEACHES WHERE BEACH_NAME='$beach'";
    $res1 = $con->query($sql);
    while($row = mysqli_fetch_assoc($res1)){
       $coopid = $row['COOP_ID'];
    }

    // Let's check if the record is already in our system
    $check = "SELECT * FROM PB_CONDITIONS WHERE `BEACH_NAME` = '$beach' AND `DATE` = '$date' ";

    // Run the query
    $res = $con->query($check);

    // Setup sql query to insert the Field data from the form
    $Update = "";

    // Loop through _POSTed data and accumulate keys and values for SQL statement
    foreach ($_POST as $key => $value) {
       $Update .= "$key='$value',";
    }

    $Update .= "USER_ID= '$userLogin' ,COOP_ID='$coopid'"; //took off comma at end of $coopid 

    // Create SQL statement to insert data.
    $sqlins = "UPDATE PB_CONDITIONS SET " . substr($Update, 0, -1) . 
       " WHERE BEACH_NAME='" . $beach . "' AND DATE='" . $date . "'";

    // Record exists, Update the database table.
    if (mysqli_num_rows($res) == 1) {
        if ($con->query($sqlins) === true) {
            echo "Record updated<br>\n";
        } else {
            echo "Error (ecoli): " . $sqlins . "<br>" . $con->error;
        }
    } else {
        echo "Record does not exist. Please enter Beach Conditions information first.<br>\n";
    }

    // Always close the connection
    mysqli_close($con);
?>

