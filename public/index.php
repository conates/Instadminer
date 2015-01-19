<?php
require '../vendor/autoload.php' ;
session_start();
date_default_timezone_set('America/Santiago');

switch($_SERVER['SERVER_NAME']){
    case "localhost":
        $env = "development";
    break;

    case "http://havana-mehacebailar.herokuapp.com":
        $env = "staging";
    break;

    default:
        $env = "production";
    break;
}

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array(
    'mode'=> $env
));



$JSON = function() use ($app){
    return function() use ($app){
        $app->response->headers['Content-Type']="text/json";
    };
};



$app->get('/',function() use ($app){
    $app->render('index.php');
});