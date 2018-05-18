<?php
/**
 * Created by PhpStorm.
 * User: tcornado
 * Date: 18/05/2018
 * Time: 14:14
 */

namespace sport\DAO;
use sport\Domain\CatSport;

class CatSportDAO extends DAO
{
    protected function buildDomainObject($row) {
        $catSport= new CatSport();
        $catSport->setIdCatSport($row['idCatSport']);
        $catSport->setLibelleCatSport($row['libelleCatSport']);

        return $catSport;
    }

    public function findAllCatSport()
    {
        $catSports = array();
        $query = $this->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from('catsport');


        $results = $this->getDb()->fetchAll($query);

        foreach ($results as $row) {
            $catSportLib = $row['libelleCatSport'];
            $catSports[$catSportLib] = $this->buildDomainObject($row);
        }

        return $catSports;

    }

    public function findByIdCatSport($id)
    {
        $catSports = array();
        $results = $this->getDb()->select('*')
            ->from('catsport')
            ->where('idCatSport = :identifier')
            ->orderBy('libelleCatSport', 'ASC')
            ->setParameter('identifier', $id);


        foreach ($results as $row) {
            $catSportLib = $row['libCatSport'];
            $catSports[$catSportLib] = $this->buildDomainObject($row);
        }
        return $catSports;

    }

    public function RemoveCatSport($id)
    {

    }

    public function AddCatSport(CatSport $catSport)
    {
        $catSportData = array(
            'idCatSport' => $catSport->getIdCatSport(),
            'libelleCatSport' => $catSport->getLibelleCatSport(),

        );
        // The user has already been saved : update it
        $this->getDb()->insert('catSport', $catSportData);
    }

}