<?php
require_once "ConnectionManager.php";

$test = new ConnectionManager();
$test->getConnection("test");
?>