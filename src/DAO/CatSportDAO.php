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
        $query = $this->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from('catsport')
            ->where('idCatSport ='.$id);

        $row = $this->getDb()->fetchAssoc($query);

        return $this->buildDomainObject($row);
    }

    public function RemoveCatSport($id)
    {
        $catSport = $this->findByIdCatSport($id);
        $this->getDb()->remove('catSport', $catSport);
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