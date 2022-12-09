<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

$api = new APICreate("GET");
$api->validate();

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    $api->respondFailedAuth();
}

$connMgr = new ConnectionManager();
$pdo = $connMgr->getConnection("WAD_Project");

$sql = "SELECT * FROM `User` WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$result = [];
while ($row = $stmt->fetch()) {
    foreach ($row as $key => $value) {
        if ($key !== "password_hash") {
            $result[$key] = $value;
        }
    }
    break;
}

$stmt->closeCursor();

$sql = "SELECT `Skill`.`name` FROM `User_Skill`, `Skill` ";
$sql .= "WHERE `User_Skill`.`skill_id` = `Skill`.`id` AND `User_Skill`.`user_id` = :id ";
$sql .= "ORDER BY `proficiency` DESC ";
$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$result["skills"] = [];
while ($row = $stmt->fetch()) {
    $result["skills"][] = $row["name"];
}

$stmt->closeCursor();

$sql = "SELECT COUNT(`user_id1`) AS `numConnect` FROM `Connection` ";
$sql .= "WHERE `user_id1` = :id OR `user_id2` = :id ";
$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$result["numConnect"] = null;
while ($row = $stmt->fetch()) {
    $result["numConnect"] = $row["numConnect"];
    break;
}

$stmt->closeCursor();

$sql = "SELECT COUNT(`group_id`) AS `numGroup` FROM `User_Group` ";
$sql .= "WHERE `user_id` = :id ";
$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$result["numGroup"] = null;
while ($row = $stmt->fetch()) {
    $result["numGroup"] = $row["numGroup"];
    break;
}

$stmt->closeCursor();

$pdo = null;

if (!empty($result)) {
    $api->respond(["status" => "Success", "data" => $result]);
} else {
    $api->respond(["status" => "Failure", "data" => []]);
}
?>