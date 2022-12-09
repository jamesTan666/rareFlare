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
    if (isset($data["user_id"])) {
        $id = $data["user_id"];
    } else {
        $id = $_SESSION["id"];
    }

    $page = isset($data["page"]) && is_numeric($data["page"]) ? ( (int)$data["page"] ) : 1;
    $limit = isset($data["limit"]) && is_numeric($data["limit"]) ? ( (int)$data["limit"] ) : 10;

    $orderBy = isset($data["orderBy"]) ? $data["orderBy"] : "date";
    $order = isset($data["order"]) ? $data["order"] : "desc";

    $query = isset($data["query"]) ? ("%" . $data["query"] . "%") : null;

    $sql = "SELECT Final_Users.*, GROUP_CONCAT(Skill.name) AS skills ";
    $sql .= "FROM Skill, User_Skill, ";
    $sql .= "(SELECT * FROM User, ";
    $sql .= "    ((SELECT user_id2 AS temp_id, date FROM Connection ";
    $sql .= "            WHERE user_id1 = :id AND user_id2 <> :id ";
    $sql .= "        ) UNION (SELECT user_id1 AS temp_id, date FROM Connection ";
    $sql .= "            WHERE user_id2 = :id AND user_id1 <> :id ";
    $sql .= "        )) AS Temp_Users ";
    $sql .= "    WHERE Temp_Users.temp_id = User.id ";
    $sql .= ") AS Final_Users ";
    $sql .= "WHERE User_Skill.skill_id = Skill.id AND User_Skill.user_id = Final_Users.id ";
    if (isset($query)) {
        $sql .= "AND Final_Users.name LIKE :query ";
    }
    $sql .= "GROUP BY Final_Users.id, Final_Users.date ";
    switch ($orderBy) {
        case "date":
            $sql .= "ORDER BY date " . strtoupper($order) . " ";
            $sql .= "LIMIT $limit OFFSET " . ($page - 1) * $limit . " ";
            break;
    }

    // $sql = "SELECT * FROM Connection, User AS u1, User AS u2 ";
    // $sql .= "WHERE u1.id = user_id1 AND u2.id = user_id2 AND (user_id1 = :id OR user_id2 = :id) ";
    // if (isset($query)) {
    //     $sql .= "AND (u1.name LIKE :query OR u2.name LIKE :query) ";
    // }
    // switch ($orderBy) {
    //     case "date":
    //         $sql .= "ORDER BY date_start " . strtoupper($order) . " ";
    //         $sql .= "LIMIT $limit OFFSET " . ($page - 1) * $limit . " ";
    //         break;
    // }

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
    while ($row = $stmt->fetch()) {
        $row["skills"] = explode(",", $row["skills"]);
        unset($row["password_hash"]);
        unset($row["temp_id"]);
        $result[] = $row;

        // $temp = [];
        // if ($row["u1.id"] == $id) {
        //     foreach ($row as $key => $value) {
        //         if (strstr($key, "u2.") !== false) {
        //             $temp_key = strstr($key, "u2.");
        //             $temp[$temp_key] = $value;
        //         } elseif ($key === "date") {
        //             $temp[$key] = $value;
        //         }
        //     }
        // } else {
        //     foreach ($row as $key => $value) {
        //         if (strstr($key, "u1.") !== false) {
        //             $temp_key = strstr($key, "u1.");
        //             $temp[$temp_key] = $value;
        //         } elseif ($key === "date") {
        //             $temp[$key] = $value;
        //         }
        //     }
        // }
        // $result[] = $temp;
    }

    $stmt->closeCursor();
$sql = "SELECT COUNT(num_table.id) AS num FROM ";
    $sql .= "(SELECT Final_Users.*, GROUP_CONCAT(Skill.name) AS skills ";
    $sql .= "FROM Skill, User_Skill, ";
    $sql .= "(SELECT * FROM User, ";
    $sql .= "    ((SELECT user_id1 AS temp_id, date FROM Connection ";
    $sql .= "            WHERE user_id1 = :id AND user_id2 <> :id ";
    $sql .= "        ) UNION (SELECT user_id2 AS temp_id, date FROM Connection ";
    $sql .= "            WHERE user_id2 = :id AND user_id1 <> :id ";
    $sql .= "        )) AS Temp_Users ";
    $sql .= "    WHERE Temp_Users.temp_id = User.id ";
    $sql .= ") AS Final_Users ";
    $sql .= "WHERE User_Skill.skill_id = Skill.id AND User_Skill.user_id = Final_Users.id ";
    if (isset($query)) {
        $sql .= "AND Final_Users.name LIKE :query ";
    }
    $sql .= "GROUP BY Final_Users.id, Final_Users.date ";
    switch ($orderBy) {
        case "date":
            $sql .= "ORDER BY date " . strtoupper($order) . " ";
            break;
    }
    $sql .= ") AS num_table ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    if (isset($query)) {
        $stmt->bindParam(":query", $query, PDO::PARAM_STR);
    }

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $length = 0;
    while ($row = $stmt->fetch()) {
        $length = $row["num"];
        break;
    }
    $length = ceil($length / $limit);

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
            break;
    }

    if (!empty($result)) {
        $api->respond(["status" => "success", "data" => $result, "page" => $page, "total" => $length]);
    } else {
        $api->respond(["status" => "failure", "data" => []]);
    }
} else {
    $api->respondFailedAuth();
}
?>
