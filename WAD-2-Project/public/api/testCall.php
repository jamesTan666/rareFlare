<?php
// Sample Code

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Creates something similar to Axios, to call external APIs
// External APIs may need to be called from back-end
//   so that the external API key would not be exposed to client-side
$api_caller = new APICall();

// Request data to be passed with the API call
$req_data = ["password" => "abc"];

// Call external API with request data
$data = $api_caller->get("http://127.0.0.1:80/WAD2_Project/public/api/testAPI.php", $req_data);

// Display data retrieved
var_dump($data);
?>