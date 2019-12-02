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
         return $this->menuQueries->getAllMenuByUser($user);
         
     }

    public function getAllMenusArray($user) {
        
        $listMenus =array();
        $masterParent = $this->menuQueries->getMasterParent($user);
        $masterParentArray= array();
        $masterParentArray['Parent'] = $masterParent['title'];
        $masterParentArray['id'] = $masterParent['id'];
        $listMenus[] = $masterParentArray;
        $listMenuChild = $this->menuQueries->getAllChildByParentId($masterParent['id']);
        foreach ($listMenuChild as $unMenuChild) {
            
            $menuChild = $this->commonManager->findById("Menu\Menu", $unMenuChild["id"]);
            $this->doLogInfo('menuChildId:' . $menuChild->getId());
            $titleChild = $menuChild->getTitle();
            $nameChild = $menuChild->getName();
            $textChild = $menuChild->getText();
            $typeChild = $menuChild->getType();
            $urlChild = $menuChild->getUrl();
            $ordreChild = $menuChild->getOrdre();
            
            $menuChildArray1 = array();
            $menuChildArray1 ['parent_id']= $menuChild->getParent()->getId();  
            $menuChildArray1 ['parent_name']= $menuChild->getParent()->getName();  
            $menuChildArray1 ['id']= $menuChild->getId(); 
            $menuChildArray1 ['title']= $titleChild;  
            $menuChildArray1 ['name']= $nameChild;  
            $menuChildArray1 ['type']= $typeChild;  
            $menuChildArray1 ['text']= $textChild;  
            $menuChildArray1 ['url']= $urlChild;  
            $menuChildArray1 ['ordre']= $ordreChild;  
            $listMenus[] = $menuChildArray1;
            
            $listMenuChild2=$this->menuQueries->getAllChildByParentId($unMenuChild["id"]);
            //var_dump($listMenuChild2);
            foreach ($listMenuChild2 as $unMenuChild2) {
                 $menuChild2 = array();
                $menuChild2 = $this->commonManager->findById("Menu\Menu", $unMenuChild2["id"]);
                $titleChild2 = $menuChild2->getTitle();
                $nameChild2 = $menuChild2->getName();
                $textChild2 = $menuChild2->getText();
                $typeChild2 = $menuChild2->getType();
                $urlChild2 = $menuChild2->getUrl();
                $ordreChild2 = $menuChild2->getOrdre();
               // $menuChildArray2 ['title']= $titleChild2;  
               // $listMenus['child1'] = $menuChildArray2;
               // 
               // 
                 //var_dump($titleChild .' parent de '.$titleChild2 );
                //var_dump($unMenuChild2["id"] .' ==== '.$menuChild2->getId() );
                
                
                $menuChildArray2 = array();
                $menuChildArray2 ['id']= $menuChild2->getId(); 
                $menuChildArray2 ['parent_id']= $menuChild2->getParent()->getId();  
                $menuChildArray2 ['parent_name']= $menuChild2->getParent()->getName();
                $menuChildArray2 ['title']= $titleChild2;  
                $menuChildArray2 ['name']= $nameChild2;  
                $menuChildArray2 ['type']= $typeChild2;  
                $menuChildArray2 ['text']= $textChild2;  
                $menuChildArray2 ['url']= $urlChild2;  
                $menuChildArray2 ['ordre']= $ordreChild2;  
                $listMenus[] = $menuChildArray2;
            
                $listMenuChild3=$this->menuQueries->getAllChildByParentId($unMenuChild2["id"]);
              //var_dump($listMenuChild3);  
            foreach ($listMenuChild3 as $unMenuChild3) {
                 //$menuChild3 = array();
                $menuChild3 = $this->commonManager->findById("Menu\Menu", $unMenuChild3["id"]);
                $titleChild3 = $menuChild3->getTitle();
                $nameChild3 = $menuChild3->getName();
                $textChild3 = $menuChild3->getText();
                $typeChild3 = $menuChild3->getType();
                $urlChild3 = $menuChild3->getUrl();
                $ordreChild3 = $menuChild3->getOrdre();
                 //var_dump($titleChild2 .' bis -- parent de '.$titleChild3 );
               
                $menuChildArray3 = array();
             $menuChildArray3 ['id']= $menuChild3->getId();   
            $menuChildArray3 ['parent_id']= $menuChild3->getParent()->getId();
            $menuChildArray3 ['parent_name']= $menuChild3->getParent()->getName();  
            $menuChildArray3 ['title']= $titleChild3;  
            $menuChildArray3 ['name']= $nameChild3; 
            $menuChildArray3 ['type']= $typeChild3;   
            $menuChildArray3 ['text']= $textChild3;  
            $menuChildArray3 ['url']= $urlChild3;  
            $menuChildArray3 ['ordre']= $ordreChild3;   
                $listMenus[] = $menuChildArray3;
            }
               
                
                
               
            }
            
        }
        return $listMenus;
    }

    public function getMenuTab($user) {
        $array = $this->menuQueries->getAllMenuByUser($user);
        foreach ($array as $key => $value) {
            
        }
    }
    
    public function getMasterParent($parent){
        return $this->menuQueries->getMasterParent($parent);
    }
    
    public function getAllChildByParentId($parent){
        return $this->menuQueries->getAllChildByParentId($parent);
    }

    //put your code here
}
