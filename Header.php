<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Entry System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .header {
        background-color: #f1f1f1;
        padding: 20px;
        text-align: center;
    }
    .topright {
        position: absolute;
        top: 8px;
        right: 16px;
        font-size: 18px;
    }
</style>
</head>
<body>
  <div class="header">
    <h2>The Great Lakes NowCast Data Entry System</h2>
    <?php
        require_once('/php/dbConnect.php');
        // either show login or logoff
        if (!isset($_SESSION['token'])) {
            echo '<a class="topright" href="./index.php" style="text-decoration: none;">Login</a>';
        } else {
            echo '<div class="topright">' . $_SESSION['username'] . ': <a href="./php/logoff.php" style="text-decoration: none;">Logoff</a></div>';
        }
    ?>
  </div>