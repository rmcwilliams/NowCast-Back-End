<?php
    // make sure you come back to this code and sanitize the get data

    // connect to database
    require_once('../dbConnect.php');

    // get site and date values from form
    $site = $_GET['site'];
    $date = $_GET['date'];

    $check = "SELECT * FROM INT_FIELD WHERE BEACH_NAME = '$site' AND DATE = '$date'";
    // Run the query
    $res = $con->query($check);

    $result = mysqli_fetch_assoc($res);

    //checks to see if there are any records in the database with the same beach name and date
    if (mysqli_num_rows($res) == 0) {
        // There was no previous record of the site name and date so this means we have to insert
        $win = "INSERT";
        // data sent to field.php form
        $data = array(
            'WIN'                   => $win
        );
    } else {
        // Data exists in the database

        //we have to update since there was data in the database
        $win = "EDIT";
        //array with all the values from the database
        $data = array(
            'TIME'                  => $result["TIME"],
            'LAKE_SPCOND'           => $result["LAKE_SPCOND"],
            'CLOUD_CAT'             => $result["CLOUD_CAT"],
            'LAKE_TEMP_C'           => $result["LAKE_TEMP_C"],
            'AIR_TEMP_C'            => $result["AIR_TEMP_C"],
            'LOCAL_RAIN24_IN'       => $result["LOCAL_RAIN24_IN"],
            'SHOREHEAD_FT'          => $result["SHOREHEAD_FT"],
            'WAVEHT_FT'             => $result["WAVEHT_FT"],
            'SECCHI_M'              => $result["SECCHI_M"],
            'LAKE_TURB_NTU'         => $result["LAKE_TURB_NTU"],
            'BATHER_CNT'            => $result["BATHER_CNT"],
            'BIRD_CNT'              => $result["BIRD_CNT"],
            'ALGAE_CAT'             => $result["ALGAE_CAT"],
            'DEBRIS_CAT'            => $result["DEBRIS_CAT"],
            'FECAL_CAT'             => $result["FECAL_CAT"],
            'ODOR_ORD'              => $result["ODOR_ORD"],
            'CSO_SEWAGE_ORD'        => $result["CSO_SEWAGE_ORD"],
            'SUBSEASON_ORD'         => $result["SUBSEASON_ORD"],
            'STREAM_GHT_FT'         => $result["STREAM_GHT_FT"],
            'STREAM_TURB_NTU'       => $result["STREAM_TURB_NTU"],
            'STREAM_SPCOND'         => $result["STREAM_SPCOND"],
            'STREAM2_GHT_FT'        => $result["STREAM_GHT_FT"],
            'STREAM2_TURB_NTU'      => $result["STREAM2_TURB_NTU"],
            'STREAM2_SPCOND'        => $result["STREAM2_SPCOND"],
            'WAVERUNUP_CAT'         => $result["WAVERUNUP_CAT"],
            'WEATHER_CAT'           => $result["WEATHER_CAT"],
            'PH'                    => $result["PH"],
            'INITIALS'              => $result["INITIALS"],
            'WIN'                   => $win
        );
    }

    // Always close the connection
    mysqli_close($con);
    echo (json_encode($data));
?>