<?php
require_once __DIR__.'/../vendor/autoload.php';

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use DerAlex\Silex\YamlConfigServiceProvider;

$app = new Silex\Application();

/**  Application */
$app->register(new MonologServiceProvider(), array(
    'monolog.logfile'    => __DIR__ . '/../log/app.log',
    'monolog.name'       => 'pamplemousse',
    'monolog.level'      => 100
));
$app->register(new SessionServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new YamlConfigServiceProvider(__DIR__.'/../config/app.yml'));

/** Controller */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->get('/', Pamplemousse\Controller::class.'::indexAction');

return $app;
