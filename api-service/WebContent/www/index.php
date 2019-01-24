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
    $response->write(json_encode("Hello"));
    $response->withHeader('Content-type', 'application/json');
    return $response;
});

$app->get('/', function ($request, $response, $args) {
    $apiCalls = array(
      'GET: /',
      'GET: /hello',
      'GET: /getindex',
      'GET: /getdatabyindex/{index}',
      'GET: /getdatabyid/{index}/{id}',
      'POST: /setdata'
    );
    $response->write(json_encode("Welcome to Kubernetes PHP Sample App"));
    $response->write("<br>");
    foreach ($apiCalls as $key) {
      $response->write("\"". $key ."\"<br>");
    }
    $response->withHeader('Content-type', 'application/json');
    return $response;
});

$app->get('/getindex', function ($request, $response, $args) {
  $esClient = ClientBuilder::create()
              ->setHosts(array(AppConfig::config('elastic.default.host')))
              ->build();

  $indices = $esClient->cat()->indices(array('index' => '*'));

  $response->write(json_encode($indices));

});

$app->get('/getdatabyindex/{index}', function ($request, $response, $args) {
    if (isset($args['index'])){
      $esClient = ClientBuilder::create()
                  ->setHosts(array(AppConfig::config('elastic.default.host')))
                  ->build();
      $searchPt = $args['index'];
      $searchParams['index'] = $searchPt;
      $searchParams['body']['query']['query_string']['query'] = '*';
      $results = $esClient->search($searchParams);
      $data = $results['hits'];
      $response->write(json_encode($data));
    }
    else {
      $response->write(json_encode("error"));
    }
});

$app->get('/getdatabyid/{index}/{id}', function ($request, $response, $args) {
    if (isset($args['index']) && isset($args['id'])){
      $esClient = ClientBuilder::create()
                  ->setHosts(array(AppConfig::config('elastic.default.host')))
                  ->build();
      $params['index'] = $args["index"];
      $params['body']['query']['match']['_id'] = $args['id'];
      $results = $esClient->search($params);
      $data = $results['hits'];
      $response->write(json_encode($data));
    }
    else {
      $response->write(json_encode("Error"));
    }
});

$app->post('/setdata', function ($request, $response, $args) {
  $allPostPutVars = $request->getParsedBody();
  $esClient = ClientBuilder::create()
              ->setHosts(array(AppConfig::config('elastic.default.host')))
              ->build();
  $responseData = $esClient->index($allPostPutVars);
  $response->write(json_encode($responseData));
});

$app->run();
