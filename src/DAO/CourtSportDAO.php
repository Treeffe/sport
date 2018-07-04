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
            $court = $this->courtDAO->findCourt($idCourt);
            $courtSport->setCourt($court);
        }

        if (array_key_exists('idSport', $row)) {
            $idSport = $row['idSport'];
            $sport = $this->sportDAO->findSport($idSport);
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
            ->from('courtSport')
            ->groupBy('idSport')
            ->orderBy('idCourt');

        $results = $this->getDb()->fetchAll($query);

        foreach ($results as $row) {
            $idSport = $row['idSport'];
            $idCourt = $row['idCourt'];
            $idCourtSport = $row['idCourtSport'];

            $courtSports[$idCourtSport] = $this->buildDomainObject($row);

        }
        //$courtSports2 = Array();
        $courtSports3 = Array();
        $sports = "";
        $courtSport3 = new CourtSport();
        foreach($courtSports as $courtSport)
        {
            if($sports != "")
            {
                $sports = $sports . ', ' . $courtSport->getSport()->getLibelleSport();
            }
            else
            {
                $sports = $courtSport->getSport()->getLibelleSport();
            }
            $courtSport->getSport()->setLibelleSport($sports);
            $courtSport3->setCourt($courtSport->getCourt());
            $courtSport3->setSport($courtSport->getSport());
            $courtSport3->setIdCourtSport($courtSport->getIdCourtSport());
            $courtSports3[$courtSport->getCourt()->getIdCourt()] =  $courtSport3;
        }
        //echo count($courtSports);
        //echo count($courtSports3);
        //die();
        //$courtSport->getSport()->setLibelleSport($courtSport->getSport()->getLibelleSport().', '.$courtSport->getSport()->getLibelleSport());
        return $courtSports3;
    }

    /** Remove d'une association COURT / SPORT */

    /** Add d'une association COURT / SPORT */
    public function addCourtSport(CourtSport $courtSport)
    {
        $crtSportData = array(
            'idSport' => $courtSport->getSport()->getIdSport(),
            'idCourt' => $courtSport->getCourt()->getIdCourt()
        );
        $this->getDb()->insert('courtSport', $crtSportData);
    }

}