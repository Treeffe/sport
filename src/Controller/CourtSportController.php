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
use sport\Domain\Court;
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

    public function CourtSportByBasketAction(Application $app) {
        $courtSports = $app['dao.courtSport']->findListByBasket();
        return $app['twig']->render('ListCourt.html.twig', array('courtSports' => $courtSports));
    }

    public function CourtSportByFootAction(Application $app) {
        $courtSports = $app['dao.courtSport']->findListByFoot();
        return $app['twig']->render('ListCourt.html.twig', array('courtSports' => $courtSports));
    }

    public function CourtSportByRunningAction(Application $app) {
        $courtSports = $app['dao.courtSport']->findListByRun();
        return $app['twig']->render('ListCourt.html.twig', array('courtSports' => $courtSports));
    }

    public function CourtSportSaveAction(Application $app)
    {
        $sports = $app['dao.sport']->findAllSport();
        //enregistrement de court
        $court = new Court();
        $user = new User();
            //verif + récupération attribut
        if(isset($_POST["ville"]) && isset($_POST["rue"]))
        {
            if(isset($_POST["cp"]))
            {
            $cpCourt = $_POST["cp"];
            $court->setCpCourt($cpCourt);
            }
            if(isset($_POST["description"])) {
                $description = $_POST["description"];
                $court->setDescriptionCourt($description);
            }

            if(isset($_POST["user"]))
            {
                $idUser = $_POST["user"];
                $user = $app['dao.user']->findUser($idUser);
                $court->setUserCourt($user);
            }
            if(isset($_POST["image"]))
            {
                $image = $_POST["image"];
                $court->setImageCourt($image);
            }
            if(isset($_POST["numero"]))
            {
                $numero = $_POST["numero"];
                $court->setNumeroRueCourt($numero);
            }
            $rue = $_POST["rue"];
            $court->setRueCourt($rue);
            $ville = $_POST["ville"];
            $court->setVilleCourt($ville);
            $court->setImageCourt('images/default.jpg');
        }
        $app['dao.court']->saveCourt($court);

        //enregistrement du courtSport

        $courtSport = new CourtSport();
        $idSport = $_POST["sport"];

        //alloc
        $courtSport->setCourt($app['dao.court']->findCourtSportByInfo($court));
        $courtSport->setSport($app['dao.sport']->findSport($idSport));
        //sauvegarde
        $app['dao.courtSport']->addCourtSport($courtSport);


        $courtSports = $app['dao.courtSport']->findAllCourtSports();
        return $app['twig']->render('ListCourt.html.twig', array('courtSports' => $courtSports ));
    }

    public function FormCourtSportSaveAction(Application $app)
    {
        $sports = Array();
        $sports = $app['dao.sport']->findAllSport();

        return $app['twig']->render('AddFormCompletely_CourtSport.html.twig', array('sports' => $sports));
    }


}