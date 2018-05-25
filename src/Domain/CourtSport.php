<?php
/**
 * Created by PhpStorm.
 * User: thibaut
 * Date: 25/05/2018
 * Time: 00:12
 */

namespace sport\Domain;


class CourtSport
{
    private $idCourtSport;
    private $court;
    private $sport;

    //
    public function getIdCourtSport() {
        return $this->idCourtSport;
    }

    public function setIdCourtSport($idCourtSport) {
        $this->idCourtSport = $idCourtSport;
    }

    //
    public function getCourt() {
        return $this->court;
    }

    public function setCourt(Court $court) {
        $this->court = $court;
    }

    //
    public function getSport() {
        return $this->sport;
    }

    public function setSport(Sport $sport) {
        $this->sport = $sport;
    }
}