<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

$api = new APICreate("POST");

$api->validate();

if (isset($_SESSION['id'])) {
    $data = $api->getData();
    $id = $_SESSION['id'];

    if (isset($data["competition_id"]) && isset($data["name"]) && isset($data["is_private"])) {
        $competition_id = $data["competition_id"];
        $name = $data["name"];
        $is_private = $data["is_private"];


        $sql = "INSERT INTO `Group` (`name`, `competition_id`, `is_private`, `date_start`) VALUES (:name, :competition_id, :is_private, CURRENT_TIMESTAMP()) ";

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project"); 

        $pdo->beginTransaction();
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(":competition_id", $competition_id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":is_private", $is_private, PDO::PARAM_BOOL);
        $stmt->execute(); 
        $group_id = $pdo->lastInsertId();
        $isSuccess = $pdo->commit();

        $stmt->closeCursor();

        if ($isSuccess) {
            $sql = "INSERT INTO `User_Group` (`user_id`, `group_id`, `is_admin`) VALUES (:user_id, :group_id, :is_admin) ";

            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(":user_id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
            $stmt->bindParam(":is_admin", true, PDO::PARAM_BOOL);
            $isSuccess = $stmt->execute();

            $stmt->closeCursor();
            $pdo = null;

            if ($isSuccess) {
                $api->respond(["status" => "success", "message" => "Group created successfully"]);
            } else {
                $api->respondError(["status" => "success", "message" => "User failed to be added to the group"], 500);
            }
        } else {
            $pdo = null;

            $api->respondError(["status" => "failure", "message" => "Group failed to be created"], 500);
        }
    } else {
        $api->respondMissingData();
    }
} else {
    $api->respondFailedAuth();
}
?>