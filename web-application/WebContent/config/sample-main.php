<?php

date_default_timezone_set('Asia/Calcutta');

return array(
     "APPROOT"         => dirname(__FILE__) . "/../",
     "debugMode"       => 1,
     "api"             => array(
          "url"     => "",
          "isSecure"  => FALSE,
          "auth"      => [
               "admin" => "admin",
          ],
     )
);

?>
