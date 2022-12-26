<?php
session_start();

if (isset($_SESSION["userId"]) && $_SESSION["userid"] == true) {
    header("location: src/view/main.php");
    exit;
} else header("location: src/view/login.php");