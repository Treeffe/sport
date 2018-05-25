<?php
/**
 * Created by PhpStorm.
 * User: thibaut
 * Date: 25/05/2018
 * Time: 00:08
 */

namespace sport\Domain;


class Sport
{
    private $idSport;
    private $libelleSport;

    public function getIdSport() {
        return $this->idSport;
    }

    public function setIdSport($idSport) {
        $this->idSport = $idSport;
    }

    public function getLibelleSport() {
        return $this->libelleSport;
    }

    public function setLibelleSport($libelleSport) {
        $this->libelleSport = $libelleSport;
    }
}