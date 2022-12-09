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

        if ($isDeleted) {
            $stmt->closeCursor();

            $sql = "SELECT * FROM `Connection_Request` WHERE `from_id` = :id AND `to_id` = :match_id ";
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":match_id", $match_id, PDO::PARAM_INT);
            $stmt->execute();

            $hasRequestBefore = false;
            while ($row = $stmt->fetch()) {
                $hasRequestBefore = true;
                break;
            }

            if ($hasRequestBefore) {
                $stmt->closeCursor();
                $pdo = null;

                $api->respondError(["status" => "failure", "message" => "Request already existing"], 400);
            } else {
                $stmt->closeCursor();

                $sql = "INSERT INTO `Connection_Request` (from_id, to_id) VALUES (:id, :match_id) ";
                $stmt = $pdo->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->bindParam(":match_id", $match_id, PDO::PARAM_INT);
                $isRequested = $stmt->execute();

                $stmt->closeCursor();
                $pdo = null;

                if ($isRequested) {
                    $api->respond(["status" => "success", "message" => "Connection Request sent"]);
                } else {
                    $api->respondError(["status" => "failure", "message" => "Request failed to sent"], 500);
                }
            }
        } else {
            $stmt->closeCursor();
            $pdo = null;

            $api->respondError(["status" => "failure", "message" => "Match failed to update"], 500);
        }
    } else {
        $api->respondMissingData();
    }
} else {
    $api->respondFailedAuth();
}
?>