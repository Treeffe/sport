<?php
/**
 * Created by PhpStorm.
 * User: tcornado
 * Date: 18/05/2018
 * Time: 11:45
 */

namespace sport\Domain;


class Court
{
    //Attribut
    private $idCourt;
    private $numeroCourt;
    private $rueCourt;
    private $cpCourt;
    private $villeCourt;
    private $imageCourt;

    private $user;
    private $catSport;

    //accesseur
    //
    public function getIdCourt() {
        return $this->idCourt;
    }

    public function setIdCourt($idCourt) {
        $this->idCourt = $idCourt;
    }

    //
    public function getNumeroCourt() {
        return $this->numeroCourt;
    }

    public function setNumeroCourt($numeroCourt) {
        $this->numeroCourt = $numeroCourt;
    }

    //
    public function getRueCourt() {
        return $this->rueCourt;
    }

    public function setRueCourt($rueCourt) {
        $this->rueCourt = $rueCourt;
    }

    //
    public function getCPCourt() {
        return $this->rueCourt;
    }

    public function setCPCourt($rueCourt) {
        $this->rueCourt = $rueCourt;
    }

    //
    public function getVilleCourt() {
        return $this->villeCourt;
    }

    public function setVilleCourt($villeCourt) {
        $this->villeCourt = $villeCourt;
    }

    //
    public function getImageCourt() {
        return $this->imageCourt;
    }

    public function setImageCourt($imageCourt) {
        $this->imageCourt = $imageCourt;
    }

    //
    public function getUserCourt() {
        return $this->userCourt;
    }

    public function setUserCourt(User $user) {
        $this->user = $user;
    }

    //
    public function getCatSportCourt() {
        return $this->catSport;
    }

    public function setCatSportCourt(CatSport $catSport) {
        $this->catSport = $catSport;
    }

}