<?php
// Includes all packages from Composer;
require_once "../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../src/common.php";

// use Firebase\JWT\JWT;

session_start();

// $api = new APICreate("POST");

// $api->validate();
// $data = $api->getData();

if (!isset($_POST["email"]) || !isset($_POST["password"])) {
    $_SESSION["errors"][] = "Email and Password must be provided. ";

    header("Location: ./auth.php");
    exit;
}

$connMgr = new ConnectionManager();
$pdo = $connMgr->getConnection("WAD_Project");

$sql = "SELECT `id`, `password_hash` FROM `User` WHERE `email` = :email";
$stmt = $pdo->prepare($sql);
$email = $_POST["email"];
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while ($row = $stmt->fetch()) {
    $id = $row["id"];
    $passwordHash = $row["password_hash"];
    break;
}

$stmt->closeCursor();
$pdo = null;

if (isset($passwordHash) && isset($id)) {
    $isAuthenticated = password_verify($_POST["password"], $passwordHash);
    if ($isAuthenticated) {
        $_SESSION["id"] = $id;

        header("Location: ./home.php");
        exit;

        $result = ["status" => "Success", "message" => "Authorized"];

        $api->respond($result);

        $randomKey = "";
        for ($i = 0; $i < 11; $i++) {
            $tempInt = random_int(0, 61);
            if ($tempInt <= 9) {
                $tempChar = chr(ord('0') + $tempInt);
            } elseif ($tempInt <= 35) {
                $tempChar = chr(ord('A') + $tempInt);
            } else {
                $tempChar = chr(ord('a') + $tempInt);
            }
            $randomKey .= $tempChar;
        }

        $keypair = sodium_crypto_sign_keypair();
        $privateKey = base64_encode(sodium_crypto_sign_secretkey($keyPair));
        $publicKey = base64_encode(sodium_crypto_sign_publickey($keyPair));

        $sql = "UPDATE `User` SET `temp_key` = :randomKey, `key_time` = :keyTime, `public_key` = :publicKey WHERE `id` = :id AND `username` = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":randomKey", $randomKey, PDO::PARAM_STR);
        $stmt->bindParam(":keyTime", (time()), PDO::PARAM_STR);
        $stmt->bindParam(":publicKey", $publicKey, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $isStored = $stmt->execute();

        if ($isStored) {
            $payload = ["id" => $id, "random_key" => $randomKey, "type" => "access", "iat" => (time() + (60 * 60 * 2))];
            $payload_refresh = ["id" => $id, "random_key" => $randomKey, "type" => "refresh", "iat" => (time() + (60 * 60 * 2) + (60 * 15))];

            $jwt = JWT::encode($payload, $privateKey, 'EdDSA');
            $jwt_refresh = JWT::encode($payload_refresh, $privateKey, 'EdDSA');

            $api->respond(["status" => "Success", "message" => "Authorized", "access_token" => $jwt, "refresh_token" => $jwt_refresh]);
        } else {
            $api->respondFailedAuth();
        }
    } else {
        $_SESSION["errors"][] = "Email or Password is incorrect. ";

        header("Location: ./auth.php");
        exit;
    }
} else {
    $_SESSION["errors"][] = "Email or Password is incorrect. ";

    header("Location: ./auth.php");
    exit;
}
?>
