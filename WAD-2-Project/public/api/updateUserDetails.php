<?php
// Includes all packages from Composer;
require_once "../../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../../src/common.php";

// use Firebase\JWT\JWT;

session_start();

$api = new APICreate("POST");

$api->validate();

if (isset($_SESSION['id'])) {
    $data = $api->getData();
    if (empty($data)) {
        $api->respondMissingData();
    }

    $id = $_SESSION['id'];

    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection("WAD_Project");

    $sql = "UPDATE `User` SET ";

    foreach ($data as $key => $value) {
        $sql .= $key . " = :" . $key . ", ";
    }

    if (isset($_FILES["profile_image"])) {
        $sql .= "image_name = :image_name, ";
    }

    $sql = rtrim($sql, ", ");

    $stmt = $pdo->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach ($data as $key => $value) {
        switch ($key) {
            case "password_hash": 
                $temp = password_hash($value, PASSWORD_DEFAULT);
                $stmt->bindParam(":$key", $temp, PDO::PARAM_STR);
                break;
            case "mobile_number":
                $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
                break;
            default:
                if (is_numeric($value)) {
                    $stmt->bindParam(":$key", $value, PDO::PARAM_INT);
                } else {
                    $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
                }
                break;
        }
    }

    if (isset($_FILES["profile_image"])) {
        $target_dir = "../images/";
        $target_file = $target_dir . date("YmdHis") . $id;
        $uploadOk = true;
        $isImage = true;
        $isUnique = true;
        $isFormat = true;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check === false) {
            $uploadOk = false;
            $isImage = "File is not an image";
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = false;
            $isUnique = "Error with file saving";
        }

        // Check file size
        // if ($_FILES["fileToUpload"]["size"] > 500000) {
        //     echo "Sorry, your file is too large.";
        //     $uploadOk = false;
        // }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $uploadOk = false;
            $isFormat = "Only jpg/jpeg and png allowed";
        }

        if (!$uploadOk) {
            $result = ["status" => "failure", "message" => ""];

            if ($isImage !== true) {
                $result["message"] .= $isImage . ", ";
            }
            if ($isUnique !== true) {
                $result["message"] .= $isUnique . ", ";
            }
            if ($isFormat !== true) {
                $result["message"] .= $isFormat . ", ";
            }

            $stmt->closeCursor();
            $pdo = null;

            $api->respondError($result, 400);
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $stmt->bindParam(":image_name", basename($target_file), PDO::PARAM_STR);
            } else {
                $stmt->closeCursor();
                $pdo = null;
                
                $api->respondError(["status" => "Failure", "message" => "Failed to save image"], 500);
            }
        }
    }

    $result = $stmt->execute();

    $stmt->closeCursor();
    $pdo = null;

    if ($result) {
        $api->respond(["status" => "success", "message" => "User updated"]);
    } else {
        $api->respondError(["status" => "failure", "message" => "Failed to update"]);
    }
} else {
    $api->respondFailedAuth();
}
?>