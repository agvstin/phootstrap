<?php
require_once __DIR__ .'/autoload.php';

use Silex\Application as App;
use Silex\Provider\TwigServiceProvider;

defined('ROOT_PATH') or define('ROOT_PATH', __DIR__ .'/..');

$app = new App;

$app['env'] = getenv('APPLICATION_ENV')
  ? getenv('APPLICATION_ENV')
  : 'production';

if ('development' === $app['env']) {
  $app['debug'] = true;
}

$app['config'] = $app->share(function($app) {
  return parse_ini_file(__DIR__ .'/../config/parameters.ini');
});

$app['config.value'] = $app->protect(function($key, $default = null) use ($app) {
  $config = $app['config'];

  return isset($config[$key])
    ? $config[$key]
    : $default;
});

$app['db'] = $app->share(function($app) {
  $fvalue = $app['config.value'];

  Redbean_Facade::setup(
    $fvalue('db.dsn'),
    $fvalue('db.username'),
    $fvalue('db.password')
  );

  return new Redbean_Facade;
});

$app->register(new TwigServiceProvider, array(
  'twig.path' => __DIR__ .'/../web/views'
));

return $app;
