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

            $isValidEntry = true;
            while ($row = $stmt->fetch()) {
                $isValidEntry = false;
                break;
            }

            $stmt->closeCursor();

            if ($isValidEntry) {
                $admin_status = isset($data["is_admin"]) ? $data["is_admin"] : false;
    
                $sql = "INSERT INTO `User_Group` (`user_id`, `group_id`, `is_admin`) VALUES (:user_id, :group_id, :is_admin) ";
    
                $stmt = $pdo->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
                $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
                $stmt->bindParam(":is_admin", $admin_status, PDO::PARAM_BOOL);
                $isSuccess = $stmt->execute(); 

                $stmt->closeCursor();
                $pdo = null;

                if ($isSuccess) {
                    $api->respond(["status" => "success", "message" => "User added to the group"]);
                } else {
                    $api->respondError(["status" => "failure", "message" => "Request failed to update"], 500);
                }
            } else {
                $pdo = null;

                $api->respondError(["status" => "failure", "message" => "User is already a member"], 400);
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