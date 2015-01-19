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



$config['instagram'] = array(
    'apiKey' => 'dbfd0aa026884631ba8905dc17614f32',
    'apiSecret' => '50fd3b279a214c1e901286290c58ffb8',
    'apiCallback' => SITE_URL.'success' // must point to success.php
);

$instagram = new Instagram($config['instagram']);
?>