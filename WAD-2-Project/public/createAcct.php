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

$connMgr = new ConnectionManager();
$pdo = $connMgr->getConnection("WAD_Project");

$pdo->beginTransaction();

$sql = "INSERT INTO `User` ";
$sql .= "(`username`, `password_hash`, `name`, `age`, `mobile_number`, `email`, `gender`, `interest`, `school`, `year_of_study`, `course`) ";
$sql .= "VALUES (:username, :password_hash, :name, :age, :mobile_number, :email, :gender, :interest, :school, :year_of_study, :course) ";
$stmt = $pdo->prepare($sql);
$username = $_POST["username"];
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$name = $_POST["name"];
$age = $_POST["age"];
$mobile_number = $_POST["mobile_number"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$interest = $_POST["interest"];
$school = $_POST["school"];
$year_of_study = $_POST["year_of_study"];
$course = $_POST["course"];
$stmt->bindParam(":username", $username, PDO::PARAM_STR);
$stmt->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":age", $age, PDO::PARAM_STR);
$stmt->bindParam(":mobile_number", $mobile_number, PDO::PARAM_STR);
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
$stmt->bindParam(":interest", $interest, PDO::PARAM_STR);
$stmt->bindParam(":school", $school, PDO::PARAM_STR);
$stmt->bindParam(":year_of_study", $year_of_study, PDO::PARAM_STR);
$stmt->bindParam(":course", $course, PDO::PARAM_STR);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$user_id = $pdo->lastInsertId();
$isSuccess = $pdo->commit();

$stmt->closeCursor();
$pdo = null;

if ($isSuccess) {
        $_SESSION["id"] = $user_id;

        header("Location: ./home.php");
        exit;

        // $result = ["status" => "Success", "message" => "Authorized"];

        // $api->respond($result);

        // $randomKey = "";
        // for ($i = 0; $i < 11; $i++) {
        //     $tempInt = random_int(0, 61);
        //     if ($tempInt <= 9) {
        //         $tempChar = chr(ord('0') + $tempInt);
        //     } elseif ($tempInt <= 35) {
        //         $tempChar = chr(ord('A') + $tempInt);
        //     } else {
        //         $tempChar = chr(ord('a') + $tempInt);
        //     }
        //     $randomKey .= $tempChar;
        // }

        // $keypair = sodium_crypto_sign_keypair();
        // $privateKey = base64_encode(sodium_crypto_sign_secretkey($keyPair));
        // $publicKey = base64_encode(sodium_crypto_sign_publickey($keyPair));

        // $sql = "UPDATE `User` SET `temp_key` = :randomKey, `key_time` = :keyTime, `public_key` = :publicKey WHERE `id` = :id AND `username` = :username";
        // $stmt = $pdo->prepare($sql);
        // $stmt->bindParam(":randomKey", $randomKey, PDO::PARAM_STR);
        // $stmt->bindParam(":keyTime", (time()), PDO::PARAM_STR);
        // $stmt->bindParam(":publicKey", $publicKey, PDO::PARAM_STR);
        // $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        // $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        // $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // $isStored = $stmt->execute();

        // if ($isStored) {
        //     $payload = ["id" => $id, "random_key" => $randomKey, "type" => "access", "iat" => (time() + (60 * 60 * 2))];
        //     $payload_refresh = ["id" => $id, "random_key" => $randomKey, "type" => "refresh", "iat" => (time() + (60 * 60 * 2) + (60 * 15))];

        //     $jwt = JWT::encode($payload, $privateKey, 'EdDSA');
        //     $jwt_refresh = JWT::encode($payload_refresh, $privateKey, 'EdDSA');

        //     $api->respond(["status" => "Success", "message" => "Authorized", "access_token" => $jwt, "refresh_token" => $jwt_refresh]);
        // } else {
        //     $api->respondFailedAuth();
        // }
} else {
    $_SESSION["errors"][] = "Error occured in signing up. ";
    
    header("Location: ./signup.php");
    exit;
}
?>