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

    if (isset($data["group_id"])) {
        $group_id = $data["group_id"];

        $page = isset($data["page"]) && is_int($data["page"]) ? $data["page"] : 1;
        $limit = isset($data["limit"]) && is_int($data["limit"]) ? $data["limit"] : 10;

        $orderBy = isset($data["orderBy"]) ? $data["orderBy"] : "alphabetical";
        $order = isset($data["order"]) ? $data["order"] : "asc";
        
        $query = isset($data["query"]) ? ("%" . $data["query"] . "%") : null;

        $sql = "SELECT * FROM `User_Group` WHERE `User_Group`.`group_id` = :group_id ";

        if ($query != "") {
            $sql .= "AND `name` LIKE :query ";
        }
        switch ($orderBy) {
            case "alphabetical":
                $sql .= "ORDER BY `name` " . strtoupper($order) . " ";
                $sql .= "LIMIT $limit OFFSET " . ($page - 1) * $limit . " ";
                break;
        }

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection("WAD_Project");

        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
        if ($query != "") {
            $stmt->bindParam(":query");
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
        $api->respondMissingData();
    }
} else {
    $api->respondFailedAuth();
}
?>