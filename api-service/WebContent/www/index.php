<?php
/*
# @Author: Rolind Roy <rolindroy>
# @Date:   2018-02-12T12:29:57+05:30
# @Email:  rolind.roy@tatacommunications.com
# @Filename: index.php
# @Last modified by:   rolindroy
# @Last modified time: 2018-02-15T16:41:29+05:30
*/

// echo 'OK';

define('ROOT', dirname(dirname(__FILE__)));
require_once ROOT . '/includes/autoload.php';

use Elasticsearch\ClientBuilder;

$app = new \Slim\App;

$app->get('/hello', function ($request, $response, $args) {
    $response->write(json_encode("Hello hello"));
    $response->withHeader('Content-type', 'application/json');
    return $response;
});

$app->get('/', function ($request, $response, $args) {
    $response->write(json_encode("Welcome to Kubernetes PHP Sample App"));
    $response->withHeader('Content-type', 'application/json');
    return $response;
});

$app->get('/getindex', function ($request, $response, $args) {
  $esClient = ClientBuilder::create()           // Instantiate a new ClientBuilder
              ->setHosts(array(AppConfig::config('elasticsearch.default.host')))      // Set the hosts
              ->build();              // Build the client object

  // Listing all the available indexes.
  $indices = $esClient->cat()->indices(array('index' => '*'));
  $response->write($indices);

});

$app->get('/get', function ($request, $response, $args) {
    $response->write(json_encode("Welcome to Kubernetes PHP Sample App"));
    $response->withHeader('Content-type', 'application/json');
    return $response;
});

$app->run();
