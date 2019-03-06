<?php
    include './Header.php';
    // if user doesn't have a token, send them back to login screen
    if (!isset($_SESSION['token'])) {
        header('Location: ../index.php');
        exit;
    }
?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- Bootstrap js -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
    <!-- js file used to process forms -->
    <script src="./js/main.js"></script>

    <!--<link rel="stylesheet" href="https://ny.water.usgs.gov/maps/nowcast/css/datepicker3.css">
    <script src="https://ny.water.usgs.gov/maps/nowcast/js/bootstrap-datepicker.js"></script> -->
      <!-- JQuery UI scripts -->
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <link rel="stylesheet" href="https://ny.water.usgs.gov/resources/demos/style.css">
      <!-- JQuery UI ends -->
  </head>
  <script>
    //sets the datepicker up
    $(function() {
        $("#datepicker").datepicker( {
            // sets date format
            dateFormat: "yy-mm-dd",
            onSelect: function(dateText, inst) {
                var date = $.datepicker.parseDate(inst.settings.dateFormat || $.datepicker._defaults.dateFormat, dateText, inst.settings);
                var dateText1 = $.datepicker.formatDate("yy-mm-dd", date, inst.settings);
                $("#datepicker1").text(dateText1);
            }
        } );
        $("#datepicker").datepicker("setDate", new Date);

        $("#datepicker1").datepicker( {
            // sets date format
            dateFormat: "yy-mm-dd",
            onSelect: function(dateText, inst) {
                var date = $.datepicker.parseDate(inst.settings.dateFormat || $.datepicker._defaults.dateFormat, dateText, inst.settings);
                var dateText1 = $.datepicker.formatDate("yy-mm-dd", date, inst.settings);
                $("#datepicker1").text(dateText1);
            }
        } );
        $("#datepicker1").datepicker("setDate", new Date);

        $("#datepicker2").datepicker( {
            // sets date format
            dateFormat: "yy-mm-dd",
            onSelect: function(dateText, inst) {
                var date = $.datepicker.parseDate(inst.settings.dateFormat || $.datepicker._defaults.dateFormat, dateText, inst.settings);
                var dateText1 = $.datepicker.formatDate("yy-mm-dd", date, inst.settings);
                $("#datepicker2").text(dateText1);
            }
        } );
        $("#datepicker2").datepicker("setDate", new Date);

        $("#datepicker3").datepicker( {
            // sets date format
            dateFormat: "yy-mm-dd",
            onSelect: function(dateText, inst) {
                var date = $.datepicker.parseDate(inst.settings.dateFormat || $.datepicker._defaults.dateFormat, dateText, inst.settings);
                var dateText1 = $.datepicker.formatDate("yy-mm-dd", date, inst.settings);
                $("#datepicker3").text(dateText1);
            }
        } );
        $("#datepicker3").datepicker("setDate", new Date);
    } );
  </script>
  <body>
    <div class="container">
        <!-- buttons -->
        <br>
        <div class="row">
            <div align="center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fieldData">Enter/Edit Field Data</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div align="center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ecoliData">Enter/Edit E. coli Data</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div align="center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#conditionData">Enter/Edit Condition Data</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div align="center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exportData">Export Data to CSV</button>
            </div>
        </div>
        <br>
        <!--<div class="row">
            <div align="center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelEntry">Model Entry</button>
            </div>
        </div>
        <br>-->
        <div class="row">
            <div align="center">
                <button type="button" class="btn btn-primary" onclick="location.href='./php/logoff.php'">Log Off</button>
            </div>
        </div>

        <!-- modals -->

        <!-- Modal -->
        <div id="fieldData" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title">Nowcast Field Data Entry</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="fieldDataForm">
                            <div class="form-group">
                                <label for="BEACH_NAME">Select site:</label>
                                <select class="form-control" id="BEACH_NAME">
                                    <option></option>
                                    <?php
                                        
                                        // retrieves the user login info from the session in order to only show the user their beaches
                                        $user = $_SESSION['username'];
                                        
                                        $sql = "SELECT BEACH_NAME FROM SYS_BEACHES, SYS_LOGIN WHERE SYS_LOGIN.USER_ID = '$user' AND (SYS_LOGIN.COOP_ID = SYS_BEACHES.COOP_ID OR SYS_LOGIN.COOP_ID = 'COUNTY_ALL') ORDER BY BEACH_NAME";
                                        $res = $con->query($sql);
                                        
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo '<option value="'.$row['BEACH_NAME'].'">'.$row['BEACH_NAME'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="datepicker">Date:</label>
                                <input type="text" class="form-control datepicker1" name="DATE" id="datepicker">
                            </div>

                            <button type="button" class="btn btn-success" id="check">Check</button>
                            <hr>
                            <div id = "parent-selector">
                                <div class="form-group">
                                    <label for="TIME">Time-EST: (HHMM):</label>
                                    <input type="text" class="form-control" id="TIME">
                                </div>
                                <div class="form-group">
                                    <label for="INITIALS">Initials:</label>
                                    <input type="text" class="form-control" id="INITIALS">
                                </div>
                                <div class="form-group">
                                    <label for="LAKE_SPCOND">Swim Area Conductance (&#181S/cm):</label>
                                    <input type="text" class="form-control" id="LAKE_SPCOND">
                                </div>
                                <div class="form-group">
                                    <label for="CLOUD_CAT">Cloud Cover:</label>
                                    <select class="form-control" id="CLOUD_CAT">
                                        <option>Select a number:</option>
                                        <option value="1">1 - None</option>
                                        <option value="2">2 - 1-25%</option>
                                        <option value="3">3 - 26-50%</option>
                                        <option value="4">4 - 51-75%</option>
                                        <option value="5">5 - 76-100%</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="LAKE_TEMP_C">Water Temperature (C):</label>
                                    <input type="text" class="form-control" id="LAKE_TEMP_C">
                                </div>
                                <div class="form-group">
                                    <label for="AIR_TEMP_C">Air Temperature (C):</label>
                                    <input type="text" class="form-control" id="AIR_TEMP_C">
                                </div>
                                <div class="form-group">
                                    <label for="SHOREHEAD_FT">Fore Shore Head (ft):</label>
                                    <input type="text" class="form-control" id="SHOREHEAD_FT">
                                </div>
                                <div class="form-group">
                                    <label for="LOCAL_RAIN24_IN">Rain Gage Total (in):</label>
                                    <input type="text" class="form-control" id="LOCAL_RAIN24_IN">
                                </div>
                                <div class="form-group">
                                    <label for="WAVEHT_FT">Wave Height (ft):</label>
                                    <input type="text" class="form-control" id="WAVEHT_FT">
                                </div>
                                <div class="form-group">
                                    <label for="SECCHI_M">Secchi Disk (in):</label>
                                    <input type="text" class="form-control" id="SECCHI_M">
                                </div>
                                <div class="form-group">
                                    <label for="LAKE_TURB_NTU">Swim Area Turbidity:</label>
                                    <input type="text" class="form-control" id="LAKE_TURB_NTU">
                                </div>
                                <div class="form-group">
                                    <label for="BATHER_CNT">Swimmer Count:</label>
                                    <input type="text" class="form-control" id="BATHER_CNT">
                                </div>
                                <div class="form-group">
                                    <label for="BIRD_CNT">Bird Count:</label>
                                    <input type="text" class="form-control" id="BIRD_CNT">
                                </div>
                                <div class="form-group">
                                    <label for="ALGAE_CAT">Algae:</label>
                                    <select class="form-control" id="ALGAE_CAT">
                                        <option>Select a number:</option>
                                        <option value="1">1 - None</option>
                                        <option value="2">2 - 1-25%</option>
                                        <option value="3">3 - 26-50%</option>
                                        <option value="4">4 - 51-75%</option>
                                        <option value="5">5 - 76-100%</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="DEBRIS_CAT">Shore Debris</label>
                                    <select class="form-control" id="DEBRIS_CAT">
                                        <option>Select a number:</option>
                                        <option value="1">1 - None</option>
                                        <option value="2">2 - 1-25%</option>
                                        <option value="3">3 - 26-50%</option>
                                        <option value="4">4 - 51-75%</option>
                                        <option value="5">5 - 76-100%</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="FECAL_CAT">Fecal Category</label>
                                    <select class="form-control" id="FECAL_CAT">
                                        <option>Select a number:</option>
                                        <option value="1">1 - None</option>
                                        <option value="2">2 - 1-25%</option>
                                        <option value="3">3 - 26-50%</option>
                                        <option value="4">4 - 51-75%</option>
                                        <option value="5">5 - 76-100%</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ODOR_ORD">Odor:</label>
                                    <select class="form-control" id="ODOR_ORD">
                                        <option>Select a number:</option>
                                        <option value="1">1 - No</option>
                                        <option value="2">2 - Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="CSO_SEWAGE_ORD">Combine Sewer Overflow:</label>
                                    <select class="form-control" id="CSO_SEWAGE_ORD">
                                        <option>Select a number:</option>
                                        <option value="1">1 - No</option>
                                        <option value="2">2 - Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="SUBSEASON_ORD">Season:</label>
                                    <select class="form-control" id="SUBSEASON_ORD">
                                        <option>Select a number:</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="PH">pH:</label>
                                    <input type="text" class="form-control" id="PH">
                                </div>
                                <div class="form-group">
                                    <label for="WAVERUNUP_CAT">Wave RunUp:</label>
                                    <select class="form-control" id="WAVERUNUP_CAT">
                                        <option>Select a number:</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="WEATHER_CAT">Weather Category:</label>
                                    <select class="form-control" id="WEATHER_CAT">
                                        <option>Select a number:</option>
                                        <option value="1">1 - Clear</option>
                                        <option value="2">2 - Partly Cloudy</option>
                                        <option value="3">3 - Overcast</option>
                                        <option value="4">4 - Light Rain</option>
                                        <option value="5">5 - Heavy Rain</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="STREAM_GHT_FT">Tributary 1 Gage Height (ft):</label>
                                    <input type="text" class="form-control" id="STREAM_GHT_FT">
                                </div>
                                <div class="form-group">
                                    <label for="STREAM_TURB_NTU">Tributary 1 Turbidity:</label>
                                    <input type="text" class="form-control" id="STREAM_TURB_NTU">
                                </div>
                                <div class="form-group">
                                    <label for="STREAM_SPCOND">Tributary 1 Conductance (&#181S/cm):</label>
                                    <input type="text" class="form-control" id="STREAM_SPCOND">
                                </div>
                                <div class="form-group">
                                    <label for="STREAM2_GHT_FT">Tributary 2 Gage Height (ft):</label>
                                    <input type="text" class="form-control" id="STREAM2_GHT_FT">
                                </div>
                                <div class="form-group">
                                    <label for="STREAM2_TURB_NTU">Tributary 2 Turbidity:</label>
                                    <input type="text" class="form-control" id="STREAM2_TURB_NTU">
                                </div>
                                <div class="form-group">
                                    <label for="STREAM2_SPCOND">Tributary 2 Conductance (&#181S/cm):</label>
                                    <input type="text" class="form-control" id="STREAM2_SPCOND">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default" id="fieldDataButton">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div id="ecoliData" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title">Nowcast E.coli Data Entry</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="ecoliDataForm">
                            <div class="form-group">
                                <label for="ecoliBEACH_NAME">Select site:</label>
                                <select class="form-control" id="ecoliBEACH_NAME">
                                    <option></option>
                                    <?php
                                        // DO YOU NEED TO RETYPE ALL OF THIS IF HAVE IT ABOVE?
                                        
                                        // retrieves the user login info from the session in order to only show the user their beaches
                                        $user = $_SESSION['username'];
                                        
                                        $sql = "SELECT BEACH_NAME FROM SYS_BEACHES, SYS_LOGIN WHERE SYS_LOGIN.USER_ID = '$user' AND (SYS_LOGIN.COOP_ID = SYS_BEACHES.COOP_ID OR SYS_LOGIN.COOP_ID = 'COUNTY_ALL') ORDER BY BEACH_NAME";
                                        $res = $con->query($sql);
                                        
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo '<option value="'.$row['BEACH_NAME'].'">'.$row['BEACH_NAME'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="datepicker1">Date:</label>
                                <input type="text" class="form-control datepicker1" name="DATE" id="datepicker1">
                            </div>


                            <button type="button" class="btn btn-success" id="ecoliCheck">Check</button>
                            <hr>

                            <div id = "parent-selector">
                                <div class="form-group">
                                    <label for="LAB_ECOLI">Enter E.coli values:</label>
                                    <input type="text" class="form-control" id="LAB_ECOLI">
                                </div>

                                <div class="form-group">
                                    <label for="ERROR_TYPE">Error Type:</label>
                                    <select class="form-control" id="ERROR_TYPE">
                                        <option value="">Select an Error Type:</option>
                                        <option>Correct Exceed</option>
                                        <option>Correct Non-Exceed</option>
                                        <option>False Exceed</option>
                                        <option>False Non-Exceed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ecoliTIME">Time-EST (HHMM):</label>
                                    <input class="form-control" type="text" id="ecoliTIME" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default" id="ecoliDataButton">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div id="conditionData" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title">Nowcast Conditions Data Entry</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="conditionDataForm">
                            <div class="form-group">
                                <label for="conditionBEACH_NAME">Select site:</label>
                                <select class="form-control" id="conditionBEACH_NAME">
                                    <option></option>
                                    <?php
                                        // DO YOU NEED TO RETYPE ALL OF THIS IF HAVE IT ABOVE?
                                        
                                        // retrieves the user login info from the session in order to only show the user their beaches
                                        $user = $_SESSION['username'];
                                        
                                        $sql = "SELECT BEACH_NAME FROM SYS_BEACHES, SYS_LOGIN WHERE SYS_LOGIN.USER_ID = '$user' AND (SYS_LOGIN.COOP_ID = SYS_BEACHES.COOP_ID OR SYS_LOGIN.COOP_ID = 'COUNTY_ALL') ORDER BY BEACH_NAME";
                                        $res = $con->query($sql);
                                        
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo '<option value="'.$row['BEACH_NAME'].'">'.$row['BEACH_NAME'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="datepicker2">Date:</label>
                                <input type="text" class="form-control datepicker1" name="DATE" id="datepicker2">
                            </div>


                            <button type="button" class="btn btn-success" id="conditionCheck">Check</button>
                            <hr>
                            
                            <div id = "parent-selector">
                                <div class="form-group">
                                    <label for="NOWCAST_PROBABILITY">Probability of Exceeding:</label>
                                    <input type="text" class="form-control" id="NOWCAST_PROBABILITY">
                                </div>

                                <div class="form-group">
                                    <label for="NOWCAST_ECOLI">Estimated E.coli:</label>
                                    <input type="text" class="form-control" id="NOWCAST_ECOLI">
                                </div>

                                <div class="form-group">
                                    <label for="BEACH_CONDITIONS">Site Condition:</label>
                                    <select class="form-control" id="BEACH_CONDITIONS">
                                        <option value="">Select a Condition:</option>
                                        <option>Good</option>
                                        <option>Advisory</option>
                                        <option>Closed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="BEACH_REASON">Reason:</label>
                                    <select class="form-control" id="BEACH_REASON">
                                        <option value="">Select a Reason:</option>
                                        <option>Rain Event</option>
                                        <option>No Life Guard on Duty</option>
                                        <option>High Wave Action</option>
                                        <option>Health</option>
                                        <option>Model Prediction</option>
                                        <option>Algal Bloom</option>
                                        <option>CSO Event</option>
                                        <option>qPCR Estimate</option>
                                        <option>Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="conditionTIME">Time-EST (HHMM):</label>
                                    <input type="text" class="form-control" id="conditionTIME">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default" id="conditionDataButton">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

            <!-- Modal -->
        <div id="exportData" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title">Nowcast E.coli Data Entry</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="./php/menuForms/export.php" method="post">
                            <div class="form-group">
                                <label for="exportBEACH_NAME">Select site:</label>
                                <select class="form-control" name="exportBEACH_NAME" id="exportBEACH_NAME">
                                    <option></option>
                                    <?php
                                        // DO YOU NEED TO RETYPE ALL OF THIS IF HAVE IT ABOVE?
                                        
                                        // retrieves the user login info from the session in order to only show the user their beaches
                                        $user = $_SESSION['username'];
                                        
                                        $sql = "SELECT BEACH_NAME FROM SYS_BEACHES, SYS_LOGIN WHERE SYS_LOGIN.USER_ID = '$user' AND (SYS_LOGIN.COOP_ID = SYS_BEACHES.COOP_ID OR SYS_LOGIN.COOP_ID = 'COUNTY_ALL') ORDER BY BEACH_NAME";
                                        $res = $con->query($sql);
                                        
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo '<option value="'.$row['BEACH_NAME'].'">'.$row['BEACH_NAME'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="BEACH_SEASON" id="BEACH_SEASON">
                                    <option>Select a Season</option>
                                    <?php
                                        $sql = "SELECT SEASON FROM SYS_SEASONS ORDER BY SEASON";
                                        $res = $con->query($sql);
                                        while($row = mysqli_fetch_assoc($res)){
                                            echo '<option value="'.$row['SEASON'].'">'.$row['SEASON'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="TABLE" id="TABLE">
                                    <option>Select the table to export</option>
                                    <option value="EXPORT">Model Data</option>
                                    <option value="CONDITIONS">Conditions Data</option>
                                </select>
                            </div>



                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

                <!-- Modal -->
        <div id="ecoliData" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title">Nowcast E.coli Data Entry</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="ecoliDataForm">
                            <div class="form-group">
                                <label for="ecoliBEACH_NAME">Select site:</label>
                                <select class="form-control" id="ecoliBEACH_NAME">
                                    <option></option>
                                    <?php
                                        // DO YOU NEED TO RETYPE ALL OF THIS IF HAVE IT ABOVE?
                                        
                                        // retrieves the user login info from the session in order to only show the user their beaches
                                        $user = $_SESSION['username'];
                                        
                                        $sql = "SELECT BEACH_NAME FROM SYS_BEACHES, SYS_LOGIN WHERE SYS_LOGIN.USER_ID = '$user' AND (SYS_LOGIN.COOP_ID = SYS_BEACHES.COOP_ID OR SYS_LOGIN.COOP_ID = 'COUNTY_ALL') ORDER BY BEACH_NAME";
                                        $res = $con->query($sql);
                                        
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo '<option value="'.$row['BEACH_NAME'].'">'.$row['BEACH_NAME'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="datepicker1">Date:</label>
                                <input type="text" class="form-control datepicker1" name="DATE" id="datepicker1">
                            </div>


                            <button type="button" class="btn btn-success" id="ecoliCheck">Check</button>
                            <hr>

                            <div id = "parent-selector">
                                <div class="form-group">
                                    <label for="LAB_ECOLI">Enter E.coli values:</label>
                                    <input type="text" class="form-control" id="LAB_ECOLI">
                                </div>

                                <div class="form-group">
                                    <label for="ERROR_TYPE">Error Type:</label>
                                    <select class="form-control" id="ERROR_TYPE">
                                        <option value="">Select an Error Type:</option>
                                        <option>Correct Exceed</option>
                                        <option>Correct Non-Exceed</option>
                                        <option>False Exceed</option>
                                        <option>False Non-Exceed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ecoliTIME">Time-EST (HHMM):</label>
                                    <input class="form-control" type="text" id="ecoliTIME" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default" id="ecoliDataButton">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div id="modelEntry" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title">Nowcast Model Entry</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="modelEntryForm">
                            <div class="form-group">
                                <label for="modelBEACH_NAME">Select site:</label>
                                <select class="form-control" id="modelBEACH_NAME">
                                    <option></option>
                                    <?php
                                        // DO YOU NEED TO RETYPE ALL OF THIS IF HAVE IT ABOVE?
                                        
                                        // retrieves the user login info from the session in order to only show the user their beaches
                                        $user = $_SESSION['username'];
                                        
                                        $sql = "SELECT BEACH_NAME FROM SYS_BEACHES, SYS_LOGIN WHERE SYS_LOGIN.USER_ID = '$user' AND (SYS_LOGIN.COOP_ID = SYS_BEACHES.COOP_ID OR SYS_LOGIN.COOP_ID = 'COUNTY_ALL') ORDER BY BEACH_NAME";
                                        $res = $con->query($sql);
                                        
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo '<option value="'.$row['BEACH_NAME'].'">'.$row['BEACH_NAME'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="datepicker3">Date:</label>
                                <input type="text" class="form-control datepicker1" name="DATE" id="datepicker3">
                            </div>


                            <button type="button" class="btn btn-success" id="modelCheck">Check</button>
                            <hr>
                            <div id = "parent-selector">
                                <div class="form-group">
                                    <label for="MODEL_NAME">Model Name:</label>
                                    <input type="text" class="form-control" id="MODEL_NAME">
                                </div>

                                <div class="form-group">
                                    <label for="MODEL_TYPE">Model Type:</label>
                                    <select class="form-control" id="MODEL_TYPE">
                                        <option value="">Select a Model Type:</option>
                                        <option>[option 1]</option>
                                        <option>[option 2]</option>
                                        <option>[option 3]</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="THRESHOLD">Threshold:</label>
                                    <input type="text" class="form-control" id="THRESHOLD">
                                </div>

                                <div class="form-group">
                                    <label for="VB_ORIENT">Virtual Beach Orientation:</label>
                                    <select class="form-control" id="VB_ORIENT">
                                        <option value="">Select a Virtual Beach Orientation:</option>
                                        <option>[option 1]</option>
                                        <option>[option 2]</option>
                                        <option>[option 3]</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="DEPEND_VAR">Dependent Variable:</label>
                                    <input type="text" class="form-control" id="DEPEND_VAR">
                                </div>

                                <div class="form-group">
                                    <label for="UNITS">Units:</label>
                                    <select class="form-control" id="UNITS">
                                        <option value="">Select Units:</option>
                                        <option>[option 1]</option>
                                        <option>[option 2]</option>
                                        <option>[option 3]</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="R_SQUARED">R Squared Value:</label>
                                    <input type="text" class="form-control" id="R_SQUARED">
                                </div>
                                
                                <div class="form-group">
                                    <label for="EQUATION">Equation:</label>
                                    <input type="text" class="form-control" id="EQUATION" placeholder="Paste exact equation from Virtual Beach here">
                                </div> 
                            </div>

                            <button type="submit" class="btn btn-default" id="modelEntryButton">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->                         <!-- how do these work at the bottom? -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
include 'Footer.php';
?>