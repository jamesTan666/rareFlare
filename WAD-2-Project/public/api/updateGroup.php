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

    if (isset($data["name"]) && isset($data["is_private"]) && isset($data["group_id"])) {
        $name = $data['name'];
        $group_id = $data['group_id'];
        $is_private = $data['is_private'];

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
            $sql = "UPDATE `Group` SET `is_private` = :private_status, `name` = :name WHERE `group_id` = :group_id ";

            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
            $stmt->bindParam(":private_status", $is_private, PDO::PARAM_BOOL);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $isSuccess = $stmt->execute();

            $stmt->closeCursor();
            $pdo = null;

            if ($isSuccess) {
                $api->respond(["status" => "success", "message" => "Group details updated"]);
            } else {
                $api->respondError(["status" => "failure", "message" => "Group details failed to update"]);
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