<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Menu;

use Racine\Bootstrap as B;
use Exception;
use Common\CommonQueries;
use Racine\Bootstrap;

class MenuQueries extends \Bo\BaseAction implements \Bo\BaseQueries
{

    private $commonQueries;

    function __construct()
    {
        $this->commonQueries = new CommonQueries();
        date_default_timezone_set('GMT');
    }

    public function activate($entity, $listId, $userId = null)
    {}

    public function deactivate($entity, $listId, $userId = null)
    {}

    public function delete($entity, $listId)
    {}

    public function insert($entity, $ligneFactures = null)
    {}

    public function remove($entity, $listId, $userId = null)
    {}

    public function restore($entity, $listId, $userId = null)
    {}

    public function update($entity, $supp = null)
    {}

    public function view($id)
    {}

    public function getAllTestsByEtabId($anId, $etabId)
    {
        if ($anId != null && $etabId != null) {
            $stmt = Bootstrap::$entityManager->getConnection()->prepare("SELECT ta.id as id, ta.libelle as libelle FROM da_test ta WHERE ta.anneeScolaire_id=:anId AND ta.etablissement_id=:etabId  ");
            $stmt->execute(array(
                'etabId' => $etabId->getId(),
                'anId' => $anId->getId()
            ));
            $result = $stmt->fetchAll();
            if ($result != null)
                return $result;
            else
                return null;
        }
    }

    public function getAllTestsByNiveauId($nivId, $anId)
    {
        $this->doLogInfo('nivId=' . $nivId->getId() . ' et anId=' . $anId->getId());
        if ($anId != null && $nivId != null) {
            $stmt = Bootstrap::$entityManager->getConnection()->prepare(
                "SELECT DISTINCT(t.id ) testId, t.libelle FROM da_test t WHERE t.anneeScolaire_id=:anId
                                AND t.niveau_id=:nivId AND t.status=1");
            $stmt->execute(array(
                'nivId' => $nivId->getId(),
                'anId' => $anId->getId()
            ));
            $result = $stmt->fetchAll();
            if ($result != null) {
                $this->doLogInfo('ok');
                return $result;
            } else {
                $this->doLogInfo('no');
                return null;
            }
        }
    }

    public function getAllTestsNoCandiByNiveauId($nivId, $anId)
    {
        $this->doLogInfo('nivId=' . $nivId->getId() . ' et anId=' . $anId->getId());
        if ($anId != null && $nivId != null) {
            $stmt = Bootstrap::$entityManager->getConnection()->prepare(
                "SELECT DISTINCT(t.id ) testId, t.libelle  FROM da_test t,da_testcandidat tc WHERE  t.anneeScolaire_id=:anId
                                AND t.niveau_id=:nivId AND t.status=1 AND t.id NOT IN
(SELECT DISTINCT(t.id ) FROM da_test t, da_testcandidat tc
	WHERE  tc.testAdmis_id=t.id AND t.anneeScolaire_id=:anId
                                AND t.niveau_id=:nivId AND t.status=1 AND tc.archive=0)");
            
            //             $stmt = Bootstrap::$entityManager->getConnection()->prepare(
            //                 "SELECT DISTINCT(t.id ) testId, t.libelle  ,'0' as nbCandi FROM da_test t WHERE  t.anneeScolaire_id=:nivId
            //                                 AND t.niveau_id=:nivId AND t.status=1 AND t.id NOT IN
            // (SELECT DISTINCT(t.id ) FROM da_test t, da_testcandidat tc
            // 	WHERE  tc.testAdmis_id=t.id AND t.anneeScolaire_id=:anId
            //                                 AND t.niveau_id=:nivId AND t.status=1)UNION (SELECT ta.id testId,
            //                             ta.libelle, COUNT(tc.candidat_id) nbCandi
            //                             FROM da_test ta, da_testcandidat tc
            //                              WHERE tc.testAdmis_id=ta.id AND ta.anneeScolaire_id=:anId
            //                                 AND ta.niveau_id=:nivId AND ta.status=1 GROUP BY ta.id ORDER BY ta.sequence ASC)"
            //                 );
            
            //             SELECT ta.id testId,
            //             ta.libelle, COUNT(tc.candidat_id) nbCandi
            //             FROM da_test ta, da_testcandidat tc
            //             where tc.testAdmis_id=ta.id and ta.anneeScolaire_id=:anId
            //             and ta.niveau_id=:nivId and ta.status=1 GROUP by ta.id order by ta.sequence asc
            $stmt->execute(array(
                'nivId' => $nivId->getId(),
                'anId' => $anId->getId()
            ));
            $result = $stmt->fetchAll();
            if ($result != null) {
                $this->doLogInfo('ok');
                return $result;
            } else {
                $this->doLogInfo('no');
                return null;
            }
        }
    }
    
    public function getAllTestsCandiByNivId($nivId, $anId)
    {
        $this->doLogInfo('nivId=' . $nivId->getId() . ' et anId=' . $anId->getId());
        if ($anId != null && $nivId != null) {
            $stmt = Bootstrap::$entityManager->getConnection()->prepare(
                "SELECT ta.id testId,
                        ta.libelle, COUNT(tc.candidat_id) nbCandi
                        FROM da_test ta, da_testcandidat tc
                        where tc.testAdmis_id=ta.id and ta.anneeScolaire_id=:anId
                        and ta.niveau_id=:nivId and ta.status=1 AND tc.status=1 AND tc.archive=0 GROUP by ta.id order by ta.sequence asc");
            
            $stmt->execute(array(
                'nivId' => $nivId->getId(),
                'anId' => $anId->getId()
            ));
            $result = $stmt->fetchAll();
            if ($result != null) {
                $this->doLogInfo('ok');
                return $result;
            } else {
                $this->doLogInfo('no');
                return null;
            }
        }
    }
      public function getAllTestsCandi($test)
    {
//        $this->doLogInfo('test=' . $test->getId() . ' et candidat=' . $candidat->getId());
        if ($test != null ) {
            $stmt = Bootstrap::$entityManager->getConnection()->prepare(
                "SELECT ta.id testId,
                        ta.libelle, tc.candidat_id candidatId
                        FROM da_test ta, da_testcandidat tc, da_candidat c
                        where tc.testAdmis_id=ta.id 
                        and tc.testAdmis_id=:test and tc.candidat_id=c.id  and ta.status=1 AND tc.status=1 AND tc.archive=0");
            
            $stmt->execute(array(
                'test' => $test->getId(),
            ));
            $result = $stmt->fetchAll();
            if ($result != null) {
                $this->doLogInfo('ok');
                return $result;
            } else {
                $this->doLogInfo('no');
                return null;
            }
        }
    }
    public function getAllMenuByUser($user)
    {
        $this->doLogInfo('userId=' . $user->getId() );
        if ($user != null) {
            $stmt = Bootstrap::$entityManager->getConnection()->prepare(
                "SELECT DISTINCT(m.id), parent_id, m.name, m.title, text, type, action, methode, url, generate  FROM ud_menu m WHERE m.user_id=:user
                                AND m.status=1 AND m.generate=1 order by parent_id");
            $stmt->execute(array(
                'user' => $user->getId()
            ));
            $result = $stmt->fetchAll();
            if ($result != null) {
                $this->doLogInfo('ok');
                return $result;
            } else {
                $this->doLogInfo('no');
                return null;
            }
        }
      }
      
      public function getAllMenus(){
          $query = Bootstrap::$entityManager->createQuery("SELECT DISTINCT(m.id) menuId, m.name, m.title FROM Menu\Menu m WHERE m.user=:user
                                AND m.status=1 AND m.generate=1");
          $result = $query->getResult();
          if ($result != null)
              return $result;
              else
                  return null;
      }
      
      public function getAllParents($userId){
          if ($userId != null) {
            $stmt = Bootstrap::$entityManager->getConnection()->prepare(
                "SELECT DISTINCT(parent_id) parent_id, m.name, m.title, text, type, action, methode, url, generate FROM ud_menu m WHERE m.user_id=$userId
                                AND m.status=1 AND m.generate=1");
            $stmt->execute(array(
            ));
            $result = $stmt->fetchAll();
            if ($result != null) {
                return $result;
            } else {
                return null;
            }
        }
      }
      
      public function getAllMenuByParents($parent_id){
        if ($parent_id != null) {
            $stmt = Bootstrap::$entityManager->getConnection()->prepare(
                "SELECT DISTINCT(m.id), parent_id, m.name, m.title, text, type, action, methode, url, generate  FROM ud_menu m WHERE
                 m.status=1 AND m.generate=1 and parent_id = $parent_id");
            $stmt->execute(array(
            ));
            $result = $stmt->fetchAll();
            if ($result != null) {
                return $result;
            } else {
                return null;
            }
        }
      }

}

