<?php

require_once("vendor/autoload.php");

require_once("system/core/SysTeacher.php");

/*
 *------------------------------------
 * Load route or default route 
 *-----------------------------------
*/
if (
   isset($_GET["controller"]) &&
   $_GET["controller"] != "" &&  
   (preg_match("/^[_a-z]+$/", $_GET["controller"]) == 1)
) {
   $route = $_GET["controller"];
} else {
   $route = "index";
}

if (
   isset($_GET["action"]) &&
   $_GET["action"] != "" &&
   (preg_match("/^[0-9a-z]+$/", $_GET["action"]) == 1)
) {
   $action = $_GET["action"];
} else {
   $action = null;
}
if (
   isset($_GET["action1"]) &&
   $_GET["action1"] != "" //&&
   //(preg_match("/^[0-9a-z]+$/", $_GET["action1"]) == 1)
) {
   $action1 = $_GET["action1"];
} else {
   $action1 = null;
}

$router = new System\Core\Router($route, $action, $action1);