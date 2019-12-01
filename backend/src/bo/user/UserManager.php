<?php

namespace User;
use User\UserQueries as UserQueries;
use User\User as User;
use Common\CommonManager as CommonManager;
use Log\Loggers as Logger;


class UserManager extends \Bo\BaseAction implements \Bo\BaseManager{
    protected $user;
    protected $userQueries;
    protected $commonManager;
    private $logger;
    
    public function __construct() {
        $this->user = new User();
        $this->userQueries = new UserQueries;
        $this->commonManager = new CommonManager;
        $this->logger = new Logger(__CLASS__);
    }

    public function signIn($login, $password) {
        $user = $this->userQueries->signin($login, $password);
        if ($user != null && $user['activate']==1) { //utilisatuer existe et clientt active 
                $rslt['rc'] = 1;
                $rslt['infos'] = $user;
                $rslt['rcSendMail'] = 0;
        }else if ($user != null && $user['activate']==0) { //utilisatuer existe et clientt active 
                $rslt['rc'] = 0;
                $rslt['infos'] = 0;
                $rslt['rcSendMail'] = 0;
        }else{
            $rslt['rc'] = -1;
            $rslt['infos'] = -1;
            $rslt['rcSendMail'] = 1;
        }
        return $rslt;  
    }

    public function activate($entity, $listId, $userId) {
        
    }

    public function deactivate($entity, $listId, $userId) {
        
    }

    public function delete($entity, $listId, $userId) {
        
    }

    public function findById($entity, $id) {
        
    }

    public function insert($entity) {
        
    }

    public function remove($entity, $listId, $userId) {
        
    }

    public function restore($entity, $listId, $userId) {
        
    }

    public function update($entity) {
        
    }

    public function view($id) {
        
    }

}
