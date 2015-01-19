<?php
use MetzWeb\Instagram\Instagram;
$config = array();


$app->configureMode('development', function () use ($app,&$config) {
    $app->config(array(
        'log.enabled' => FALSE,
        'debug' => TRUE,
        'templates.path' => './templates_dev'
    ));

    define('SITE_URL','http://localhost/instadminer/public/');
    define('TEMPLATE_URL','http://localhost/instadminer/public/templates_dev');
    
    R::setup('mysql:host=localhost;dbname=instadminer','root','');
    R::freeze( FALSE );

});




$app->configureMode('staging', function () use ($app,&$config) {
    $app->config(array(
        'log.enabled' => TRUE,
        'debug' => TRUE,
        'templates.path' => './templates_dev'
    ));

    define('SITE_URL','http://instadminer.herokuapp.com/');
    define('TEMPLATE_URL','http://instadminer.herokuapp.com/templates_dev/');
    
    R::setup('mysql:host=us-cdbr-iron-east-01.cleardb.net;dbname=heroku_3d45180fdace15e','b059defdf3783a','2c3571e7');
    R::freeze( FALSE );

});



$config['instagram'] = array(
    'apiKey' => 'dbfd0aa026884631ba8905dc17614f32',
    'apiSecret' => '50fd3b279a214c1e901286290c58ffb8',
    'apiCallback' => SITE_URL.'success' // must point to success.php
);

$instagram = new Instagram($config['instagram']);
?>