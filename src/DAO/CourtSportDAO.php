<?php
/**
 * Created by PhpStorm.
 * User: thibaut
 * Date: 25/05/2018
 * Time: 00:27
 */

namespace sport\DAO;

use sport\Domain\CourtSport;
use sport\Domain\Sport;
use sport\Domain\Court;

class CourtSportDAO extends DAO
{
    public function setCourtDAO(CourtDAO $courtDAO) {
        $this->setCourtDAO($courtDAO);
    }

    public function setSportDAO(SportDAO $sportDAO) {
        $this->setSportDAO($sportDAO);
    }

    /** CONSTRUCTEUR */
    protected function buildDomainObject($row) {



    }

    /** Recherche d'une association COURT / SPORT */

    /** Recherche d'une liste association COURT / SPORT par SPORT */

    /** Remove d'une association COURT / SPORT */

    /** Add d'une association COURT / SPORT */
}