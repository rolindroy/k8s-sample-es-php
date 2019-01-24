<?php
require_once  ROOT . "/vendor/autoload.php";
require_once  ROOT . "/AppSrc/AppConfig/AppConfig.php";

$configpath = ROOT . "/config/main.php";

AppConfig::load($configpath);

ini_set("display_errors", AppConfig::config("debugMode"));
