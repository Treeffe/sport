<?php
/**
 * Created by PhpStorm.
 * User: tcornado
 * Date: 18/05/2018
 * Time: 14:04
 */

namespace sport\Domain;


class CatSport
{
    private $idCatSport;
    private $libelleCatSport;

    public function getIdCatSport() {
        return $this->idCatSport;
    }

    public function setIdCatSport($idCatSport) {
        $this->idCatSport = $idCatSport;
    }

    public function getLibelleCatSport() {
        return $this->libelleCatSport;
    }

    public function setLibelleCatSport($libelleCatSport) {
        $this->libelleCatSport = $libelleCatSport;
    }
}