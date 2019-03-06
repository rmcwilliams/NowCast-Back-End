<?php
    /* Updates the data the user accessed from the database */
    // Connect to database
    require_once ('../dbConnect.php');

    // Setup sql query to insert the Field data from the form
    $Update = "";
    $Update1 = "";

    $FieldList = "";
    $userLogin = $_SESSION['username'];
    // Loop through _POSTed data and accumulate keys and values for SQL statement
    foreach ($_POST as $key => $value) {
        if ($key == "INITIALS") {
            $IntlKey = "$key = '$value',";
        } else {
            $FieldList .= "$key = '$value',";
        }
    }
    $userkey = "USER = '$userLogin',";
        
    $curdate = $_POST['DATE'];
    $prevdate = new DateTime($curdate);
    $prevdate->sub(new DateInterval('P1D'));
    $pdate = $prevdate->format('Y-m-d');

    $sqlintsel = "SELECT STREAM_GHT_FT,STREAM_TURB_NTU,SHOREHEAD_FT,STREAM2_GHT_FT,STREAM2_TURB_NTU " .
       " FROM INT_FIELD WHERE BEACH_NAME='" . htmlspecialchars($_POST['BEACH_NAME']) . "' AND DATE='" . htmlspecialchars($pdate) . "'";
    // Run the query
    $resintsel = $con->query($sqlintsel);
    if (mysqli_num_rows($resintsel) != 0) {
        $preday_info = mysqli_fetch_assoc($resintsel);
        $FTGH_preday = $_POST['STREAM_GHT_FT'] - $preday_info['STREAM_GHT_FT'];
        $FTTurb_preday = $_POST['STREAM_TURB_NTU'] - $preday_info['STREAM_TURB_NTU'];
        $FT2GH_preday = $_POST['STREAM2_GHT_FT'] - $preday_info['STREAM2_GHT_FT'];
        $FT2Turb_preday = $_POST['STREAM2_TURB_NTU'] - $preday_info['STREAM2_TURB_NTU'];
        $FShorehd_preday = $_POST['SHOREHEAD_FT'] - $preday_info['SHOREHEAD_FT'];
    } else {
        //echo "No previous day's Stream data<br>";
        $FTGH_preday = 0;
        $FTTurb_preday = 0;
        $FT2GH_preday = 0;
        $FT2Turb_preday = 0;
        $FShorehd_preday = 0;
    }
    $Update_preday = "STREAM_GHT_PREDAY='$FTGH_preday',STREAM_TURB_PREDAY='$FTTurb_preday', SH_PREDAY='$FShorehd_preday',";
    $Update2_preday = "STREAM2_GHT_PREDAY='$FT2GH_preday',STREAM2_TURB_PREDAY='$FT2Turb_preday',";
    $Update1 .= $FieldList . $IntlKey . $userkey;
    $Update .= $FieldList . $Update_preday . $Update2_preday;

    $sqlins = "UPDATE INT_FIELD SET " . substr(htmlspecialchars($Update1), 0, -1) . 
        " WHERE BEACH_NAME='" . htmlspecialchars($_POST['BEACH_NAME']) . "' AND DATE='" . htmlspecialchars($_POST['DATE']) . "'";
    $sqlpbins = "UPDATE PB_EXPORT SET " . substr(htmlspecialchars($Update), 0, -1) . 
        " WHERE BEACH_NAME='" . htmlspecialchars($_POST['BEACH_NAME']) . "' AND DATE='" . htmlspecialchars($_POST['DATE']) . "'";
        
    if ($con->query($sqlpbins) === true) {
        echo "Record updated in PB table.\n";
    } else {
        echo "Record was unable to be updated in PB table.\n";
    }

    // Record does not exist, add it to database.
    if ($con->query($sqlins) === true) {
        echo "Record updated in INT table.";
    } else {
        echo "Record was unable to be updated in INT table.";
    }

    //echo $sqlins; //check to see what is in update query
    //always close the connection
    mysqli_close($con);
?>

