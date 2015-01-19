<?php
require '../vendor/autoload.php' ;
session_start();
date_default_timezone_set('America/Santiago');

switch($_SERVER['SERVER_NAME']){
    case "localhost":
        $env = "development";
    break;

    case "http://instadminer.herokuapp.com":
        $env = "staging";
    break;

    default:
        $env = "production";
    break;
}
//$app->response->headers['Access-Control-Allow-Origin']="*";

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array(
    'mode'=> $env
));

require 'functions.php';

$JSON = function() use ($app){
    return function() use ($app){
        $app->response->headers['Content-Type']="text/json";
    };
};



$app->get('/',function() use ($app){
        die("<pre>".print_r($app,1)."</pre>");
    $app->render('index.php',array("url"=>SITE_URL));
});






$app->error(function (\Exception $e) use ($app) {
    fail($e->getMessage(),0,500);
});

function fail($message = '', $status = 0, $http_status = 400){
    global $app;
    $response = new StdClass();
    $response->message = $message;
    $response->status = $status;
    $app->halt($http_status, json_encode($response));
};

$app->run();
