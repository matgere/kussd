<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Diodio MBODJ
 */

namespace Menu;

require_once '../../common/app.php';

use Bo\BaseAction;
use Bo\BaseController;
use Common\CommonManager;
use Exceptions\ConstraintException;
use Exception;
use Menu\Menu;
use Menu\MenuManager as MenuManager;

class MenuController extends BaseAction implements BaseController {

    private $commonManager;
    private $menu;
    private $menuManager;

    public function __construct($request) {
        $file = dirname(dirname(dirname(__FILE__))) . '/lang/trad_fr.ini';
        $this->parameters = parse_ini_file($file);
        $this->commonManager = new CommonManager();
        $this->menu = new Menu();
        $this->menuManager = new MenuManager();
        try {
            if (isset($request['ACTION'])) {
                switch ($request['ACTION']) {
                    case \App::ACTION_GET_SESSION:
                        $this->doGetSession($request);
                        break;
                    case \App::ACTION_LIST:
                        $this->doList($request);
                        break;
                    case \App::ACTION_INSERT:
                        $this->doInsert($request);
                        break;
                    case \App::ACTION_UPDATE:
                        $this->doUpdate($request);
                        break;
                    case \App::ACTION_GENERATE_MENU:
                        $this->doGenerateMenu($request);
                        break;
                    case \App::ACTION_GET_ALL_MENU_BY_USER:
                        $this->doGetAllMenuByUser($request);
                        break;
                    default: throw new Exception($this->parameters['NO_ACTION']);
                }
            } else
                throw new Exception($this->parameters['NO_ACTION']);
        } catch (Exception $e) {
            $this->doLogInfo($e->getMessage());
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doInsert($request) {
        $this->doLogInfo('List des parametres:' . $this->doGetListParam());
        try {
            if (isset($request['ACTION']) && isset($request['userId']) && isset($request['name']) && isset($request['title']) && isset($request['text']) &&
                    isset($request['parent']) && isset($request['type']) && isset($request['actions']) && isset($request['methode']) && isset($request['url'])) {

                if ($request['userId'] != '' && $request['name'] != '' && $request['title'] != '' && $request['text'] != '' &&
                        $request['parent'] != '' && $request['type'] != '' && $request['actions'] != '' && $request['methode'] != '' && $request['url'] != '') {
                    $user = $this->commonManager->findById("User\User", $request['userId']);

                    $this->menu->setName($request['name']);
                    $this->menu->setTitle($request['title']);
                    $this->menu->setText($request['text']);
                    if ($request['parent'] != "ALL") {
                        $parent = $this->commonManager->findById("Menu\Menu", $request['parent']);
                        $this->menu->setParent($parent);
                    }

                    if ($request['type'] == "accesskey") {
                        if (isset($request['ordre'])) {
                            $this->menu->setOrdre($request['ordre']);
                            if ($request['odre'] !== 'ALL')
                                $this->menu->setOrdre($request['ordre']);
                            else {
                                $this->doLogError($this->parameters['CODE_101_ADMIN']);
                                throw new ConstraintException('Le champs ordre est vide');
                            }
                        }
//                                 else {
//                                     $this->doLogError($this->parameters['CODE_100_ADMIN']);
//                                     throw new ConstraintException($this->parameters['CODE_100']);
//                                 }
                    } else
                        $this->menu->setOrdre(0);
                    $this->menu->setType($request['type']);
                    $this->menu->setAction($request['actions']);
                    $this->menu->setMethode($request['methode']);
                    $this->menu->setUrl($request['url']);
                    $this->menu->setUser($user);
                    $this->menu->setGenerate(1);

                    $menu = $this->commonManager->insert($this->menu);

                    if ($menu != null) {
                        $this->doSuccess($menu->getId(), $this->parameters['INSERT']);
                        $this->doLogInfo('***************************************** Fin ajout Menu *****************************************');
                    } else {
                        $this->doLogError($this->parameters['CODE_104_ADMIN']);
                        throw new ConstraintException($this->parameters['CODE_104']);
                    }
                } else {
                    $this->doLogError($this->parameters['CODE_101_ADMIN']);
                    throw new ConstraintException('Certains champs sont vides');
                }
            } else {
                $this->doLogError($this->parameters['CODE_100_ADMIN']);
                throw new ConstraintException($this->parameters['CODE_100']);
            }
            //            }else {
            //                $this->doLogError($this->parameters['CODE_100_ADMIN']);
            //                throw new ConstraintException($this->parameters['CODE_100']);
            //            }
            $this->doLogInfo("Fin doGenerateMenu");
        } catch (ConstraintException $e) {
            $this->doLogInfo($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $this->doLogInfo($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    public function doGenerateMenu($request){
        try {
            //rep
//             $chemin=getcwd();
            $chemin='C:/xampp/htdocs/';
            $repUser='ussdgenerate/';
            $tagChild="";
            $index="index";
            $this->doLogInfo("Debut du doGenerateMenu");
            $this->doLogInfo('List des parametres:' . $this->doGetListParam());
            if (isset($request['ACTION']) && isset($request['userId']) ){
                
                $user = $this->menuManager->findById("User\User", $request['userId']);
                if($user!=null){
                    if($user->getRepName()!=null)
                        $repUser=$user->getRepName().'/';
                    else 
                        $repUser=$repUser.$user->getId().'/';
                        $dest=$chemin.$repUser;
                        if (!file_exists($dest))
                            mkdir($dest, 0777, true);
                        
                   //Menu Parent
                   $masterParent=$this->menuManager->getMasterParent($user);
                   if($masterParent!=null){
                    $masterId=$masterParent['id'];
                    $masterType=$masterParent['type'];
                    $masterText=$masterParent['text'];
                    $masterName=$masterParent['name'];
                    $masterOrdre=$masterParent['ordre'];
                    $masterTitle=$masterParent['title'];
                    $this->doLogInfo('Master Menu Id:' . $masterId);
                    
                    if($masterType=="accesskey"){
                        $listMenuChild=$this->menuManager->getAllChildByParentId($masterId);
                        foreach ($listMenuChild as $unMenu) {
                            $menuChild=$this->commonManager->findById("Menu\Menu", $unMenu["id"]);
                            $this->doLogInfo('menuChildId:' . $menuChild->getId());
                                
                            $titleChild=$menuChild->getTitle();
                            $nameChild=$menuChild->getName();
                            $textChild=$menuChild->getText();
                            $typeChild=$menuChild->getType();
                            $urlChild=$menuChild->getUrl();
                            $ordreChild=$menuChild->getOrdre();
                                        
                            $file = $chemin.$repUser.$nameChild.'.php';
                        
//                             if($typeChild=="accesskey"){
                            $tagChild.='<a href="'.$nameChild.'.php?response="'.$titleChild.'" accesskey="'.$ordreChild.'" >'.$titleChild.'</a><br/>';
                            
                            }
                    }
                    else
                        if($masterType=="input")
                       $tagChild='<form action="index.php"><input type="text" name="response"/></form>';
                            
                 
                    $file = $chemin.$repUser.$index.'.php';
                    $current = "<?xml version='1.0' encoding='utf-8'?>
                        <!doctype html><html>
                        <head><meta charset='utf-8'>
                        <title>$masterName</title>
                        </head><body>
                        <h3>$masterText</h3>
                        $tagChild
                        </body></html>
                         ";
                            // Write the contents back to the file
                            file_put_contents($file, $current);
                    // Open the file to get existing content
                
//                 $this->doResult( 'Fichier '.$file.' cr�� avec succ�s');
                $this->doSuccess(1, $this->parameters['GENERATED']);
                }
                
            }
            else {
                $this->doLogError($this->parameters['CODE_102_ADMIN']);
                throw new ConstraintException('User null');
            }
                
            }else {
                $this->doLogError($this->parameters['CODE_100_ADMIN']);
                throw new ConstraintException($this->parameters['CODE_100']);
            }
            //            }else {
            //                $this->doLogError($this->parameters['CODE_100_ADMIN']);
            //                throw new ConstraintException($this->parameters['CODE_100']);
            //            }
            $this->doLogInfo("Fin doGenerate Menu");
        } catch (ConstraintException $e) {
            $this->doLogInfo($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $this->doLogInfo($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doGetAllMenuByUser($request) {
        $this->doLogInfo("Debut doGetAllMenuByUser");
        $this->doLogInfo('List des parametres:' . $this->doGetListParam());
        try {
            $this->doLogInfo('List des parametres:' . $this->doGetListParam());
            if (isset($request['ACTION']) && isset($request['userId'])) {
                $user = $this->commonManager->findById("User\User", $request['userId']);
                $listMenu = $this->menuManager->getAllMenusArray($user);
            //    var_dump($listMenu);
//                 $listMenu=json_encode($listMenu);
//                 $this->doLogInfo('List menu:' . $listMenu);

                if ($listMenu != NULL) {
                    $this->doSuccessO($listMenu);
                    $this->doLogInfo("Fin doGetAllMenuByUser");
                } else {
                    $this->doLogError($this->parameters['CODE_110_ADMIN']);
                    throw new ConstraintException($this->parameters['CODE_110']);
                    $this->doLogInfo("Erreur liste des menus vides");
                }
            }
        } catch (ConstraintException $e) {
            $this->doLogError($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
            $this->doLogError("Fin doGetAllMenuByUser");
        } catch (Exception $e) {
            $this->doLogError($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
            $this->doLogError("Fin doGetAllMenuByUser ");
        }
    }

    public function doRestore($request) {
        
    }

    public function doDeactivate($request) {
        
    }

    public function doRemove($request) {
        
    }

    public function doView($request) {
        
    }

    public function doUpdate($request) {
        
    }

    public function doActivate($request) {
        
    }

    public function doList($request) {
        
    }

    public function dofindById($request) {
        
    }

    //put your code here
}

$oMenuController = new MenuController($_REQUEST);


