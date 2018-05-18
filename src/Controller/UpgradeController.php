<?php
/**
 * Created by PhpStorm.
 * User: tcornado
 * Date: 18/05/2018
 * Time: 16:21
 */
namespace sport\Controller;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use sport\Domain\User;
use sport\Form\Type\CommentType;
use sport\Form\Type\UserType;

class UpgradeController
{
    public function CatSportAction(Application $app) {
        $catSports = $app['dao.catSport']->findAllCatSport();
        return $app['twig']->render('catSports.html.twig', array('catSports' => $catSports));
    }

    public function IdCatSportAction($id, Request $request, Application $app){
        $catSport = $app['dao.catSport']->findByIdCatSport($id);

        return $app['twig']->render('unecat.html.twig', array(
            'catSport' => $catSport));
    }
}