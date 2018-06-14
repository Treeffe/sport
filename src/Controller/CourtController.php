<?php


namespace sport\Controller;
//use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use sport\Domain\User;
use sport\Form\Type\CommentType;
use sport\Form\Type\UserType;

class CourtController
{
    /** Controller liste COURT */
    public function CourtsAction(Application $app) {
        $courts = $app['dao.courtSport']->findAllCourtSports();
        return $app['twig']->render('ListCourt.html.twig', array('courts' => $courts));
    }

    /** Controller liste de COURT par categorie*/


    /** Controller liste COURT par USER */


    /** Controller détail d'un COURT*/
    public function CourtAction(Application $app,$id) {
        $court = $app['dao.courtSport']->findCourtSport($id);
        return $app['twig']->render('CourtDetailed.html.twig', array('court' => $court));
    }
    /** Controller remove d'un COURT */

    /** Controller ajout d'un COURT */
}