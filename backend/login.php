<?php
    session_start();
    require("../require/db_connect.php");
    require("../require/config.php");
    require("../require/include_functions.php");

    $error               = false;
    $error_message       = "";

    if (isset($_COOKIE["user_id"]) || isset($_COOKIE["user_name"])) {
      $url               = $cp_base_url . "index.php";
      header("Location:" . $url);
      exit();
    } else if (isset($_SESSION["user_id"]) || isset($_SESSION["user_name"])) {
      $url               = $cp_base_url . "index.php";
      header("Location:" . $url);
      exit();
    } else {
      if (isset($_POST["submit"]) && $_POST["form-submit"] == 1) {
        $user_name         = $mysqli->real_escape_string($_POST["user_name"]);
        $password          = $_POST["password"];
  
        $check_blank_input = checkBlankInput($user_name );
        if (isset($check_blank_input["error"]) == true) {
          $error           = true;
          $error_message   = $check_blank_input["error_message"];
        }
  
        if ($error == false) {
          $sql             = "SELECT". 
                             " id,name,password ". 
                             "FROM".
                             " `user` ".
                             "WHERE".
                             " name = '". 
                             $user_name. 
                             "'";
          $result         = $mysqli->query($sql);
          $res_row         = $result->num_rows;
          
          if ($res_row >= 1) {
            while ($row = $result->fetch_assoc()) {
              $db_id                     = $row["id"];
              $db_name                   = $row["name"];
              $db_password               = $row["password"];
              $password                  = md5(md5($sha_key.$password));
            
              if ($db_password == $password) {
                if (isset($_POST["remember"]) && $_POST["remember"] == 1) {
                  $cookie_name_id        = "user_id";
                  $cookie_value_id       = $db_id;
                  $cookie_time           = strtotime("+20 days");
                  setcookie($cookie_name_id, $cookie_value_id, $cookie_time, "/");
  
                  $cookie_name           = "user_name";
                  $cookie_value          = $db_name;
                  setcookie($cookie_name, $cookie_value, $cookie_time, "/");
  
                  $url                   = $cp_base_url . "index.php";
                  header("Location:" . $url);
                  exit();
                } else {
                  $_SESSION["user_id"]   =   $db_id;
                  $_SESSION["user_name"] = $db_name;
  
                  $url                   = $cp_base_url . "index.php";
                  header("Location:" . $url);
                  exit();
                } 
              } else {
                $error          = true;
                $error_message  = "Wrong Password!!!";
              }
            }
          } else {
            $error              = true;
            $error_message      = "Input Name is Wrong!!!"; 
          }
        }  
      } else {
        $user_name              = "";
      }
    }   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login Dashboard</title>

    <!-- Bootstrap -->
    <link href="<?= $base_url ?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= $base_url ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= $base_url ?>assets/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= $base_url ?>assets/css/custom.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="<?= $base_url ?>assets/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?= $base_url ?>assets/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?= $base_url ?>assets/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- JavaScript -->
    <!-- jQuery -->
    <script src="<?= $base_url ?>assets/jquery/dist/jquery.min.js"></script>
    <!-- PNotify -->
    <script src="<?= $base_url ?>assets/pnotify/dist/pnotify.js"></script>
    <script src="<?= $base_url ?>assets/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?= $base_url ?>assets/pnotify/dist/pnotify.nonblock.js"></script>
  </head>
  <body class="login">
    
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?= $cp_base_url ?>/login.php" method="POST">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control rounded-0" name="user_name" value="<?= $user_name ?>" placeholder="Username"/>
              </div>
              <div>
                <input type="password" class="form-control rounded-0" name="password" placeholder="Password"/>
              </div>
              <div class="my-3 d-flex ml-4 justify-content-start">
                <input type="checkbox" name="remember" value="1" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Remember me</label>
              </div>
              <div>
                <button type="submit" name="submit" class="btn btn-secondary rounded-0 px-4 submit" href="index.html">Log in</button>
                <input type="hidden" name="form-submit" value="1"/>
              </div>

              <div class="separator">
                <div>
                  <p>&copy;Softguide ©2023 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <script>
      <?php if ($error == true) : ?>
        $(document).ready(function () {
          new PNotify({
            title   : 'Oh No!',
            text    : '<?= $error_message ?>',
            type    : 'error',
            styling : 'bootstrap3'
          });
        })
      <?php endif ?>
    </script>
  </body>
</html>
