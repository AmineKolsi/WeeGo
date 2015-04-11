<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mail
 *
 * @author Aminovski
 */

namespace BestTrip\MailBundle\Entity;
class Mail {

    private $nom;
    private $prenom;
    private $tel;
    private $from;
    private $text;
    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getTel() {
        return $this->tel;
    }

    function getFrom() {
        return $this->from;
    }

    function getText() {
        return $this->text;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setFrom($from) {
        $this->from = $from;
    }

    function setText($text) {
        $this->text = $text;
    }


    
    
    

}
