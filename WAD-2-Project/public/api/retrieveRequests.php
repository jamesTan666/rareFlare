<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

$api = new APICreate("GET");

$api->validate();

function removeDuplicates($arr) {
    $temp = [];

    foreach ($arr as $elem) {
        if (!in_array($elem, $temp)) {
            $temp[] = $elem;
        }
    }

    return $temp;
}

if (isset($_SESSION['id'])) {
    $data = $api->getData();
    $id = $_SESSION["id"];

    $page = isset($data["page"]) && is_int($data["page"]) ? $data["page"] : 1;
    $limit = isset($data["limit"]) && is_int($data["limit"]) ? $data["limit"] : 10;

    // $orderBy = isset($data["orderBy"]) ? $data["orderBy"] : "compatibility";
    // $order = isset($data["order"]) ? $data["order"] : "desc";

    $query = isset($data["query"]) ? ($data["query"] . "%") : null;

    $sql = "SELECT from_id FROM Connection_Request, User ";
    $sql .= "WHERE User.id = Connection_Request.from_id AND to_id = :id ";
    if (isset($query)) {
        $sql .= "AND User.name LIKE :query ";
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
        $arr[] = $row["from_id"];
    }

    $stmt->closeCursor();

    $sql = "SELECT User.*, GROUP_CONCAT(s1.name) as skills, GROUP_CONCAT(s2.name) as lacks FROM User, User_Skill, User_Lacks, Skill as s1, Skill as s2 WHERE User.id IN (";
    foreach ($arr as $value) {
        $sql .= "$value, ";
    }
    $sql = rtrim($sql, ", ");
    $sql .= ") ";
    $sql .= "AND User_Skill.user_id = User.id AND User_Lacks.user_id = User.id ";
    $sql .= "AND s1.id = User_Skill.skill_id AND s2.id = User_Lacks.skill_id ";
    $sql .= "GROUP BY User.id ";

    $stmt = $pdo->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        $temp = [];
        foreach ($row as $key => $value) {
            if ($key === "skills" || $key === "lacks") {
                $temp[$key] = removeDuplicates(explode(",", $value));
            } elseif ($key !== "password_hash") {
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
