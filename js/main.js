var insert = true;

$(function() {
    $("[id=parent-selector] :input").attr("disabled", true);   // makes the form disabled
    // when user clicks "check" button
    $("#check").click(function() {
        var site = $("#BEACH_NAME").val();
        var date = $("#datepicker").val();
        //check to make sure user entered both site and date
        if (site == "" || date == "") {
            alert("Please enter a site and a date");
        } else {
            // enables the user to enter information into the rest of the form
            $("#fieldDataForm #parent-selector :input").attr("disabled", false);
            $.getJSON('./php/menuForms/fieldDataCheck.php', {site: site, date: date}, function(data) {
                // sets all the fields in the form equal to their database field values
                $("#TIME").val(data.TIME);
                $("#INITIALS").val(data.INITIALS);
                $("#LAKE_SPCOND").val(data.LAKE_SPCOND);
                $("#CLOUD_CAT").val(data.CLOUD_CAT);
                $("#LAKE_TEMP_C").val(data.LAKE_TEMP_C);
                $("#AIR_TEMP_C").val(data.AIR_TEMP_C);
                $("#LOCAL_RAIN24_IN").val(data.LOCAL_RAIN24_IN);
                $("#SHOREHEAD_FT").val(data.SHOREHEAD_FT);
                $("#WAVEHT_FT").val(data.WAVEHT_FT);
                $("#SECCHI_M").val(data.SECCHI_M);
                $("#LAKE_TURB_NTU").val(data.LAKE_TURB_NTU);
                $("#BATHER_CNT").val(data.BATHER_CNT);
                $("#BIRD_CNT").val(data.BIRD_CNT);
                $("#ALGAE_CAT").val(data.ALGAE_CAT);
                $("#DEBRIS_CAT").val(data.DEBRIS_CAT);
                $("#FECAL_CAT").val(data.FECAL_CAT);
                $("#ODOR_ORD").val(data.ODOR_ORD);
                $("#CSO_SEWAGE_ORD").val(data.CSO_SEWAGE_ORD);
                $("#SUBSEASON_ORD").val(data.SUBSEASON_ORD);
                $("#PH").val(data.PH);
                $("#WAVERUNUP_CAT").val(data.WAVERUNUP_CAT);
                $("#WEATHER_CAT").val(data.WEATHER_CAT);
                $("#STREAM_GHT_FT").val(data.STREAM_GHT_FT);
                $("#STREAM_TURB_NTU").val(data.STREAM_TURB_NTU);
                $("#STREAM_SPCOND").val(data.STREAM_SPCOND);
                $("#STREAM2_GHT_FT").val(data.STREAM2_GHT_FT);
                $("#STREAM2_TURB_NTU").val(data.STREAM2_TURB_NTU);
                $("#STREAM2_SPCOND").val(data.STREAM2_SPCOND);
                if (data.WIN == "INSERT") {
                    insert = true;
                } else { // are both of these needed?
                    insert = false;
                }
            });
        }
    })

    $("#ecoliCheck").click(function() {
        var site = $("#ecoliBEACH_NAME").val();
        var date = $("#datepicker1").val();
        //check to make sure user entered both site and date
        if (site == "" || date == "") {
            alert("Please enter a site and a date");
        } else {
            // enables the user to enter information into the rest of the form
            $("#ecoliDataForm #parent-selector :input").attr("disabled", false);
            $.getJSON('./php/menuForms/ecoliDataCheck.php', {site: site, date: date}, function(data) {
                // sets all the fields in the form equal to their database field values
                $("#LAB_ECOLI").val(data.LAB_ECOLI);
                $("#ERROR_TYPE").val(data.ERROR_TYPE);
                $("#WQS_EXCEED").val(data.WQS_EXCEED)
                if (data.WIN == "INSERT") {
                    insert = true;
                } else { // are both of these needed?
                    insert = false;
                }
            });
        }
    })

    $("#conditionCheck").click(function() {
        var site = $("#conditionBEACH_NAME").val();
        var date = $("#datepicker2").val();
        //check to make sure user entered both site and date
        if (site == "" || date == "") {
            alert("Please enter a site and a date");
        } else {
            // enables the user to enter information into the rest of the form
            $("#conditionDataForm #parent-selector :input").attr("disabled", false);
            $.getJSON('./php/menuForms/conditionDataCheck.php', {site: site, date: date}, function(data) {
                // sets all the fields in the form equal to their database field values
                $("#NOWCAST_PROBABILITY").val(data.NOWCAST_PROBABILITY);
                $("#NOWCAST_ECOLI").val(data.NOWCAST_ECOLI);
                $("#BEACH_CONDITIONS").val(data.BEACH_CONDITIONS);
                $("#BEACH_REASON").val(data.BEACH_REASON);
                $("#conditionTIME").val(data.TIME);
                if (data.WIN == "INSERT") {
                    insert = true;
                } else { // are both of these needed?
                    insert = false;
                }
            });
        }
    })

    $("#fieldDataButton").click(function() {

        var BEACH_NAME = $("#BEACH_NAME").val();
        var datepicker = $("#datepicker").val();
        var TIME = $('#TIME').val();
        var INITIALS = $("#INITIALS").val();
        var LAKE_SPCOND = $("#LAKE_SPCOND").val();
        var CLOUD_CAT = $("#CLOUD_CAT").val();
        var LAKE_TEMP_C = $("#LAKE_TEMP_C").val();
        var AIR_TEMP_C = $("#AIR_TEMP_C").val();
        var LOCAL_RAIN24_IN = $("#LOCAL_RAIN24_IN").val();
        var SHOREHEAD_FT = $("#SHOREHEAD_FT").val();
        var WAVEHT_FT = $("#WAVEHT_FT").val();
        var SECCHI_M = $("#SECCHI_M").val();
        var LAKE_TURB_NTU = $("#LAKE_TURB_NTU").val();
        var BATHER_CNT = $("#BATHER_CNT").val();
        var BIRD_CNT = $("#BIRD_CNT").val();
        var ALGAE_CAT = $("#ALGAE_CAT").val();
        var DEBRIS_CAT = $("#DEBRIS_CAT").val();
        var FECAL_CAT = $("#FECAL_CAT").val();
        var ODOR_ORD = $("#ODOR_ORD").val();
        var CSO_SEWAGE_ORD = $("#CSO_SEWAGE_ORD").val();
        var SUBSEASON_ORD = $("#SUBSEASON_ORD").val();
        var PH = $("#PH").val();
        var WAVERUNUP_CAT = $("#WAVERUNUP_CAT").val();
        var WEATHER_CAT = $("#WEATHER_CAT").val();
        var STREAM_GHT_FT = $("#STREAM_GHT_FT").val();
        var STREAM_TURB_NTU = $("#STREAM_TURB_NTU").val();
        var STREAM_SPCOND = $("#STREAM_SPCOND").val();
        var STREAM2_GHT_FT = $("#STREAM2_GHT_FT").val();
        var STREAM2_TURB_NTU = $("#STREAM2_TURB_NTU").val();
        var STREAM2_SPCOND = $("#STREAM2_SPCOND").val();

        //check to make sure required fields are filled out

        if (TIME == "") {
            alert("Time-Local is a required field.");
            return false;
        }

        if (INITIALS == "") {
            alert("Initials is a required field.");
            return false;
        }

        //check to make sure format of fields is correct
        if (isNaN(TIME)) {
            alert("Time-EST must be numeric.");
            return false;
        }
        if (INITIALS != "" && !(/^[a-z]+$/i.test(INITIALS))) {
            alert("Initials must only contain letters.");
            return false;
        }
        if (isNaN(LAKE_SPCOND)) {
            alert("Swim Area Conductance must be numeric.");
            return false;
        }
        if (isNaN(LAKE_TEMP_C)) {
            alert("Water Temperature must be numeric.");
            return false;
        }
        if (isNaN(AIR_TEMP_C)) {
            alert("Air Temperature must be numeric.");
            return false;
        }
        if (isNaN(SHOREHEAD_FT)) {
            alert("Fore Shore Head must be numeric.");
            return false;
        }
        if (isNaN(LOCAL_RAIN24_IN)) {
            alert("Rain Gage Total must be numeric.");
            return false;
        }
        if (isNaN(WAVEHT_FT)) {
            alert("Wave Height must be numeric.");
            return false;
        }
        if (isNaN(SECCHI_M)) {
            alert("Secchi Disk must be numeric.");
            return false;
        }
        if (isNaN(LAKE_TURB_NTU)) {
            alert("Swim Area Turbidity must be numeric.");
            return false;
        }
        if (isNaN(BATHER_CNT)) {
            alert("Swimmer Count must be numeric.");
            return false;
        }
        if (isNaN(BIRD_CNT)) {
            alert("Bird Count must be numeric.");
            return false;
        }
        if (isNaN(PH)) {
            alert("pH must be numeric.");
            return false;
        }
        if (isNaN(STREAM_GHT_FT)) {
            alert("Tributary 1 Gage Height must be numeric.");
            return false;
        }
        if (isNaN(STREAM_TURB_NTU)) {
            alert("Tributary 1 Turbidity must be numeric.");
            return false;
        }
        if (isNaN(STREAM_SPCOND)) {
            alert("Tributary 1 Conductance must be numeric.");
            return false;
        }
        if (isNaN(STREAM2_GHT_FT)) {
            alert("Tributary 2 Gage Height must be numeric.");
            return false;
        }
        if (isNaN(STREAM2_TURB_NTU)) {
            alert("Tributary 2 Turbidity must be numeric.");
            return false;
        }
        if (isNaN(STREAM2_SPCOND)) {
            alert("Tributary 2 Conductance must be numeric.");
            return false;
        }

        //process the form further using ajax call
        var http = new XMLHttpRequest();
        var url;
        if (insert) {
            url = './php/menuForms/fieldDataInsert.php';
        } else {
            url = './php/menuForms/fieldDataEdit.php';
        }
        var params = "BEACH_NAME=" + BEACH_NAME + "&DATE=" + datepicker + "&TIME=" + TIME + "&INITIALS=" + INITIALS + "&LAKE_SPCOND=" + LAKE_SPCOND 
        + "&CLOUD_CAT=" + CLOUD_CAT + "&LAKE_TEMP_C=" + LAKE_TEMP_C + "&AIR_TEMP_C=" + AIR_TEMP_C + "&LOCAL_RAIN24_IN="
        + LOCAL_RAIN24_IN + "&SHOREHEAD_FT=" + SHOREHEAD_FT + "&WAVEHT_FT=" + WAVEHT_FT + "&SECCHI_M=" + SECCHI_M +
        "&LAKE_TURB_NTU=" + LAKE_TURB_NTU + "&BATHER_CNT=" + BATHER_CNT + "&BIRD_CNT=" + BIRD_CNT + "&ALGAE_CAT=" + ALGAE_CAT + "&DEBRIS_CAT=" +
        DEBRIS_CAT + "&FECAL_CAT=" + FECAL_CAT + "&ODOR_ORD=" + ODOR_ORD + "&CSO_SEWAGE_ORD=" + CSO_SEWAGE_ORD +
        "&SUBSEASON_ORD=" + SUBSEASON_ORD + "&PH=" + PH + "&WAVERUNUP_CAT=" + WAVERUNUP_CAT + "&WEATHER_CAT=" + WEATHER_CAT
        + "&STREAM_GHT_FT=" + STREAM_GHT_FT + "&STREAM_TURB_NTU=" + STREAM_TURB_NTU + "&STREAM_SPCOND=" + STREAM_SPCOND
        + "&STREAM2_GHT_FT=" + STREAM2_GHT_FT + "&STREAM2_TURB_NTU=" + STREAM2_TURB_NTU + "&STREAM2_SPCOND=" + STREAM2_SPCOND;

        http.open('POST', url, true);

        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        //Call a function when the state changes
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        };
        http.send(params);
        return false;
    });

    $("#ecoliDataButton").click(function() {
        var site = $("#ecoliBEACH_NAME").val();
        var date = $("#datepicker1").val();
        var LAB_ECOLI = $("#LAB_ECOLI").val();
        var ERROR_TYPE = $("#ERROR_TYPE").val();
        var WQS_EXCEED = $("#WQS_EXCEED").val();

        //process the form further using ajax call
        var http = new XMLHttpRequest();
        var url;

        if (insert) {
            url = './php/menuForms/ecoliDataInsert.php';
        } else {
            url = './php/menuForms/ecoliDataEdit.php';
        }

        var params = "BEACH_NAME=" + site + "&DATE=" + date + "&LAB_ECOLI=" + LAB_ECOLI + "&ERROR_TYPE=" + ERROR_TYPE + "&WQS_EXCEED=" + WQS_EXCEED;

        http.open('POST', url, true);

        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        //Call a function when the state changes
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        };
        http.send(params);
        return false;
    });

    $("#conditionDataButton").click(function() {
        var site = $("#conditionBEACH_NAME").val();
        var date = $("#datepicker2").val();
        var NOWCAST_PROBABILITY = $("#NOWCAST_PROBABILITY").val();
        var NOWCAST_ECOLI = $("#NOWCAST_ECOLI").val();
        var BEACH_CONDITIONS = $("#BEACH_CONDITIONS").val();
        var BEACH_REASON = $("#BEACH_REASON").val();
        var TIME = $("#conditionTIME").val();

        if (isNaN(NOWCAST_PROBABILITY)) {
            alert("Probability of Exceeding must be numeric.");
            return false;
        }
        if (isNaN(NOWCAST_ECOLI)) {
            alert("Estimated E.coli must be numeric.");
            return false;
        }
        if (isNaN(TIME)) {
            alert("Time-EST must be numeric.");
            return false;
        }

        //process the form further using ajax call
        var http = new XMLHttpRequest();
        var url; //can var url be inside of the if else statement below or will it not be in the same scope?

        if (insert) {
            url = './php/menuForms/conditionDataInsert.php';
        } else {
            url = './php/menuForms/conditionDataEdit.php';
        }

        var params = "BEACH_NAME=" + site + "&DATE=" + date + "&NOWCAST_PROBABILITY=" + NOWCAST_PROBABILITY + "&NOWCAST_ECOLI=" + NOWCAST_ECOLI + 
        "&BEACH_CONDITIONS=" + BEACH_CONDITIONS + "&BEACH_REASON=" + BEACH_REASON + "&TIME=" + TIME;

        http.open('POST', url, true);

        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        //Call a function when the state changes
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        };
        http.send(params);
        return false;
    });
});