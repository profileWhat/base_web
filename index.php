<?php
session_start();

if (isset($_SESSION["userid"]) && $_SESSION["userid"] === true) {
    header("location: src/view/main.php");
    exit;
} else header("location: src/view/login.php");