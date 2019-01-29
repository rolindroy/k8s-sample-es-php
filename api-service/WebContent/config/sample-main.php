<?php

date_default_timezone_set('Asia/Calcutta');

return array(
     "APPROOT"         => dirname(__FILE__) . "/../",
     "debugMode"       => 0,
     "api"             => array(
          "appid"     => "",
          "secretkey" => "",
          "isSecure"  => FALSE,
          "auth"      => [
               "admin" => "admin",
          ],
     ),
     "elastic"        => array(
          "default" => array(
               "host"    => (isset($_ENV['ELASTIC_HOST']) ? $_ENV['ELASTIC_HOST'] :  "localhost") . ":" . (isset($_ENV['ELASTIC_PORT']) ? $_ENV['ELASTIC_PORT'] :  "9200"),
               "username" => (isset($_ENV['ELASTIC_USER']) ? $_ENV['ELASTIC_USER'] :  "elastic"),
               "password" => (isset($_ENV['ELASTIC_PASS']) ? $_ENV['ELASTIC_PASS'] :  "localhost"),
          )
     )
);

?>
