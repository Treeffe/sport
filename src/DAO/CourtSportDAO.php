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
    private $courtDAO;
    private $sportDAO;

    public function setCourtDAO(CourtDAO $courtDAO) {
        $this->courtDAO($courtDAO);
    }

    public function setSportDAO(SportDAO $sportDAO) {
        $this->sportDAO($sportDAO);
    }

    /** CONSTRUCTEUR */
    protected function buildDomainObject($row) {
        $courtSport = new CourtSport();
        $courtSport->setIdCourtSport($row['idCourtSport']);

        $idSport = $row['idSport'];

        if (array_key_exists('idCourt', $row)) {
            $idCourt = $row['idCourt'];
            $court = $this->courtDAO->find($idCourt);
            $courtSport->setCourt($court);
        }

        if (array_key_exists('idSport', $row)) {
            $idSport = $row['idSport'];
            $sport = $this->sportDAO->find($idSport);
            $courtSport->setSport($sport);
        }
        return $courtSport;
    }

    /** Recherche d'une association COURT / SPORT */

    /** Recherche d'une liste association COURT / SPORT par SPORT */

    /** Remove d'une association COURT / SPORT */

    /** Add d'une association COURT / SPORT */
}