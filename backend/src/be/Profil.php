<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace User;
use Be\BaseEntite as BaseEntite;
/** @Entity @HasLifecycleCallbacks 
 * @Table(name="ud_profil") * */
class Profil extends BaseEntite {
     /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    private $id;
    
    /** 
     * @Column(type="string", length=50, nullable=false)
     * */
    private $code;
    /**
     * @Column(type="string", length=255, nullable=true)
     * */
    private $description;
    /**
     * @Column(type="string", length=50, nullable=true)
     * */
    private $libelle;
   
  /**
     * @Column(type="string", length=50, nullable=true)
     * */
    private $codeEtablissement;
    
    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getDescription() {
        return $this->description;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getCodeEtablissement() {
        return $this->codeEtablissement;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setCodeEtablissement($codeEtablissement) {
        $this->codeEtablissement = $codeEtablissement;
    }



}