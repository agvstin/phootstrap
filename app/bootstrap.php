<?php
require_once __DIR__ .'/autoload.php';

use Silex\Application as App;
use Silex\Provider;

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

// register providers
$app->register(new Provider\SessionServiceProvider());
$app->register(new Provider\UrlGeneratorServiceProvider());
$app->register(new Provider\TwigServiceProvider, array(
  'twig.path' => __DIR__ .'/../web/views'
));
$app->register(new Provider\TranslationServiceProvider(), array(
  'locale_fallback' => 'en',
));
$app['translator.domains'] = $app->share(function($app) {
  $locales = glob(__DIR__ .'/../data/locales/*.ini');
  $domains = array();
  foreach ($locales as $locale) {
    list($lang, ) = explode('.', basename($locale));
    $domains['messages'][$lang] = parse_ini_file($locale);
  }

  return $domains;
});

$app->register(new Provider\MonologServiceProvider(), array(
    'monolog.logfile' => $app['config.value']('log.file', __DIR__ .'/../data/logs/' .$app['env'] .'.log'),
    'monolog.level' => $app['config.value']('log.level', 'info'),
));

return $app;
