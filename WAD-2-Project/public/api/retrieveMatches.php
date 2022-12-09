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
    $data = $api->getData();
    $id = $_SESSION["id"];

    $page = isset($data["page"]) && is_int($data["page"]) ? $data["page"] : 1;
    $limit = isset($data["limit"]) && is_int($data["limit"]) ? $data["limit"] : 10;

    $orderBy = isset($data["orderBy"]) ? $data["orderBy"] : "compatibility";
    $order = isset($data["order"]) ? $data["order"] : "desc";

    $query = isset($data["query"]) ? ($data["query"] . "%") : null;

    $sql = "SELECT `user_id1`, `user_id2`, `compatibility` FROM `Match`, `User` AS u1, `User` AS u2 ";
    $sql .= "WHERE u1.id = user_id1 AND u2.id = user_id2 AND (user_id1 = :id OR user_id2 = :id) ";
    $sql .= "AND status = 'Pending' ";
    if (isset($query)) {
        $sql .= "AND (u1.name LIKE :query OR u2.name LIKE :query) ";
    }
    switch ($orderBy) {
        case "compatibility":
            $sql .= "ORDER BY `compatibility` " . strtoupper($order) . " ";
            $sql .= "LIMIT $limit OFFSET " . ($page - 1) * $limit . " ";
            break;
    }

    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection("WAD_Project");

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT); 
    if (isset($query)) {
        $stmt->bindParam(":query", $query, PDO::PARAM_STR);
    }

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $result = [];
    $arr = [];
    while ($row = $stmt->fetch()) {
        $temp = [];
        foreach ($row as $key => $value) {
            if (strstr($key, "user_id") !== false) {
                if ($value !== $id) {
                    $temp["id"] = $value;
                    $arr[] = $value;
                }
            } else {
                $temp[$key] = $value;
            }
        }
        $result[] = $temp;
    }

    $stmt->closeCursor();

    $sql = "SELECT `User`.*, GROUP_CONCAT(s1.name) as skills, GROUP_CONCAT(s2.name) as lacks FROM `User`, `User_Skill`, `User_Lacks`, `Skill` as s1, `Skill` as s2 WHERE `User`.`id` IN (";
    foreach ($arr as $value) {
        $sql .= "$value, ";
    }
    $sql = rtrim($sql, ", ");
    $sql .= ") ";
    $sql .= "AND `User_Skill`.`user_id` = `User`.`id` AND `User_Lacks`.`user_id` = `User`.`id` ";
    $sql .= "AND `s1`.`id` = `User_Skill`.`skill_id` AND `s2`.`id` = `User_Lacks`.`skill_id` ";
    $sql .= "GROUP BY `User`.`id` DESC ";

    $stmt = $pdo->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    // while ($row = $stmt->fetch()) {
    //     foreach ($result as $elem) {
    //         if ($elem["id"] === $row["id"]) {
    //             foreach ($row as $key => $value) {
    //                 if ($key === "skills" || $key === "lacks") {
    //                     $elem[$key] = explode(",", $value);
    //                 } elseif ($key !== "id") {
    //                     $elem[$key] = $value;
    //                 }
    //             }
    //         }
    //     }
    // }

    $result = [];
    while ($row = $stmt->fetch()) {
        $temp = [];
        foreach ($row as $key => $value) {
            if ($key === "skills" || $key === "lacks") {
                $temp[$key] = explode(",", $value);
            } elseif ($key !== "password_hash") {
                $temp[$key] = $value;
            }
        }
        $result[] = $temp;
    }

    $stmt->closeCursor();
    $pdo = null;

    switch ($orderBy) {
        case "name": 
            if (strtoupper($order) === "DESC") {
                usort($result, function($a, $b) {
                    return strcmp($a["name"], $b["name"]) * -1;
                });
            } else {
                usort($result, function($a, $b) {
                    return strcmp($a["name"], $b["name"]);
                });
            }
            $result = array_slice($result, ($page - 1) * $limit, $limit);
    }

    if (!empty($result)) {
        $api->respond(["status" => "success", "data" => $result]);
    } else {
        $api->respond(["status" => "failure", "data" => []]);
    }
} else {
    $api->respondFailedAuth();
}
?>