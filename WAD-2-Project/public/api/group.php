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

    $page = isset($data["page"]) && is_int($data["page"]) ? $data["page"] : 1;
    $limit = isset($data["limit"]) && is_int($data["limit"]) ? $data["limit"] : 10;

    $orderBy = isset($data["orderBy"]) ? $data["orderBy"] : "date";
    $order = isset($data["order"]) ? $data["order"] : "desc";
    
    $query = isset($data["query"]) ? ("%" . $data["query"] . "%") : null;

    $sql = "SELECT *, GROUP_CONCAT(`User_Group`.`user_id`) AS `members` FROM `Group`, `User_Group` WHERE `is_private` = FALSE AND `User_Group`.`group_id` = `Group`.`id` ";

    if ($query != "") {
        $sql .= "AND `Group`.`name` LIKE :query ";
    }
    switch ($orderBy) {
        case "date":
            $sql .= "ORDER BY `Group`.`date_start` " . strtoupper($order) . " ";
            $sql .= "LIMIT $limit OFFSET " . ($page - 1) * $limit . " ";
            break;
    }

    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection("WAD_Project");

    $stmt = $pdo->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ($query != "") {
        $stmt->bindParam(":query");
    }
    $stmt->execute();

    $result = [];
    while ($row = $stmt->fetch()) {
        $temp = [];
        foreach ($row as $key => $value) {
            if ($key === "members") {
                $temp[$key] = explode(",", $value);
            } else {
                $temp[$key] = $value;
            }
        }
        $result[] = $temp;
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