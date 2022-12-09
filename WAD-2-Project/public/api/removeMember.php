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

    if (isset($data["group_id"]) && isset($data["user_id"])) {
        $group_id = $data["group_id"];
        $user_id = $data["user_id"];

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
            $sql = "SELECT * FROM `User_Group` WHERE `user_id` = :user_id AND `group_id` = :group_id ";

            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute(); 

            $isValidEntry = false;
            while ($row = $stmt->fetch()) {
                $isValidEntry = true;
                break;
            }

            $stmt->closeCursor();

            if ($isValidEntry) {
                $sql = "DELETE FROM `User_Group` WHERE `group_id` = :group_id AND `user_id` = :user_id ";
    
                $stmt = $pdo->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
                $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
                $isSuccess = $stmt->execute(); 

                $stmt->closeCursor();
                $pdo = null;

                if ($isSuccess) {
                    $api->respond(["status" => "success", "message" => "User deleted from the group"]);
                } else {
                    $api->respondError(["status" => "failure", "message" => "Request failed to update"], 500);
                }
            } else {
                $pdo = null;

                $api->respondError(["status" => "failure", "message" => "User is not an existing member"], 400);
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