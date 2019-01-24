<?php
/*
# @Author: Rolind Roy <rolindroy>
# @Date:   2018-02-12T12:29:57+05:30
# @Email:  rolind.roy@tatacommunications.com
# @Filename: setData.php
# @Last modified by:   rolindroy
# @Last modified time: 2018-02-15T16:41:29+05:30
*/

define('ROOT', dirname(dirname(__FILE__)));
require_once ROOT . '/includes/autoload.php';

$client = new \GuzzleHttp\Client();
$httpProtocol = "http://";

if (AppConfig::config('api.isSecure') == TRUE)
{
  $httpProtocol = "https://";
}

for ($i =0; $i<10; $i++)
{
  $indexesArray = array('centos-6','centos-7','redhat-6','redhat-7','ubuntu-14','ubuntu-16');

  $randIP = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);

  $random_keys=array_rand($indexesArray);
  $_id = $indexesArray[$random_keys] . "_" . $randIP;
  $_index = $indexesArray[$random_keys];
  $_type = "unix";
  $osInfo = explode("-",$indexesArray[$random_keys]);
  $body = array(
    'ip_address' => $randIP,
    'hostname' => $_id,
    'os type' => $osInfo[0],
    'os version' => $osInfo[1]
  );

  $resp = array(
    'index' => $_index,
    'id' => $_id,
    'type' => $_type,
    'body' => $body,
  );
   // print_r(json_encode($resp));
  $res = $client->request('POST', $httpProtocol . AppConfig::config('api.url') . "/setdata", [ 'form_params' => $resp ]);
    print_r($res);
}



?>
