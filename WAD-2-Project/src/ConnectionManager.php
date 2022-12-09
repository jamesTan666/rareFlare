<?php
/**
 * @package ConnectionManager
 *
 * Helps with connecting to SQL and MongoDB databases, following what was taught
 *   in WAD1.
 *
 * @method getConnection()
 *   @param string $database
 *   @param string $username
 *   @param string $password
 *   @param string $host
 *   @param int $port
 *
 * @method getMongoConnection()
 *   @param string $host
 *   @param int $port
 *   @param string $username
 *   @param string $password
 *   @param string $option_str
 *
 * --------------------------------
 *
 * // Sample Usage:
 *
 * $connMgr = new ConnectionManager();
 *
 * $pdo = $connMgr->getConnection("localhost", "main_database", "root", "root");
 *
 * $sql = "SELECT * FROM Table WHERE name = :name";
 *
 * $name = "test";
 * $stmt = $pdo->prepare($sql);
 * $stmt->bindParam(":name", $test, PDO::PARAM_STR);
 * $stmt->execute();
 *
 * $result = [];
 * $stmt->setFetchMode(PDO::FETCH_ASSOC);
 *
 * if ($row = $stmt->fetch()) {
 *     $result[] = [$row["name"], $row["detail_1"], $row["detail_2"], $row["detail_3"]];
 * }
 *
 * $stmt->closeCursor();
 * $pdo = null;
 *
 * ---------------------------------
 *
 */

require_once __DIR__ . "/../vendor/autoload.php";

class ConnectionManager {
    public function getConnection($database, $username = "root", $password = "root", $host = "localhost", $port = 3306) {
        $ini = parse_ini_file(__DIR__ . "/../config.ini");
        $database = isset($ini["SQL_DB_NAME"]) ? $ini["SQL_DB_NAME"] : $database;
        $username = isset($ini["SQL_USERNAME"]) ? $ini["SQL_USERNAME"] : $username;
        $password = isset($ini["SQL_PASSWORD"]) ? $ini["SQL_PASSWORD"] : $password;
        $host = isset($ini["SQL_HOST"]) ? $ini["SQL_HOST"] : $host;
        $port = isset($ini["SQL_PORT"]) ? ((int) $ini["SQL_PORT"]) : $port;

        $url = "mysql:host=$host;dbname=$database";

        return new PDO($url, $username, $password);
    }

    public function getMongoConnection($host = "localhost", $port = 27017, $username = null, $password = null, $option_str = null) {
        $ini = parse_ini_file(__DIR__ . "/../config.ini");
        $username = isset($ini["MONGODB_USERNAME"]) ? $ini["MONGODB_USERNAME"] : $username;
        $password = isset($ini["MONGODB_PASSWORD"]) ? $ini["MONGODB_PASSWORD"] : $password;
        $host = isset($ini["MONGODB_HOST"]) ? $ini["MONGODB_HOST"] : $host;
        $port = isset($ini["MONGODB_PORT"]) ? ((int) $ini["MONGODB_PORT"]) : $port;

        if (((string) $ini["MONGODB_ATLAS"]) == "1") {
            $url = "mongodb+srv://";
            $atlas_str = isset($ini["MONGODB_ATLAS_STR"]) ? $ini["MONGODB_ATLAS_STR"] : "";
            $url .= $atlas_str;
        } else {
            $url = "mongodb://";

            if ($username == "" || $password == "") {
                $url .= "$host:$port";
            } else {
                $url .= "$username:$password@$host:$port";
            }
            if ($option_str != "") {
                $url .= "/$option_str";
            }
        }

        return new MongoDB\Client($url);
    }
}
?>
