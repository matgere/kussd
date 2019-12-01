<?php


namespace User;

require_once '../../common/app.php';
use Log\Loggers as Logger;
use Exceptions\ConstraintException as ConstraintException;
use User\UserManager as UserManager;
//use Cabinet\ProfilManager as ProfilManager;
use User\User as User;


class UserController extends \Bo\BaseAction implements \Bo\BaseController {

    private $logger;
    private $userManager;
    private $parameters;
    public function __construct($request) {
        $this->logger = new Logger(__CLASS__);
        $this->userManager = new UserManager();
       $this->parameters =  dirname(dirname(dirname(__FILE__))) . '/lang/trad_fr.ini';
        try {
            if (isset($request['ACTION'])) {
                switch ($request['ACTION']) {
//                    case \App::ACTION_GET_SESSION:
//                        $this->doGetSession($request);
//                        break;
                    case \App::ACTION_SIGN_IN:
                        $this->doSignin($request);
                        break;
                    case \App::ACTION_SIGNOUT:
                        $this->doSignout($request);
                        break;
                    case \App::ACTION_GET_SESSION:
                        $this->doGetSession($request);
                        break;
                }
            } else
                throw new Exception("NO_ACTION'");
        } catch (Exception $e) {
            $logger = new Logger(__CLASS__);
            $logger->log->trace($e->getMessage());
            $this->doError('-1', $e->getMessage());
        }
    }

   

    public function doSignin($request) {
        $logger = new Logger(__CLASS__);
        try {
            if (isset($request['ACTION']) && isset($request['login']) && isset($request['password'])) {
                try {
                    $user = $this->userManager->signin($request['login'], $request['password']);
                    $this->doSuccessO($user);
                } catch (Exception $e) {
                    $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
                    $this->doError('-1', $e->getMessage());
                } catch (Exception $e) {
                    $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
                    $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
                }
            } else {
                throw new \Exception($this->parameters['INVALID_DATA']);
            }
        } catch (\Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (\Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
//            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }

    
    public function doView($request) {
        $logger = new Logger(__CLASS__);

        try {
            if (isset($request['userid'])) {
                $this->userManager = new userManager();
                $user = $this->userManager->view($request['userid']);
                if ($user != NULL) {
                    $this->doSuccessO($user);
                } else {
                    echo json_encode(array());
                }
            } else {
                $logger->log->error('View : Invalid Data');
                throw new ConstraintException($this->parameters['INVALID_DATA']);
            }
        } catch (ConstraintException $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    public function doListProfil($request) {
        $profilManager = new ProfilManager();
        $listProfils = $profilManager->findAll();
//        echo json_encode($listProfils);
         $this->doSuccessO($listProfils);
        
    }
    
    
    public function doInsert($request) {
        $logger = new Logger(__CLASS__);
        try {
            $logger->log->trace("Debut insertion user");
            if (isset($request['ACTION']) && isset($request['customerId']) && isset($request['contactName']) && isset($request['login']) && isset($request['password']) && isset($request['description'])) {
                $customerId = $request['customerId'];
                $contactName = $request['contactName'];
                $login = $request['login'];
                $password = md5($request['password']);
                $description = $request['description'];
                $email = $request['email'];
                $profil = $request['profil']; // profil utilisateur simple par defaut
                if ($customerId != "" && $contactName != "" && $login != "" && $password != "" && $description != "" && $profil != "") {
                    $userManager = new UserManager();
                    $customerManager = new CabinetManager();
                    $user = new User();
                    $customer = $customerManager->findById($customerId);
                    $user->setCabinet($customer);
//                    $user->setLanguage($customer->getLanguage());
                    $user->setPartner($customer->getPartner());
                    $user->setContactName($contactName);
                    $user->setLogin($login);
                    $user->setPassword($password);
                    $user->setDescription($description);
                    $user->setContactEmail($email);
                    $profilManager = new ProfilManager();
                    $objectProfil = $profilManager->findById($profil);
                    $user->setProfil($objectProfil);
                    $user->setStatus(1);
                    $user->setActivate(1);
                    $userManager->create($user);
                    if ($user->getId() != null) {
                        $this->doSuccess($user->getId(), $this->parameters['SAV']);
                        $concat = $customerId . '-' . $contactName . '-' . $login . '-' . $password . '-' . $description . '-' . $profil;
                        $this->logger->log->info($concat);
                    } else {
                        $this->logger->log->error('User already exists or in trash');
                        throw new Exception($this->parameters['USER_ALREADY_EXISTS']);
                    }
                }
            } else {
                $this->logger->log->error('List : Params not enough');
                throw new Exception($this->parameters['AJOUT_USER_IMPOSSIBLE']);
            }
            $logger->log->trace("Fin insertion user");
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    
    
    
    
    
    
       public function doUpdate($request) {
        $logger = new Logger(__CLASS__);
        try {
            $logger->log->trace("Debut insertion user");
            if (isset($request['ACTION']) && isset($request['customerId']) && isset($request['contactName']) && isset($request['login']) && isset($request['password']) && isset($request['description'])) {
                $customerId = $request['customerId'];
                $contactName = $request['contactName'];
                $login = $request['login'];
                $password = md5($request['password']);
                $description = $request['description'];
                $email = $request['email'];
                $profil = $request['profil']; // profil utilisateur simple par defaut
                if ($customerId != "" && $contactName != "" && $login != "" && $password != "" && $description != "" && $profil != "") {
                    $userManager = new UserManager();
                    $customerManager = new CabinetManager();
                    $user = new User();
                    $customer = $customerManager->findById($customerId);
                    $user->setId($request['id']);
                    $user->setCabinet($customer);
//                    $user->setLanguage($customer->getLanguage());
                    $user->setPartner($customer->getPartner());
                    $user->setContactName($contactName);
                    $user->setLogin($login);
                    $user->setPassword($password);
                    $user->setDescription($description);
                    $user->setContactEmail($email);
                    $profilManager = new ProfilManager();
                    $objectProfil = $profilManager->findById($profil);
                    $user->setProfil($objectProfil);
                    $user->setStatus(1);
                    $user->setActivate(1);
                    $us = $this->userManager->update($user, $supp = null);
                    $this->doSuccess($us, "Modification effectue avec succes");
                    
                }
            } else {
                $this->logger->log->error('List : Params not enough');
                throw new Exception("Impossible d'effectuer cette modification");
            }
            $logger->log->trace("Fin mis a jour user");
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }

   
    public function doList($request) {
        $this->logger->log->info('Action List user');
        $this->logger->log->info(json_encode($request));
        try {
            $userManager = new UserManager();
            if (isset($request['customerId']) && isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                $customerId = $request['customerId'];
                $partnerId = $request['partnerId'];
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('u.id','contactName', 'description', 'login','p.intitule','activate');
                if (isset($request['iSortCol_0'])) {
                    $sOrder = "ORDER BY  ";
                    for ($i = 0; $i < intval($request['iSortingCols']); $i++) {
                        if ($request['bSortable_' . intval($request['iSortCol_' . $i])] == "true") {
                            $sOrder .= "" . $aColumns[intval($request['iSortCol_' . $i])] . " " .
                                    ($request['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                        }
                    }

                    $sOrder = substr_replace($sOrder, "", -2);
                    if ($sOrder == "ORDER BY") {
                        $sOrder .= " u.createdDate desc ";
                    }
                }
                // End order from DataTable
                // Begin filter from dataTable
                $sWhere = "";
                if (isset($request['sSearch']) && $request['sSearch'] != "") {
                    $sSearchs = explode(" ", $request['sSearch']);
                    for ($j = 0; $j < count($sSearchs); $j++) {
                        $sWhere .= " AND (";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . ($sSearchs[$j]) . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                        $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $users = $userManager->listUsers($customerId, $partnerId,$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($users != null) {
                    $nbUsers = $userManager->count($customerId, $partnerId,$sWhere);
                    $this->logger->log->info($nbUsers . 'users retrieved');
                    $this->doSuccessO($this->dataTableFormat($users, $request['sEcho'], $nbUsers));
                } else {
                    $this->doSuccessO($this->dataTableFormat(array(), $request['sEcho'], 0));
                }
            } else {
                $this->logger->log->error('List : Params not enough');
                throw new Exception('Params not enough');
            }
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    public function doActiver($request) {
        $this->logger->log->info('Action Activate user');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['userIds'])) {
                $this->logger->log->info('activer with params : ' . $request['userIds']);
                $userIds = $request['userIds'];
                $userManager = new UserManager();
                $nbModified = $userManager->activate($userIds);
                $this->doSuccess($nbModified, "Utilisateurs desactive(s) avec succes.");
            } else {
                $this->logger->log->error('Activate : Params not enough');
                $this->doError('-1', $this->parameters['USER_NOT_ACTIVATED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    
    public function doDesactiver($request) {
        $this->logger->log->info('Action deactivate user');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['userIds'])) {
                $this->logger->log->info('Desactiver with params : ' . $request['userIds']);
                $userIds = $request['userIds'];
                $userManager = new UserManager();
                $nbModified = $userManager->deactivate($userIds);
                $this->doSuccess($nbModified, "Utilisateurs desactive(s) avec succes.");
            } else {
                $this->logger->log->error('Desactiver : Params not enough');
                $this->doError('-1', $this->parameters['USER_NOT_DEACTIVATED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doRemove($request) {
        
    }

//    public function doUpdate($request) {
//        
//    }

    public function dofindById($request) {
        
    }

    public function doGetInfos($request) {
        $logger = new Logger(__CLASS__);
        try {
            if (isset($request['userId'])) {
                $this->userManager = new UserManager();
                $infosUser = $this->userManager->getInfos($request['userId']);
                if ($infosUser != NULL) {
                    $this->doSuccessO(($infosUser));
                } else {
                    echo json_encode(array());
                }
            } else {
                $logger->log->error('List : Invalid Data');
                throw new ConstraintException($this->parameters['INVALID_DATA']);
            }
        } catch (ConstraintException $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }
    
        public function doSignout($request) {
        $logger = new Logger(__CLASS__);
        $logger->log->trace('Signout');
        $this->action = "DECONNEXION : Tentative de déconnexion sur le portail";
        $this->details = "";

        if (isset($request['ACTION']) && $request['ACTION'] == 'SIGNOUT') {
            $past = time() - 3600;
            \Common\Common::unsetCookie();
            $logger->log->trace('Fin Signout');
        } else {
            echo '0';
        }
    }

    public function doActivate($request) {
        
    }

    public function doDeactivate($request) {
        
    }

    public function doRestore($request) {
        
    }
    
    public function doGetSession($request) {
        $logger = new Logger(__CLASS__);

        try {
            if (isset($request['ACTION'])) {
                if (!isset($_COOKIE['userId']) || !isset($_COOKIE['cabinetId']) ) {
                    $this->doSuccessO(0);
                } else {
                    $this->doSuccessO(1);
                }
            } else {
                $logger->log->error('Name : Invalid Data');
                throw new ConstraintException($this->parameters['INVALID_DATA']);
            }
        } catch (ConstraintException $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }

//put your code here
}
$oUserController = new UserController($_REQUEST);
