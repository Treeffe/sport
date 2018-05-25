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
    public function setUserDAO(UserDAO $userDAO) {
        $this->setUserDAO($userDAO);
    }

    public function setCatSportDAO(CatSportDAO $catSportDAO) {
        $this->setCatSportDAO($catSportDAO);
    }

    /** CONSTRUCTEUR */
    protected function buildDomainObject($row) {

    }

    /** Recherche d'un COURT */

    /** Recherche Liste COURT par SPORT*/

    /** Add a COURT */

    /** Remove a COURT */

    /** Modification a COURT */
}