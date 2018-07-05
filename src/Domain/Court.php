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
    private $numeroRueCourt;
    private $rueCourt;
    private $cpCourt;
    private $villeCourt;
    private $imageCourt;
    private $descriptionCourt;

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
    public function getNumeroRueCourt() {
        return $this->numeroRueCourt;
    }

    public function setNumeroRueCourt($numeroRueCourt) {
        $this->numeroRueCourt = $numeroRueCourt;
    }

    //
    public function getRueCourt() {
        return $this->rueCourt;
    }

    public function setRueCourt($rueCourt) {
        $this->rueCourt = $rueCourt;
    }

    //
    public function getCpCourt() {
        return $this->cpCourt;
    }

    public function setCpCourt($cpCourt) {
        $this->cpCourt = $cpCourt;
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
    public function getDescriptionCourt() {
        return $this->descriptionCourt;
    }

    public function setDescriptionCourt($descriptionCourt) {
        $this->descriptionCourt = $descriptionCourt;
    }

    //
    public function getUserCourt() {
        return $this->user;
    }

    public function setUserCourt(User $user) {
        $this->user = $user;
    }

    //
    public function getCatSport() {
        return $this->catSport;
    }

    public function setCatSport(CatSport $catSport) {
        $this->catSport = $catSport;
    }

}