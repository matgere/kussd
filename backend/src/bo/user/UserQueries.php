<?php

namespace User;

use Racine\Bootstrap as Bootstrap;
use Racine\Bootstrap as B;
use Log\Loggers as Logger;
use User\User as User;
use Common\CommonManager as CommonManager;

class UserQueries extends \Bo\BaseAction implements \Bo\BaseQueries {
     private $logger;
         private $commonManager;
    public function __construct() {
        $this->commonManager = new CommonManager;
        $this->logger = new Logger(__CLASS__);
        date_default_timezone_set('GMT');
    }

    public function signin($login, $password) {
        $sql = "SELECT * FROM  ud_user u WHERE  u.login='$login' and u.password='$password' and u.status=1";
       
         try {
             $stmt = B::$entityManager->getConnection()->prepare($sql);
             $stmt->execute();
             $rslt = $stmt->fetchAll();
             if(empty($rslt)){
                return null;
            }else{
                return $rslt[0];
            }
             
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage());
            throw $e;
        }
    }
    
    public function findById($userId,$supp = null) {
        return $user = $this->commonManager->findById('Cabinet\User', $userId);
    }

    public function activate($entity, $listId, $userId = null) {
        
    }

    public function deactivate($entity, $listId, $userId = null) {
        
    }

    public function delete($entity, $listId) {
        
    }

    public function insert($entity, $supp = null) {
        
    }

    public function remove($entity, $listId, $userId = null) {
        
    }

    public function restore($entity, $listId, $userId = null) {
        
    }

    public function update($entity, $supp = null) {
        
    }

    public function view($id) {
        
    }

}
