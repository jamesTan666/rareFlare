<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

$api = new APICreate("GET");

$api->validate();

$connMgr = new ConnectionManager();
$db = $connMgr->getMongoConnection();

$collection = $db->test->messages; 
$document = $collection->insertOne([
    "message" => "one"
]);

$id = $document->getInsertedId()->oid;

$result = $collection->findOne(["oid" => $id])["message"];

$api->respond(["data" => [$result]]);
?>