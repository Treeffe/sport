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
use sport\DAO\UserDAO;
use sport\DAO\CatSportDAO;


class CourtDAO extends DAO
{
    private $userDAO;
    private $catSportDAO;

    public function setUserDAO($userDAO) {
        $this->userDAO = $userDAO;
    }

    public function setCatSportDAO($catSportDAO) {
        $this->catSportDAO = $catSportDAO;
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
        $court->setVilleCourt($row['ville']);

        if (array_key_exists('idCatSport', $row)) {
            $idCatSport = $row['idCatSport'];
            $catSport = $this->catSportDAO->findByIdCatSport($idCatSport);
            $court->setCatSport($catSport);
        }

        if (array_key_exists('idUser', $row)) {
            $idUser = $row['idUser'];
            $user = $this->userDAO->find($idUser);
            $court->setUserCourt($user);
        }

        return $court;

    }

    /** Recherche d'un COURT */
    public function findCourt($id)
    {
        $query = $this->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from('court')
            ->where('idCourt ='.$id);

        $result = $this->getDb()->fetchAssoc($query);

        $court = $this->buildDomainObject($result);

        return $court;
    }


    public function findCourtSportByInfo(Court $court)
    {
        $query = $this->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from('court')
            ->where('ville = '."'".$court->getVilleCourt()."'")
            ->andWhere('rueCourt = '."'". $court->getRueCourt()."'")
            ->andWhere('cpCourt = '."'". $court->getCpCourt()."'")
            ->andWhere('descriptionCourt = '."'". $court->getDescriptionCourt()."'");

        $result = $this->getDb()->fetchAssoc($query);

        $court = $this->buildDomainObject($result);

        return $court;
    }
    /** Recherche de tous les COURT */
    public function findAllCourt()
    {
        $courts = array();
        $query = $this->getDb()
            ->createQueryBuilder()
            ->select('*')
            ->from('court');

        $results = $this->getDb()->fetchAll($query);

        foreach ($results as $row) {
            $idCourt = $row['idCourt'];
            $courts[$idCourt] = $this->buildDomainObject($row);
        }
        return $courts;
    }

    /** Add a COURT */
    public function saveCourt(Court $court)
    {
        $courtData = array(
            'cpCourt' => $court->getCpCourt(),
            'descriptionCourt' => $court->getDescriptionCourt(),
            'idUser' => $court->getUserCourt()->getIdUser(),
            'imageCourt' => $court->getImageCourt(),
            'numeroRueCourt' => $court->getNumeroRueCourt(),
            'ville' => $court->getVilleCourt(),
            'rueCourt' =>$court->getRueCourt()
        );
        $this->getDb()->insert('court', $courtData);
    }

    /** Remove a COURT */
    public function removeCourt($id)
    {
        $court = $this->findCourt($id);
        $this->getDb()->delete('court', array('idCourt' => $id) );
    }

/** Modification a COURT */
}