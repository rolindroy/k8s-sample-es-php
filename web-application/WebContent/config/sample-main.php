<?php

date_default_timezone_set('Asia/Calcutta');

return array(
     "APPROOT"         => dirname(__FILE__) . "/../",
     "debugMode"       => 1,
     "api"             => array(
          "url"     => (isset($_ENV['API_HOST']) ? $_ENV['API_HOST'] : "localhost") . ":" . (isset($_ENV['API_PORT']) ? $_ENV['API_PORT'] : "80"),
          "isSecure"  => FALSE,
          "auth"      => [
               "admin" => "admin",
          ],
     )
);

?>
