<?php
include '../Header.php'; //how does it find this?
//connect to database
require_once('./dbConnect.php');
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

// check if login info matches user in db
$check = "SELECT * FROM SYS_LOGIN where USER_ID = '$username' AND USER_PASSWORD = '$password'";

//run the query
$res = $con->query($check);

// if there is no match, echo a message
if (mysqli_num_rows($res) == 0) {
    echo "The login information does not match our records";
} else {
    // if there is a match, set session variables
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['token'] = $username;
    // send user to menu.php
    header('Location: ../menu.php'); //correct path?
    exit; //learn why you want to exit here and not do mysqli_close($con)
}
mysqli_close($con);
?>