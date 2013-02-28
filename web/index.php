<?php

$app = require_once __DIR__ .'/../app/app.php';

$app->get('/', function(Silex\Application $app) {
  return $app['twig']->render('index.twig');
});

$app->run();
