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
        $this->courtDAO = $courtDAO;
    }

    public function setSportDAO(SportDAO $sportDAO) {
        $this->sportDAO = $sportDAO;
    }

    /** CONSTRUCTEUR */
    protected function buildDomainObject($row) {
        $courtSport = new CourtSport();
        $courtSport->setIdCourtSport($row['idCourtSport']);

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
    public function findCourtSport($id)
    {
        $query = $this->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from('courtSport')
            ->where('idCourtSport = ?');

        $result = $this->getDb()->fetchAssoc($query, array($id));

        $courtSport = $this->buildDomainObject($result);

        return $courtSport;
    }

    /** Recherche d'une liste d'association COURT / SPORT par SPORT */
    public function findAllCourtSports()
    {
        $courtSports = array();
        $query = $this->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from('courtSport');

        $results = $this->getDb()->fetchAll($query);

        foreach ($results as $row) {
            $idCourtSport = $row['idCourt'];
            $courtSports[$idCourtSport] = $this->buildDomainObject($row);
        }

        return $courtSports;
    }

    /** Remove d'une association COURT / SPORT */

    /** Add d'une association COURT / SPORT */
}