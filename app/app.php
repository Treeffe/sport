<?php

use Symfony\Component\Debug\ErrorHandler;
ErrorHandler::register();
use Symfony\Component\Debug\ExceptionHandler;
ExceptionHandler::register();


// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
}));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new sport\DAO\UserDAO($app['db']);
            }),
        ),
    ),
    'security.role_hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
    ),
    'security.access_rules' => array(
        array('^/admin', 'ROLE_ADMIN'),
    ),
));

// Register services.

$app['dao.user'] = $app->share(function ($app) {
    return new sport\DAO\UserDAO($app['db']);
});

$app['dao.catSport'] = $app->share(function ($app) {
    return new sport\DAO\CatSportDAO($app['db']);
});

$app['dao.sport'] = $app->share(function ($app) {
    return new sport\DAO\SportDAO($app['db']);
});

$app['dao.court'] = $app->share(function ($app) {
    //Initialisation
    $courtDAO = new \sport\DAO\CourtDAO($app['db']);
    $courtDAO->setUserDAO($app['dao.user']);
    $courtDAO->setCatSportDAO($app['dao.catSport']);

    return $courtDAO;
});

$app['dao.courtSport'] = $app->share(function ($app) {
    // Initialisation
    $courtSport = new \sport\DAO\CourtSportDAO($app['db']);
    $courtSport->setCourtDAO($app['dao.court']);
    $courtSport->setSportDAO($app['dao.sport']);

    return $courtSport;
});

