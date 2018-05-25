<?php
/**
 * Created by PhpStorm.
 * User: tcornado
 * Date: 18/05/2018
 * Time: 11:43
 */

namespace sport\DAO;

use sport\Domain\User;
use sport\Domain\Court;
use sport\Domain\CatSport;


class CourtDAO extends DAO
{
    private $userDAO;
    private $catSportDAO;


    public function setUserDAO(UserDAO $userDAO) {
        $this->userDAO($userDAO);
    }

    public function setCatSportDAO(CatSportDAO $catSportDAO) {
        $this->catSportDAO($catSportDAO);
    }

    /** CONSTRUCTEUR */
    protected function buildDomainObject($row) {
        $court = new Court();
        $court->setIdCourt($row['idCourt']);
        $court->setCpCourt($row['cpCourt']);
        $court->setDescriptionCourt($row['descriptionCourt']);
        $court->setImageCourt($row['imageCourt']);
        $court->setNumeroRueCourt($row['numeroRueCourt']);
        $court->setRueCourt($row['rueCourt']);
        $court->setVilleCourt();

        if (array_key_exists('idCatSport', $row)) {
            $idCatSport = $row['idCatSport'];
            $catSport = $this->catCourtDAO->find($idCatSport);
            $court->setCourt($catSport);
        }

        if (array_key_exists('idUser', $row)) {
            $idUser = $row['idUser'];
            $user = $this->userDAO->find($idUser);
            $court->setUser($user);
        }

        return $court;

    }

    /** Recherche d'un COURT */

    /** Recherche Liste COURT par SPORT*/

    /** Add a COURT */

    /** Remove a COURT */

    /** Modification a COURT */
}