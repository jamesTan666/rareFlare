<?php
// Includes all packages from Composer;
require_once "../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../src/common.php";

// use Firebase\JWT\JWT;

session_start();

// $api = new APICreate("POST");

// $api->validate();

if (isset($_SESSION["id"])) {
    unset($_SESSION["id"]);

    header("Location: auth.php");
    exit;

    // $result = ["status" => "Success", "message" => "Logout successfully"];
    // $api->respond($result);
} else {
    // $api->respondFailedAuth();

    header("Location: auth.php");
    exit;
}
?>