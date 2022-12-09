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
    
    if (isset($data["match_id"])) {
        $match_id = $data['match_id'];
        $sql = "DELETE FROM `Match` WHERE (`user_id1` = :id AND `user_id2` = :match_id) OR (`user_id1` = :match_id AND `user_id2` = :id) ";

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project");

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":match_id", $match_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $isDeleted = $stmt->execute();

        $stmt->closeCursor();
        $pdo = null;

        if ($isDeleted) {
            $api->respond(["status" => "success", "message" => "Match deleted"]);
        } else {
            $api->respondError(["status" => "Failure", "message" => "Match failed to update"], 500);
        }
    } else {
        $api->respondMissingData();
    }
} else {
    $api->respondFailedAuth();
}
?>