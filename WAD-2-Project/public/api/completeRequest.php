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

        $sql = "SELECT * FROM `Connection_Request` WHERE to_id = :id AND from_id = :match_id ";

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project");

        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":match_id", $match_id, PDO::PARAM_INT);
        $stmt->execute();

        $isValid = false;
        while ($row = $stmt->fetch()) {
            $isValid = true;
            break;
        }
        $stmt->closeCursor();

        if ($isValid) {
            $sql = "DELETE FROM `Connection_Request` WHERE (`from_id` = :id AND `to_id` = :match_id) OR (`from_id` = :match_id AND `to_id` = :id) ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":match_id", $match_id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $isDeleted = $stmt->execute();

            if ($isDeleted) {
                $stmt->closeCursor();

                $sql = "SELECT * FROM `Connection` WHERE (`user_id1` = :id AND `user_id2` = :match_id) OR (`user_id1` = :match_id AND `user_id2` = :id) ";
                $stmt = $pdo->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->bindParam(":match_id", $match_id, PDO::PARAM_INT);
                $stmt->execute();

                $hasConnectionBefore = false;
                while ($row = $stmt->fetch()) {
                    $hasConnectionBefore = true;
                    break;
                }

                if ($hasConnectionBefore) {
                    $stmt->closeCursor();
                    $pdo = null;

                    $api->respondError(["status" => "failure", "message" => "Connection already existing"], 400);
                } else {
                    $stmt->closeCursor();

                    $sql = "INSERT INTO `Connection` (user_id1, user_id2) VALUES (:id, :match_id) ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                    $stmt->bindParam(":match_id", $match_id, PDO::PARAM_INT);
                    $isConnected = $stmt->execute();

                    $stmt->closeCursor();
                    $pdo = null;

                    if ($isConnected) {
                        $api->respond(["status" => "success", "message" => "Connection made"]);
                    } else {
                        $api->respondError(["status" => "failure", "message" => "Connection failed"], 500);
                    }
                }
            } else {
                $stmt->closeCursor();
                $pdo = null;

                $api->respondError(["status" => "failure", "message" => "Request failed to update"], 500);
            }
        } else {
            $pdo = null;
            
            $api->respondError(["status" => "failure", "message" => "User not allowed to perform this request"]);
        }
    } else {
        $api->respondMissingData();
    }
} else {
    $api->respondFailedAuth();
}
?>