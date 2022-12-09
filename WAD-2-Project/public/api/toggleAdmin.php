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
    $id = $data['id'];

    if (isset($data["group_id"]) && isset($data["user_id"]) && isset($data["is_admin"])) {
        $group_id = $data['group_id'];
        $user_id = $data['user_id'];
        $is_admin = $data['is_admin'];

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project");
    
        $sql = "SELECT `is_admin` FROM `User_Group` WHERE `user_id` = :id AND `group_id` = :group_id ";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
        $stmt->execute();

        $isValid = false;
        while ($row = $stmt->fetch()) {
            $isValid = $row["is_admin"];
            break;
        }
        $stmt->closeCursor();

        if ($isValid) {
            $sql = "UPDATE `User_Group` SET `is_admin` = :admin_status WHERE `group_id` = :group_id AND `user_id` = :user_id ";

            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->bindParam(":admin_status", $is_admin, PDO::PARAM_BOOL);
            $isSuccess = $stmt->execute();

            $stmt->closeCursor();
            $pdo = null;

            if ($isSuccess) {
                $api->respond(["status" => "success", "message" => "Admin status updated"]);
            } else {
                $api->respondError(["status" => "failure", "message" => "Admin status failed to update"]);
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