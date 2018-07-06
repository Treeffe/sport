<?php
/**
 * Created by PhpStorm.
 * User: tcornado
 * Date: 06/07/2018
 * Time: 10:16
 */

namespace sport\Controller;
use Silex\Application;


class adminController
{
    public function RemoveSportAction($id, Application $app)
    {
        /*
        $idSport = $_POST['sport'];
        $app['dao.sport']->removeSport($idSport);

        $users = $app['dao.user']->findAllUsers();
        $courts = $app['dao.court']->findAllCourt();
        $sports = $app['dao.sport']->findAllSport();
        return $app['twig']->render('admin.html.twig', array(
            'users' => $users, 'courts' => $courts, 'sports' =>$sports));
        */
        $app['dao.sport']->removeSport($id);
        $app['session']->getFlashBag()->add('success', 'Le sport a été supprimé');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }

    public function RemoveCourtAction($id, Application $app)
    {
        $app['dao.court']->removeCourt($id);
        $app['session']->getFlashBag()->add('success', 'Le terrain a été supprimé');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }

    public function RemoveUserAction($id, Application $app)
    {
        $app['dao.user']->removeUser($id);
        $app['session']->getFlashBag()->add('success', "L'utilisateur a été supprimé'");
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }
}