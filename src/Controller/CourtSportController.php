<?php
/**
 * Created by PhpStorm.
 * User: tcornado
 * Date: 03/07/2018
 * Time: 17:39
 */

namespace sport\Controller;
//use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use sport\DAO\CourtDAO;
use sport\Domain\CourtSport;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use sport\Domain\User;
use sport\Form\Type\CommentType;
use sport\Form\Type\UserType;


class CourtSportController
{
    //Liste de tous les terrains avec leur sport
    public function CourtsAction(Application $app) {
        $courtSports = $app['dao.courtSport']->findAllCourtSports();
        return $app['twig']->render('ListCourt.html.twig', array('courtSports' => $courtSports));
    }

    //Ajout d'un courtSport avec un court et un sport
    public function AddCourtSportAction(Request $request, Application $app)
    {
        $courtSport = new CourtSport();
        //verif + récupération attribut
        if(isset($_POST["court"]) && isset($_POST["sport"]))
        {
            $idCourt = $_POST["court"];
            $idSport = $_POST["sport"];
        }
        //alloc
        $courtSport->setCourt($app['dao.court']->findCourt($idCourt));
        $courtSport->setSport($app['dao.sport']->findSport($idSport));
        //sauvegarde
        $app['dao.courtSport']->addCourtSport($courtSport);

        //retourner sur page des courtSport
        $courtSports = $app["dao.courtSport"]->findAllCourtSports();
        //echo "<pre>";//var_dump($courtSport->getCourt());//die(fin);//echo "</pre>";
        return $app['twig']->render('ListCourt.html.twig', array('courtSports' => $courtSports));
    }

    public function FormCourtSportAction(Application $app)
    {
        $courts = Array();
        $sports = Array();
        $courts = $app['dao.court']->findAllCourt();
        $sports = $app['dao.sport']->findAllSport();

        return $app['twig']->render('FormAddCourtSport.html.twig', array('sports' => $sports, 'courts' => $courts));
    }
}