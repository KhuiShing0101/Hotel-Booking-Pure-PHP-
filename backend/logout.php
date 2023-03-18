<?php 

session_start();
require("../require/config.php");
session_destroy();

$cookie_name_id  = "user_id";
$cookie_value_id = "";
$cookie_time     = strtotime("-20 days");
setcookie($cookie_name_id, $cookie_value_id, $cookie_time, "/");

$cookie_name     = "user_name";
$cookie_value    = "";
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$url             = $cp_base_url . "login.php";
header("Location:" . $url);
exit();