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
use sport\Controller\CourtSportControllerController;

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

//Routes pour CatSports
$app->get('/CatSport', "sport\Controller\UpgradeController::CatSportAction")
    ->bind('CatSport');

//Routes Test
$app->match('/CatSport/{id}', "sport\Controller\UpgradeController::IdCatSportAction")
    ->bind('IdCatSport');

//Routes pour les Courts avec son sport
$app->get('/Courts', "sport\Controller\CourtSportController::CourtsAction")
    ->bind('courts');

//Route un Courts avec son sport
$app->get('/Courts/{id}', "sport\Controller\CourtController::CourtAction")
    ->value('id',false)
    ->bind('court');


//BACK
// Admin home page
$app->get('/admin', function() use ($app) {
    $users = $app['dao.user']->findAllUsers();
    $courts = $app['dao.court']->findAllCourt();
    $sports = $app['dao.sport']->findAllSport();
    return $app['twig']->render('admin.html.twig', array(
        'users' => $users, 'courts' => $courts, 'sports' =>$sports));
})->bind('admin');

$app->match('/add_courtSport', "sport\Controller\CourtSportController::AddCourtSportAction")
    ->bind('add_courtSport');

$app->match('/add_courtSportCompletely', "sport\Controller\CourtSportController::CourtSportSaveAction")
    ->bind('CourtSportSave');

$app->match('/admin/sport/{id}/delete', "sport\Controller\adminController::RemoveSportAction")
    ->bind('removeSport');

$app->match('/admin/court/{id}/delete', "sport\Controller\adminController::RemoveCourtAction");

$app->match('/admin/user/{id}/delete', "sport\Controller\adminController::RemoveUserAction");



//Formulaire ajout court
$app->get('/addForm_courtSportCompletely', "sport\Controller\CourtSportController::FormCourtSportSaveAction")
    ->bind('formCourtSportSave');

$app->get('/formAdd_courtSport', "sport\Controller\CourtSportController::FormCourtSportAction")
    ->bind('formAdd_courtSport');


//Route Liste par différent sport
$app->get('/courtSportBasket', "sport\Controller\CourtSportController::CourtSportByBasketAction")
    ->bind('courtSportBasket');

$app->get('/courtSportFoot', "sport\Controller\CourtSportController::CourtSportByFootAction")
    ->bind('courtSportFoot');

$app->get('/courtSportRun', "sport\Controller\CourtSportController::CourtSportByRunningAction")
    ->bind('courtSportRun');

$app->match('/saveSport', "sport\Controller\SportController::saveSportAction")
    ->bind('saveSport');

//route Recherche
$app->match('/search', "sport\Controller\CourtSportController::SearchCourtSportAction")
    ->bind('search');

$app->get('/detailedTerrain/{id}', "sport\Controller\CourtSportController::DetailCourtSmportAction")
    ->value('id',false)
    ->bind('detailCourtSport');




