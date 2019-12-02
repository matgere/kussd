<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestAdmisManager
 *
 * @author lenovo
 */

namespace Menu;

use Menu\Menu;
use Bo\BaseAction;
use Common\CommonManager;
use Menu\MenuQueries;

//use DA\TestAdmisQueries as TestAdmisQueries;


class MenuManager extends BaseAction implements \Bo\BaseManager {

    private $commonManager;
    private $menuQueries;
    private $testAdmis;

    public function __construct() {
        $this->commonManager = new CommonManager();
        // $this->testAdmisQueries= new tes
        $this->menuQueries = new MenuQueries();
    }

    public function findById($object, $id) {
        return $this->commonManager->findById($object, $id);
    }

    //     public function insrcire($listeInscrite, $listInscriptionUpdate) {
    //         return $this->testAdmisQueries->insrcire($listeInscrite, $listInscriptionUpdate);
    //     }
    public function insert($object, $supp = null) {
        return $this->commonManager->insert($object, $supp);
    }

    public function remove($entity, $listId, $userId = null) {
        return $this->commonManager->remove($entity, $listId, $userId);
    }

    public function restore($entity, $listId, $userId = null) {
        return $this->commonManager->restore($entity, $listId, $userId);
    }

    public function update($object) {
        return $this->commonManager->update($object);
    }

    public function view($id) {
        return $this->testAdmisQueries->view($id);
    }

    public function activate($entity, $listId, $userId = null) {//$entity=namePackage\nameClass
        return $this->commonManager->activate($entity, $listId, $userId);
    }

    public function deactivate($entity, $listId, $userId = null) {
        return $this->commonManager->deactivate($entity, $listId, $userId);
    }

    public function doArchive($entity, $listId, $userId = null) {
        return $this->commonManager->doArchive($entity, $listId, $userId);
    }

    public function undoArchive($entity, $listId, $userId = null) {
        return $this->commonManager->undoArchive($entity, $listId, $userId);
    }

    public function delete($entity, $listId, $userId = null) {
        return $this->commonManager->delete($entity, $listId, $userId);
    }

    public function findByCode($entity, $entityCode) {
        return $this->commonManager->findByCode($entity, $entityCode);
    }

    public function getAllMenuByUser($user) {
        // return $this->menuQueries->getAllMenuByUser($user);
        $masterParent = $this->menuQueries->getMasterParent($user);

        $listMenuChild = $this->menuQueries->getAllChildByParentId($masterParent['id']);
        foreach ($listMenuChild as $unMenu) {
            $menuChild = $this->commonManager->findById("Menu\Menu", $unMenu["id"]);
            $this->doLogInfo('menuChildId:' . $menuChild->getId());
            $titleChild = $menuChild->getTitle();
            $nameChild = $menuChild->getName();
            $textChild = $menuChild->getText();
            $typeChild = $menuChild->getType();
            $urlChild = $menuChild->getUrl();
            $ordreChild = $menuChild->getOrdre();
            $listMenuChild2=$this->menuManager->getAllChildByParentId($unMenu["id"]);
            foreach ($listMenuChild as $unMenuChild) {
                $menuChild2 = $this->commonManager->findById("Menu\Menu", $unMenuChild["id"]);
                $titleChild2 = $menuChild2->getTitle();
                $nameChild2 = $menuChild2->getName();
                $textChild2 = $menuChild2->getText();
                $typeChild2 = $menuChild2->getType();
                $urlChild2 = $menuChild2->getUrl();
                $ordreChild2 = $menuChild2->getOrdre();
                var_dump($titleChild .' parent de '.$titleChild2 );
            }
        }
    }

    public function getMenuTab($user) {
        $array = $this->menuQueries->getAllMenuByUser($user);
        foreach ($array as $key => $value) {
            
        }
    }

    public function getMasterParent($parent) {
        return $this->menuQueries->getMasterParent($parent);
    }

    public function getAllChildByParentId($parent) {
        return $this->menuQueries->getAllChildByParentId($parent);
    }

    //put your code here
}
