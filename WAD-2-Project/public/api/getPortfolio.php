<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

$api = new APICreate("GET");

$api->validate();

if (isset($_SESSION["id"])) {
    $data = $api->getData();
    if (isset($data["user_id"])) {
        $id = $data["user_id"];
    } else {
        $id = $_SESSION["id"];
    }

    $connMgr = new ConnectionManager();
    $db = $connMgr->getMongoConnection()->WAD_Project;

    $collection = $db->portfolios;
    $result = $collection->findOne(
        ['user_id' => $id], 
        ['portfolios' => 1]
    );

    if ($result == null) {
        $api->respond(["status" => "Failure", "data" => []]);
    } else {
        $collec = $result["portfolios"];
        foreach ($collec as $docs) {
            $temp = new \DBlackborough\Quill\Render(json_encode($docs["doc"]));
            $docs["doc"] = $temp->render();
        }
        $api->respond(["status" => "Success", "data" => $collec]);
    }
} else {
    $api->respondFailedAuth();
}
?>