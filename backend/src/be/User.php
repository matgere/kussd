<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User;

use Be\BaseEntite as BaseEntite;

/** @Entity @HasLifecycleCallbacks 
  @Table(name="ud_user"),uniqueConstraints={@UniqueConstraint(columns={"$login", "$password"})})  */
Class User extends BaseEntite {

    /** @Id
     * @Column(type="bigint",length=20), @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="datetime",nullable=true)
      /
    private $dateConnected;

    /**
     * @Column(type="datetime", nullable=true)
      /
    private $dateDisconnected;

    /**
     * @Column(type="bigint",length=20, nullable=true)
      /
    private $dateexpirationToken;

    /**
     * @Column(type="smallint",length=1, nullable=false)
      /
    private $etatCompte;

    /**
     * @Column(type="string", length=200, nullable=false)
      /
    private $login;

    /**
     * @Column(type="string", length=200, nullable=false)
      /
    private $password;

    /**
     * @Column(type="smallint",length=1, nullable=false)
      /
    private $statut;

    /**
     * @Column(type="string", length=255, nullable=true)
      /
    private $token;

    /**
     * @Column(type="smallint",length=1, nullable=true)
      /
    private $validate;
    
    /**
     * @Column(type="string", length=200, nullable=true)
      /
    private $repName;
    
    /**
     * @Column(type="string", length=200, nullable=true)
      /
    private $numTel;

    /**
     * @Column(type="string", length=200, nullable=true)
      /
    private $activateUser;
    /**
     * @return mixed
     */
    public function getRepName()
    {
        return $this->repName;
    }

    /**
     * @return mixed
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * @param mixed $repName
     */
    public function setRepName($repName)
    {
        $this->repName = $repName;
    }

    /**
     * @param mixed $numTel
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDateConnected()
    {
        return $this->dateConnected;
    }

    /**
     * @return mixed
     */
    public function getDateDisconnected()
    {
        return $this->dateDisconnected;
    }

    /**
     * @return mixed
     */
    public function getDateexpirationToken()
    {
        return $this->dateexpirationToken;
    }

    /**
     * @return mixed
     */
    public function getEtatCompte()
    {
        return $this->etatCompte;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return mixed
     */
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * @return mixed
     */
    public function getActivateUser()
    {
        return $this->activateUser;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $dateConnected
     */
    public function setDateConnected($dateConnected)
    {
        $this->dateConnected = $dateConnected;
    }

    /**
     * @param mixed $dateDisconnected
     */
    public function setDateDisconnected($dateDisconnected)
    {
        $this->dateDisconnected = $dateDisconnected;
    }

    /**
     * @param mixed $dateexpirationToken
     */
    public function setDateexpirationToken($dateexpirationToken)
    {
        $this->dateexpirationToken = $dateexpirationToken;
    }

    /**
     * @param mixed $etatCompte
     */
    public function setEtatCompte($etatCompte)
    {
        $this->etatCompte = $etatCompte;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param mixed $validate
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;
    }

    /**
     * @param mixed $activateUser
     */
    public function setActivateUser($activateUser)
    {
        $this->activateUser = $activateUser;
    }

    
    
    }