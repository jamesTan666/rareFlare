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
    $user_id = $data["user_id"];
    $id = $_SESSION["id"];

    $sql = "SELECT * FROM Connection ";
    $sql .= "WHERE (user_id1 = :user_id AND user_id2 = :id) OR (user_id2 = :user_id AND user_id1 = :id) ";

    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection("WAD_Project");

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $result = [];
    while ($row = $stmt->fetch()) {
        $result[] = $row;
        break;
    }

    if (!empty($result)) {
        $stmt->closeCursor();
        $pdo = null;

        $api->respond(["status" => "Disconnect"]);
    } else {
        $stmt->closeCursor();

        $sql = "SELECT * FROM Connection_Request ";
        $sql .= "WHERE from_id = :user_id AND to_id = :id ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            $result[] = $row;
            break;
        }

        if (!empty($result)) {
            $stmt->closeCursor();
            $pdo = null;

            $api->respond(["status" => "Approve"]);
        } else {
            $stmt->closeCursor();

            $sql = "SELECT * FROM Connection_Request ";
            $sql .= "WHERE to_id = :user_id AND from_id = :id ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $result[] = $row;
                break;
            }

            if (!empty($result)) {
                $stmt->closeCursor();
                $pdo = null;

                $api->respond(["status" => "Pending"]);
            } else {
                $stmt->closeCursor();
                $pdo = null;

                $api->respond(["status" => "Connect"]);
            }
        }
    }
} else {
    $api->respondFailedAuth();
}
