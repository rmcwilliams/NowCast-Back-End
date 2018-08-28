<?php
  include './Header.php';
?>
  <div class="container" style="margin: 0; position: absolute; top: 50%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%); width:50%">
    <form action="php/login.php" method="post">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="username" type="text" class="form-control" name="username" placeholder="Username">
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <!--<input type="submit" value="Submit" name="submit">-->
      <br>
      <center><button type="submit" class="btn" name="submit">Submit</button></center>
    </form>
  </div>
<?php
include 'Footer.php';
?>