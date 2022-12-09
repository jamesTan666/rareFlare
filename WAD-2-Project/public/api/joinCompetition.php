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
    
    if (isset($data["competition_id"])) {
        $competition_id = $data['competition_id'];
        $sql = "SELECT * FROM `User_Competition` WHERE `user_id` = :user_id AND `competition_id` = :competition_id ";

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project");

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":user_id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":competition_id", $competition_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $hasJoined = false;
        while ($row = $stmt->fetch()) {
            $hasJoined = true;
            break;
        }

        if ($hasJoined) {
            $stmt->closeCursor();
            $pdo = null;

            $api->respondError(["status" => "Failure", "message" => "User has already joined the competition"], 400);
        } else {
            $stmt->closeCursor();

            $sql = "INSERT INTO `User_Competition` (user_id, competition_id) VALUES (:user_id, :competition_id) ";
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(":user_id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":competition_id", $competition_id, PDO::PARAM_INT);
            $isSuccess = $stmt->execute();

            $stmt->closeCursor();
            $pdo = null;

            if ($isSuccess) {
                $api->respond(["status" => "Success", "message" => "User has been added to the competition"]);
            } else {
                $api->respondError(["status" => "Failure", "message" => "User has not been added to this competition"], 500);
            }
        }
    } else {
        $api->respondMissingData();
    }
} else {
    $api->respondFailedAuth();
}
?>