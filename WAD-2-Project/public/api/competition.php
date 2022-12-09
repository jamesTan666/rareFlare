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

    $type = isset($data["type"]) ? $data["type"] : "current";
    $query = isset($data["query"]) ? ("%" . $data["query"] . "%") : "";

    $page = isset($data["page"]) && is_numeric($data["page"]) ? ( (int)$data["page"] ) : 1;
    $limit = isset($data["limit"]) && is_numeric($data["limit"]) ? ( (int)$data["limit"] ) : 10;

    $orderBy = isset($data["orderBy"]) ? $data["orderBy"] : "date";
    $order = isset($data["order"]) ? $data["order"] : "desc";

    $sql = "SELECT * FROM Competition ";
    switch ($type) {
        case "current":
            $sql .= "WHERE date_start <= CURRENT_TIMESTAMP() AND (date_end IS NULL OR date_end > CURRENT_TIMESTAMP()) ";
            break;
        case "past":
            $sql .= "WHERE (date_end IS NOT NULL AND date_end <= CURRENT_TIMESTAMP()) ";
            break;
        case "future":
            $sql .= "WHERE date_start > CURRENT_TIMESTAMP() ";
            break;
        case "all":
            $sql .= "WHERE id <> 2 AND id <> 4 ";
            break;
    }
    if ($query !== "") {
        $sql .= "AND name LIKE :query ";
    }
    switch ($orderBy) {
        case "date":
            $sql .= "ORDER BY date_start " . strtoupper($order) . " ";
            break;
    }
    $sql .= "LIMIT " . $limit . " OFFSET " . ( ($page - 1) * $limit ) . " ";

    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection("WAD_Project");

    $stmt = $pdo->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ($query !== "") {
        $stmt->bindParam(":query", $query, PDO::PARAM_STR);
    }
    $stmt->execute();

    $result = [];
    while ($row = $stmt->fetch()) {
        // $temp = [];
        // foreach ($row as $key => $value) {
        //     $temp[$key] = $value;
        // }
        // $result[] = $temp;
        // $country = new Country();
            // $country->setId($row["id"]);
            // $country->setName($row["name"]);
            // error_log($row["id"]."  ::: ".json_encode($row));
        $result[] = $row;
    }
    // error_log(json_encode($result)); //Return NOTHING
    // error_log(json_last_error()); //Returns 5
    // error_log(json_last_error_msg());


    $stmt->closeCursor();

    $sql = "SELECT COUNT(*) AS num FROM Competition ";
    switch ($type) {
        case "current":
            $sql .= "WHERE date_start <= CURRENT_TIMESTAMP() AND (date_end IS NULL OR date_end > CURRENT_TIMESTAMP()) ";
            break;
        case "past":
            $sql .= "WHERE (date_end IS NOT NULL AND date_end <= CURRENT_TIMESTAMP()) ";
            break;
        case "future":
            $sql .= "WHERE date_start > CURRENT_TIMESTAMP() ";
            break;
        case "all":
            break;
    }
    if ($query !== "") {
        $sql .= "AND name LIKE :query ";
    }
    switch ($orderBy) {
        case "date":
            $sql .= "ORDER BY date_start " . strtoupper($order) . " ";
            break;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ($query !== "") {
        $stmt->bindParam(":query", $query, PDO::PARAM_STR);
    }
    $stmt->execute();

    $length = 0;
    while ($row = $stmt->fetch()) {
        $length = $row["num"];
        break;
    }
    $length = ceil($length / $limit);

    $stmt->closeCursor();
    $pdo = null;

    if (!empty($result)) {
        $api->respond(["status" => "success", "data" => $result, "page" => $page, "total" => $length]);
    } else {
        $api->respond(["status" => "failure", "data" => []]);
    }
} else {
    $api->respondFailedAuth();
}
?>
