<?php
// Loads all the other PHP helper source files into the main file system

spl_autoload_register(function($class) {
    require_once "$class.php"; 
});
?>