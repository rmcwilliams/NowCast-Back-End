<?php 
    /* This php file checks to see if there is data in the database already that is associated 
    with the beach name and date the user entered. If so, the program loads the data
    to the form and prepares the application to make an update. If there isn't data 
    in the database for these variables, the program prepares the application to make an insert. */

    // connect to database
    require_once('../dbConnect.php');
    // get beach, date, time values from form
    // use these values to make retrieval query 
    $beach = htmlspecialchars($_GET['site']);
    $date = htmlspecialchars($_GET['date']);

    $check = "SELECT * FROM PB_CONDITIONS WHERE BEACH_NAME = '$beach' AND DATE = '$date'";
    // Run the query
    $res = $con->query($check);

    // maybe use $field_info = mysqli_fetch_assoc($res); instead of mysql_fetch_array
    $result = mysqli_fetch_assoc($res); //test
    
    // checks to see if there is any records in the database with the same beach name and date. 
    if (mysqli_num_rows($res) == 0) {
        // There was no previous record of the beach name and date so this means we have to insert
        $win = "INSERT";
        $data = array(
            'WIN'               => $win
        );
    }
    // Data exists in the database
    else {
        // We have to update since there was data in the database
        $win = "EDIT";
        // array with all the values from the database
        $data = array(
            'LAB_ECOLI'         => $result["LAB_ECOLI"],
            'ERROR_TYPE'        => $result["ERROR_TYPE"],
            'WIN'               => $win
        );
    }

    // Always close the connection
    mysqli_close($con);
    echo (json_encode($data));
    
?>