<?php

    $BEACH_NAME = htmlspecialchars($_POST['exportBEACH_NAME']);
    $SEASON = htmlspecialchars($_POST['BEACH_SEASON']);
	$TABLE = htmlspecialchars($_POST['TABLE']);
    
    $ExportSchema = "DATE, ECOLI, USGS_ID, BEACH_NAME, TIME, SHOREHEAD_FT, SH_PREDAY, " .
      "STREAM_GHT_FT, STREAM_GHT_PREDAY, STREAM_TURB_NTU, STREAM_TURB_PREDAY, " .
      "STREAM_SPCOND, WAVEHT_FT, SECCHI_M, LAKE_TURB_NTU, LAKE_SPCOND, LAKE_TEMP_C, " .
      "AIR_TEMP_C, BATHER_CNT, BIRD_CNT, ALGAE_CAT, DEBRIS_CAT, FECAL_CAT, CLOUD_CAT, " .
      "ODOR_ORD, CSO_SEWAGE_ORD, SUBSEASON_ORD, LOCAL_RAIN24_IN, DAYOFYEAR, WINDSPANT24_MPH, " .
      "WINDDIRANT24_DEG, WINDSPINST_MPH, WINDDIRINST_DEG, AIRPORTRAIN24_IN, AIRPORTRAIN48_IN, " .
      "AIRPORTRAIN72_IN, AIRPORTRAIN48SUM_IN, AIRPORTRAIN72SUM_IN, AIRPORTRAIN48W_IN, AIRPORTRAIN72W_IN, " .
      "BARPRESSUREINST_INHG, BAR_PREDAY, LAKE_LEVEL, LL_PREDAY, " .
      "FLOW_MEAN, FLOW48WT, FLOW72WT, FLOW96WT, WAVEDIR_24HR, WAVEHEIGHT_24HR, " .
      "CLOUDCOVER_24HR, WATERTEMP_24HR, EVWATER_24HR, NVWATER_24HR, ANGLE_V_24HR, " .
      "MAGNITUDE_24HR, PARALLEL_CURRENT_24HR, PARALLEL_WAVEHT_24HR, PARALLEL_WAVEDIR_24HR, " .
      "PERP_CURRENT_24HR, PERP_WAVEHT_24HR, PERP_WAVEDIR_24HR, " .
      "STREAM2_GHT_FT, STREAM2_GHT_PREDAY, STREAM2_TURB_NTU, STREAM2_TURB_PREDAY, STREAM2_SPCOND, " .
      "WAVERUNUP_CAT, WEATHER_CAT, SOLRAD_DML, WC_INS, WC_4HR, DIS_INS730, DIS_INS800, USGSRAIN24, " .
      "USGSRAIN48, USGSRAIN72, USGSRAIN48W, USGSRAIN72W, USGSWSP_INS, USGSWDIR_INS, RADRAIN24, " .
      "RADRAIN48, RADR48W, PH";

    $ExportHdr = "DATE,Ecoli,log10,ID,NAME,Time,ShoreHead_ft,SH_PreDay,Stream_Ght_ft,Stream_Ght_PreDay," .
      "Stream_Turb_NTU,Stream_Turb_PreDay,Stream_SpCond,WaveHt_Ft,Secchi_m,Lake_Turb_NTU," .
      "Lake_SpCond,Lake_Temp_C,Air_Temp_C,Bather_cnt,Bird_cnt,Algae_Cat,Debris_Cat,Fecal_Cat," .
      "Cloud_Cat,Odor_Ord,CSO_Sewage_Ord,SubSeason_Ord,Local_Rain24_in,DayofYear,WindSpAnt24_mph," .
      "WindDirAnt24_deg,WindSpInst_mph,WindDirInst_deg,AirportRain24_in,AirportRain48_in," .
      "AirportRain72_in,AirportRain48Sum_in,AirportRain72Sum_in,AirportRain48W_in,AirportRain72W_in," .
      "BarPressureInst_inhg,Bar_PreDay," .
      "Lake_Level,LL_PreDay,FLOW_Mean,FLOW48WT,FLOW72WT,FLOW96WT,WaveDir_24hr,WaveHeight_24hr," .
      "CloudCover_24hr,WaterTemp_24hr,EvWater_24hr,NvWater_24hr,Angle_v_24hr,Magnitude_24hr," .
      "Parallel_Current_24hr,Parallel_WaveHt_24hr,Parallel_WaveDir_24hr,Perp_Current_24hr," .
      "Perp_WaveHt_24hr,Perp_WaveDir_24hr," .
      "Stream2_Ght_ft,Stream2_Ght_PreDay,Stream2_Turb_NTU,Stream2_Turb_PreDay,Stream2_SpCond," .
      "WaveRunUp_Cat,Weather_Cat,SolRad_dm1,WC_ins,WC_4hr,Dis_ins730,Dis_ins800,USGSRain24,USGSRain48," .
      "USGSRain72,USGSRain48W,USGSRain72W,USGSWSp_ins,USGSWDir_ins,RadRain24,RadRain48,RadR48W,pH";
      
    $CondSchema = "DATE, TIME, COOP_ID, BEACH_NAME, BEACH_CONDITIONS, BEACH_REASON, BEACH_TIME, NOWCAST_PROBABILITY, " .
       "NOWCAST_ECOLI, LAB_ECOLI, ERROR_TYPE, WQS_EXCEED";
    $CondHdr = "DATE,TIME,COOP_ID,BEACH_NAME,BEACH_CONDITIONS,BEACH_REASON,BEACH_TIME,NOWCAST_PROBABILITY," .
       "NOWCAST_ECOLI,LAB_ECOLI,ERROR_TYPE,WQS_EXCEED";

    $HABSchema = "";
    $HABHdr = "";

    $NeedQuotes = array("DATE", "USGS_ID", "BEACH_NAME", "TIME", "BEACH_REASON", "ERROR_TYPE");
    
    //database connection info
    require_once('../dbConnect.php');
    
    $select = "SELECT * FROM SYS_SEASONS WHERE SEASON='$SEASON'";
    $selres = $con->query($select);
    $season_info = mysqli_fetch_assoc($selres);
 
    $BEGDATE = $season_info['STARTDATE'];
    $ENDDATE = $season_info['ENDDATE'];
    
	if ($TABLE == "EXPORT") {
		$Schema = $ExportSchema;
		$Hdr = $ExportHdr;
		$tbl = $TABLE;
	} elseif ($TABLE == "CONDITIONS") {
		$Schema = $CondSchema;
		$Hdr = $CondHdr;
		$tbl = $TABLE;
	} elseif ($TABLE == "HAB") {
		$Schema = $HABSchema;
		$Hdr = $HABHdr;
		$tbl = "EXPORT";
	}

    // Query the database for the beach season data and retreive the first recond.
	//echo $BEACH_NAME;
    $export = "SELECT * FROM PB_$tbl WHERE BEACH_NAME = '$BEACH_NAME' AND DATE BETWEEN '$BEGDATE' AND '$ENDDATE' ORDER BY DATE";

    $res = $con->query($export);

    // Set up the file for the download

	if (mysqli_num_rows($res) == 0) {
        echo "No data exists for $BEACH_NAME in $SEASON.<br>";
        echo "Please press the browser's Back button and make another selection.";
        exit();
    }

    // $BName = strtolower(str_replace(" ", "", $BEACH_NAME));	
    // $FileName = $BName . "_" . date("Y-m-d_H:i:s") . '.csv';
    $FileName = strtolower(str_replace(" ", "", $BEACH_NAME . "_" . $BEGDATE . "_" . $ENDDATE . "_" . $TABLE . ".csv")); 
    $payload = $Hdr . "\n";
    
    // Process the retrieved records.
    $row = mysqli_fetch_assoc($res);
    while($row) {
       foreach(explode(', ', $Schema) as $field) {
           if (in_array($field, $NeedQuotes)) {
               $payload .= '"' . $row[$field] . '",';
           } elseif ($field == "ECOLI") {
               $payload .= $row[$field] . ',' . log10((double)$row[$field]) . ',';
           } else {
               $payload .= $row[$field] . ',';
           }
       }
       $payload .= "\n";
       $row = mysqli_fetch_assoc($res);
    }

    //always close the connection
    mysqli_close($con);

    // Allow user to download the export data.
    header('Content-Type: application/csv'); 
    // header("Content-length: " . filesize($NewFile)); 
    header('Content-Disposition: attachment; filename="' . $FileName . '"'); 
    echo $payload;
    exit();  
?>
