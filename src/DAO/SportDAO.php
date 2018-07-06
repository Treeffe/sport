<?php
/**
 * Created by PhpStorm.
 * User: thibaut
 * Date: 25/05/2018
 * Time: 00:27
 */

namespace sport\DAO;

use sport\Domain\Sport;

class SportDAO extends DAO
{
    /** CONSTRUCTEUR */
    protected function buildDomainObject($row) {
        $sport = new Sport();
        $sport->setIdSport($row['idSport']);
        $sport->setLibelleSport($row['libelleSport']);
        return $sport;
    }

    /** Recherche de tous les sport */
    public function findAllSport()
    {
        $Sports = array();
        $query = $this->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from('sport');

        $results = $this->getDb()->fetchAll($query);

        foreach ($results as $row) {
            $idSport = $row['idSport'];
            $Sports[$idSport] = $this->buildDomainObject($row);
        }

        return $Sports;
    }


    /** Recherche d'un sport */
    public function findSport($id)
    {
        $query = $this->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from('sport')
            ->where('idSport ='.$id);

        $result = $this->getDb()->fetchAssoc($query);

        $sport = $this->buildDomainObject($result);

        return $sport;
    }
    /** Remove a Sport */

    /** Add a sport */
    public function saveSport(Sport $sport)
    {
        $sportData = array(
            'libelleSport' => $sport->getLibelleSport()
        );
        $this->getDb()->insert('sport', $sportData);
    }

}