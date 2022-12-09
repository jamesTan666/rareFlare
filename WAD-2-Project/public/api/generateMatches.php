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
    $id = $_SESSION["id"];

    $sql = "(SELECT skill_id FROM User_Lacks WHERE user_id = :id) ";
    $sql .= "UNION (SELECT skill_id FROM User_Skill WHERE user_id = :id) ";

    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection("WAD_Project");

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $skills = [];
    while ($row = $stmt->fetch()) {
        $skills[] = $row["skill_id"];
    }

    // var_dump($skills);
    // exit;

    $stmt->closeCursor();

    $sql = "SELECT User.id, interest, SUM(proficiency) AS rating FROM User, User_Skill ";
    $sql .= "WHERE User.id = User_Skill.user_id AND skill_id IN (";
    foreach ($skills as $value) {
        $sql .= "$value, ";
    }
    $sql = rtrim($sql, ", ");
    $sql .= ") AND User.id <> :id ";
    $sql .= "AND User.id NOT IN ";
    $sql .= "(SELECT user_id1 AS conn_id FROM Connection WHERE user_id2 = :id AND user_id1 <> :id) ";
    $sql .= "AND User.id NOT IN ";
    $sql .= "(SELECT user_id2 AS conn_id FROM Connection WHERE user_id1 = :id AND user_id2 <> :id) ";
    $sql .= "GROUP BY User.id, interest ORDER BY rating DESC ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $result = [];
    while ($row = $stmt->fetch()) {
        $result[] = $row;
    }

    $stmt->closeCursor();

    if (empty($result)) {
        $sql = "SELECT User.id, interest, SUM(proficiency) AS rating FROM User, User_Skill ";
        $sql .= "WHERE User.id = User_Skill.user_id AND User.id <> :id ";
        $sql .= "AND User.id NOT IN ";
        $sql .= "(SELECT user_id1 AS conn_id FROM Connection WHERE user_id2 = :id AND user_id1 <> :id) ";
        $sql .= "AND User.id NOT IN ";
        $sql .= "(SELECT user_id2 AS conn_id FROM Connection WHERE user_id1 = :id AND user_id2 <> :id) ";
        $sql .= "GROUP BY User.id, interest ORDER BY RAND() LIMIT 10 ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }

        $stmt->closeCursor();
    }

    // var_dump($result);

    // usort($result, function($a, $b) {
    //     return strcmp($a["name"], $b["name"]);
    // });

    $sql = "INSERT INTO Match (user_id1, user_id2, compatibility, status) ";
    $sql .= "VALUES ";
    $i = 0;
    foreach ($result as $elem) {
        $sql .= "(:id, " . $elem["id"] . ", " . $elem["rating"] . ", 'pending'), ";
        $i++;
    }
    $sql = rtrim($sql, ", ");
    $sql .= " ";

    // echo $sql;

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    // $i = 0;
    // foreach ($result as $elem) {
    //     $temp1 = ":user_id" . $i;
    //     $val1 = $elem["id"];
    //     $stmt->bindParam($temp1, $val1, PDO::PARAM_INT);

    //     $temp2 = ":rating" . $i;
    //     $val2 = $elem["rating"];
    //     $stmt->bindParam($temp2, $val2, PDO::PARAM_INT);

    //     $i++;
    // }
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $isSuccess = $stmt->execute();

    if ($isSuccess) {
        $api->respond(["status" => "success", "message" => "Matches generated."]);
    } else {
        $api->respond(["status" => "failed", "message" => "Matches failed to generate."]);
    }
} else {
    $api->respondFailedAuth();
}
