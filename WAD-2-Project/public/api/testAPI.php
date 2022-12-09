<?php
// Sample Code

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Turns this PHP file into an API that only accepts GET requests
$api = new APICreate("GET");

// Ensure that this file is called as a GET request
$api->validate();

// Get JSON or Query string data that user sends when calling this API 
$data = $api->getData();

if (!isset($data["password"])) {
    // Missing data, e.g. user does not send data for the 
    //  parameter called "test"
    $api->respondMissingData();
} elseif ($data["password"] !== "abc") {
    // Simulate user not logged in or has wrong credentials
    $api->respondFailedAuth();
} elseif ($data["error"] === "simulate_error") {
    // Simulate error for whatever reason
    $api->respondError(["msg" => "Error present. Please try again."], 403);
} else {
    // No problems with the API call, most likely will be handled successfully

    // Code that retrieve data from SQL or modify it in whatever way needed
    //   goes here
    $conf = parse_ini_file("../../config.ini"); // Code that gets data from config file

    // Sample data retrieved from database
    $return_data = [
        "status" => "successful", 
        "message" => $conf["SQLPassword"] 
    ];

    // Returns user data in JSON format
    $api->respond($return_data);
}
?>