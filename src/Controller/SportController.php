<?php
/**
 * Created by PhpStorm.
 * User: tcornado
 * Date: 06/07/2018
 * Time: 10:17
 */

namespace sport\Controller;

use sport\DAO\CourtDAO;
use sport\Domain\CourtSport;
use sport\Domain\Court;
use sport\Domain\Sport;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use sport\Domain\User;
use sport\Form\Type\CommentType;
use sport\Form\Type\UserType;
use Silex\Application;

class SportController
{
    public function saveSportAction(Application $app)
    {
        $sport = new Sport();
        //verif + récupération attribut
        if(isset($_POST["libelleSport"]))
        {
            $libelleSport = $_POST["libelleSport"];
        }
        //alloc
        $sport->setLibelleSport($libelleSport);

        //sauvegarde
        $app['dao.sport']->saveSport($sport);

        //retourner sur page admin
        $courts = $app['dao.court']->findAllCourt();
        $sports = $app['dao.sport']->findAllSport();
        $users = $app['dao.user']->findAllUsers();

        //echo "<pre>";//var_dump($courtSport->getCourt());//die(fin);//echo "</pre>";
        return $app['twig']->render('admin.html.twig',
            array('sports' => $sports, 'users' => $users, 'courts' => $courts));
    }

}