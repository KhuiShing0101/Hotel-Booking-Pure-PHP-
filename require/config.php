<?php

$base_url    = "http://localhost/hotel/";
$cp_base_url = "http://localhost/hotel/backend/";
$sha_key     = "584h2vcjAHfo";
$currentDt   = date("Y-m-d H:i:s");

if (isset($_SESSION["user_id"])) {
    $loginId = $_SESSION["user_id"];
} else if (isset($_COOKIE["user_id"])) {
    $loginId = $_COOKIE["user_id"];
}