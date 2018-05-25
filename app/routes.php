<?php

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use sport\Domain\User;
use sport\Domain\Sport;
use sport\Domain\Court;
use sport\Domain\CourtSport;
use sport\Domain\CatSport;

use sport\Form\Type\CommentType;
use sport\Form\Type\UserType;

use sport\Controller\UpgradeController;

// Page d'accueil
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
})->bind('home');

// inscription d'un client 
$app->match('/inscription', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {

    		// génère un salt aléatoirement
       		$salt = substr(md5(time()), 0, 23);
        	$user->setSalt($salt);
        	$plainPassword = $user->getPassword();
        	 // trouve le codeur par defaut
        	$encoder = $app['security.encoder.digest'];
        	// compute the encoded password
        	$password = $encoder->encodePassword($plainPassword, $user->getSalt());
        	$user->setPassword($password); 
        	$app['dao.user']->save($user);
        	$app['session']->getFlashBag()->add('success', 'compte crée avec succés.');   
    }

    return $app['twig']->render('User_Form.html.twig', array(
        'title' => 'Inscription',
        'userForm' => $userForm->createView()));
})->bind('inscription');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

$app->get('/CatSport', "sport\Controller\UpgradeController::CatSportAction")
    ->bind('CatSport');

$app->match('/CatSport/{id}', "sport\Controller\UpgradeController::IdCatSportAction")
    ->bind('IdCatSport');
