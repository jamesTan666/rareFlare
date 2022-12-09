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
    $data = $api->getData();
    $id = $_SESSION["id"];

    $query = isset($data["query"]) ? ("%" . $data["query"] . "%") : "";
    $private = isset($data["private"]) ? $data["private"] : "";

    $page = isset($data["page"]) && is_int($data["page"]) ? $data["page"] : 1;
    $limit = isset($data["limit"]) && is_int($data["limit"]) ? $data["limit"] : 10;

    $orderBy = isset($data["orderBy"]) ? $data["orderBy"] : "date";
    $order = isset($data["order"]) ? $data["order"] : "desc";

    $sql = "SELECT Group.* FROM `Group`, `User_Group` WHERE Group.id = User_Group.group_id AND User_Group.user_id = :id ";
    if ($query !== "") {
        $sql .= "AND Group.name LIKE :query ";
    }
    if ($private !== "") {
        $sql .= "AND Group.is_private = :is_private ";
    }
    switch ($orderBy) {
        case "date":
            $sql .= "ORDER BY `date_start` " . strtoupper($order) . " ";
            break;
    }
    $sql .= "LIMIT " . $limit . " OFFSET " . ( ($page - 1) * $limit ) . " ";

    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection("WAD_Project");

    $stmt = $pdo->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    if ($query !== "") {
        $stmt->bindParam(":query", $query, PDO::PARAM_STR);
    }
    if ($private !== "") {
        $stmt->bindParam(":is_private", $private, PDO::PARAM_BOOL);
    }
    $stmt->execute();

    $result = [];
    while ($row = $stmt->fetch()) {
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
    $api->respondFailedAuth();
}
?>