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

    if (isset($data["group_id"])) {
        $group_id = $data["group_id"];

        $sql = "SELECT `is_admin` FROM `User_Group` WHERE `user_id` = :id AND `group_id = :group_id ";

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project");

        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute(); 

        $isValidUser = false;
        while ($row = $stmt->fetch()) {
            $isValidUser = $row["is_admin"];
            break;
        }

        $stmt->closeCursor();

        if ($isValidUser) {
            $sql = "DELETE FROM `Group` WHERE `group_id` = :group_id ";

            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
            $isSuccess = $stmt->execute();

            if ($isSuccess) {
                $api->respond(["status" => "success", "message" => "Group has been deleted"]);
            } else {
                $api->respondError(["status" => "failure", "message" => "Request failed to complete"], 500);
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