<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

$api = new APICreate("POST");

$api->validate();

if (isset($_SESSION["id"])) {
    $data = $api->getData();
    $id = $_SESSION["id"];

    $content = $data["data"];

    $connMgr = new ConnectionManager();
    $db = $connMgr->getMongoConnection()->WAD_Project;

    $collection = $db->portfolios;
    $document = $collection->findOne(['user_id' => $id]);

    if ($document == null) {
        $state = $collection->insertOne(['user_id' => $id, 'portfolios' => [$content]]);
        $temp = $state->getInsertedId();

        if ($temp == null) {
            $api->respond(["status" => "Failed", "message" => "The portfolio failed to be initialised"]);
        } else {
            $api->respond(["status" => "Success", "message" => "Portfolio initialised"]);
        }
    } else {
        $state = $collection->updateOne(
            ['user_id' => $id], 
            ['$push' => ['portfolios' => $content]]
        ); 

        if (($state->getMatchedCount() == 1) && ($state->getModifiedCount() == 1)) {
            $api->respond(["status" => "Success", "message" => "Write-up added"]);
        } else {
            $api->respondError(["status" => "Failed", "message" => "Write-up could not be saved"]);
        }
    }
} else {
    $api->respondFailedAuth();
}
?>