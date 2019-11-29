<?php

/*
 * 2SMOBILE 
 * ----------------------------------------
 *  @author     Kiwi <pathe.gueye@kiwi.sn>
 *  @copyright  2006-2015 Kiwi/2SI Group
 *  @version    2.0.0
 *  @link       http://www.kiwi.sn
 *  @link       http://www.ssi.sn
 * ----------------------------------------
 */
require_once '../../common/app.php';
require_once App::AUTOLOAD;
require_once App::MAILER;

use Parametrage\ClassePhysique as ClassePhysique;
use Parametrage\ClassePhysiqueManager as ClassePhysiqueManager;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Exceptions\ConstraintException as ConstraintException;
use Parametrage\Niveau as Niveau;
use Common\CommonManager as CommonManager;
class CommonController extends BaseAction implements BaseController {

    
    public function __construct($request) {
        $this->niveauObject = 'Parametrage\Niveau';
        $this->parameters = parse_ini_file("../../lang/trad_fr.ini");
        $this->commonManager= new CommonManager();
        try {
            if (isset($request['ACTION'])) {
                switch ($request['ACTION']) {
                    case \App::ACTION_INSERT:
                        $this->doInsert($request);
                        break;
                    case \App::ACTION_INSERT_NIVEAU:
                        $this->doInsertNiveau($request);
                        break;
                    case \App::ACTION_UPDATE:
                        $this->doUpdate($request);
                        break;
                    case \App::ACTION_UPDATE:
                        $this->doUpdateNiveau($request);
                        break;
                    case \App::ACTION_VIEW:
                        $this->doView($request);
                        break;
                    case \App::ACTION_LIST:
                        $this->doList($request);
                        break;
                    case \App::ACTION_REMOVE:
                        $this->doRemove($request);
                        break;
                    case \App::ACTION_RESTORE:
                        $this->doRestore($request);
                        break;
                    case \App::ACTION_DELETE:
                        $this->doDelete($request);
                        break;
                }
            } else
                throw new Exception($this->parameters['NO_ACTION']);
        } catch (Exception $e) {

            $this->doLogError($e->getMessage());
            $this->doError('-1', $e->getMessage());
        }
    }


    public function doView($request) {
        
    }

    public function doList($request) {
        
    }

    public function doMoveOrCopy($request) {
        
    }

    public function dofindById($request) {
        
    }

    public function doActivate($request) {
        
    }

    public function doDeactivate($request) {
        
    }

    public function doInsert($request) {
        
    }

    public function doRemove($request) {
        
    }

    public function doRestore($request) {
        
    }

    public function doUpdate($request) {
        
    }

}

$oCommonController = new CommonController($_REQUEST);
