<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

$api = new APICreate("GET");

$api->validate();

if (isset($_SESSION['id'])) {
    $data = $api->getData();

    if (isset($data["competition_id"])) {
        $compId = $data["competition_id"];
        $sql = "SELECT * FROM `Competition` WHERE id = :id ";

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project");

        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(":id", $compId, PDO::PARAM_INT);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch()) {
            foreach ($row as $key => $value) {
                $result[$key] = $value;
            }
            break; 
        }

        $stmt->closeCursor();
        $pdo = null;

        if (!empty($result)) {
            $api->respond(["status" => "success", "data" => $result]);
        } else {
            $api->respond(["status" => "failure", "data" => []]);
        }
    } else {
        $api->respondMissingData();
    }
} else {
    $api->respondFailedAuth();
}