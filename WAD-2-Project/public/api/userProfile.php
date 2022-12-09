<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

$api = new APICreate("GET");

$api->validate();

if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $data = $api->getData();

    if (isset($data["user_id"])) {
        $userId = $data["user_id"];
        $result = [];

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project");

        $sql = "SELECT `User`.*, GROUP_CONCAT(`Skill`.`name`) AS `skills` FROM `User`, `Skill`, `User_Skill` ";
        $sql .= "WHERE `User`.`id` = :id AND `User_Skill`.`user_id` = :id AND `Skill`.`id` = `User_Skill`.`skill_id` ";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(":id", $userId, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            foreach ($row as $key => $value) {
                if ($key != "password_hash") {
                    if ($key != "skills") {
                        $result[$key] = $value;
                    } else {
                        $result[$key] = explode(",", $value);
                    }
                }
            }
            break;
        }

        $stmt->closeCursor();
        $pdo = null;

        if (!empty($result)) {
            $api->respond(["status" => "success", "data" => $result]);
        } else {
            $api->respond(["status" => "failure", "data" => []]);
        }
    } elseif (isset($data["query"])) {
        $query = $data["query"] . "%";
        $page = ( isset($data["page"]) && is_int($data["page"]) ) ? $data["page"] : 1;
        $limit = ( isset($data["limit"]) && is_int($data["limit"]) ) ? $data["limit"] : 10;
        $result = [];

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project");

        $sql = "SELECT `User`.*, GROUP_CONCAT(`Skill`.`name`) AS `skills` FROM `User`, `Skill`, `User_Skill` WHERE (`User`.`username` LIKE :query OR `User`.`name` LIKE :query) ";
        $sql .= "AND `User`.`id` <> :id ";
        $sql .= "AND `User`.`id` = `User_Skill`.`user_id` AND `Skill`.`id` = `User_Skill`.`skill_id` ";
        $sql .= "GROUP BY `User`.`id` ";
        $sql .= "LIMIT $limit OFFSET " . ( ($page - 1) * $limit ) . " ";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(":query", $query, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            unset($row['password_hash']);
            $row["skills"] = explode(",", $row["skills"]);
            $result[] = $row;
        }

        $stmt->closeCursor();
        $pdo = null;

        if (!empty($result)) {
            $api->respond(["status" => "success", "data" => $result]);
        } else {
            $api->respond(["status" => "failure", "data" => []]);
        }
    } else {
        $api->respondMissingData();
    }
} else {
    $api->respondFailedAuth();
}
?>