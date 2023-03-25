<?php

define("ERROR_LOG", dirname(__FILE__). "\\error.log");

session_start();
require "controller/navigation.php";
require "controller/snows.php";
require "controller/users.php";

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  switch ($action) {
      case 'home' :
          home();
          break;
      case 'snows' :
          snows();
          break;
      case 'snow' :
          snow($_GET['code']);
          break;
      case 'login' :
          login($_POST);
          break;
      case 'logout' :
          logout();
          break;
      case 'register' :
          register($_POST);
          break;
      default :
          lost();
      }
    }
else {
    home();
}