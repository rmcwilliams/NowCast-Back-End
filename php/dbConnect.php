<?php
    session_start();
    // database info (USGS Natweb MySQL Server)
	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "glnowcast";

    // connection
    $con = new mysqli($host,$username,$password,$db);
    if ($con->connect_errno > 0) {
        die("ERROR 01: Failed to connect to MySQL");
    }
?>