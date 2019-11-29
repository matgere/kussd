<?php

namespace Common;

/**
 * les classes utilis�es dans ce fichier.
 */
use Bo\BaseAction as BaseAction;
use Doctrine\ORM\Mapping\Entity;
use Racine\Bootstrap;
use Exception;
use Exceptions\ConstraintException as ConstraintException;

class CommonQueries extends BaseAction implements \Bo\BaseQueries {

    protected $entityManager;

    public function __construct() {
        date_default_timezone_set('GMT');
    }

    public function insert($entity, $supp = null, $listEntities = null) {
        $this->doLogInfo('Debut insertion');
        Bootstrap::$entityManager->getConnection()->beginTransaction();
//         var_dump($entity);
        if ($entity != null) {
            try {
                Bootstrap::$entityManager->persist($entity);
                if ($supp !== null) {
                    $this->doLogInfo('Debut autre insertion');
                    Bootstrap::$entityManager->persist($supp);
                }
               $i=0;
               $entityAddP=null;
//                $this->doLogInfo($listEntities.' listEntities');
                if ($listEntities != null || $listEntities!='') {
                    foreach ($listEntities as $entityAdd) {
//                         $i++;
                        $entityAddP= Bootstrap::$entityManager->persist($entityAdd);
//                         if($i==2)
//                             throw new Exception('Erreur insertion');
                    }
                    Bootstrap::$entityManager->flush();
//                     Bootstrap::$entityManager->getConnection()->commit();
                }
                else{
                    Bootstrap::$entityManager->flush();
                }
                Bootstrap::$entityManager->getConnection()->commit();
                $this->doLogInfo('Fin insertion');
                $this->doLogInfo('Id genere: '. $entity->getId());
                return $entity;
            } catch (\Exception $e) {
                $this->doLogError($e->getMessage());
                $this->doLogError('Fin insertion');
                Bootstrap::$entityManager->getConnection()->rollback();
                Bootstrap::$entityManager->close();
                $b = new Bootstrap();
                Bootstrap::$entityManager = $b->getEntityManager();
                return null;
            }
        }
    }

    public function update($entity, $supp = null) {
        $this->doLogInfo('Debut update');
        Bootstrap::$entityManager->getConnection()->beginTransaction();
        if ($entity != null) {
            try {
                Bootstrap::$entityManager->merge($entity);
                Bootstrap::$entityManager->flush();
                if ($supp !== null) {
                    $this->doLogInfo('Debut autre update');
                    Bootstrap::$entityManager->merge($supp);
                    Bootstrap::$entityManager->flush();
                }
                Bootstrap::$entityManager->getConnection()->commit();
                $this->doLogInfo('Fin update: succes');
                return $entity;
            } catch (\Exception $e) {
                $this->doLogError($e->getMessage());
                $this->doLogInfo('Fin update: echec');
                Bootstrap::$entityManager->getConnection()->rollback();
                Bootstrap::$entityManager->close();
                $b = new Bootstrap();
                Bootstrap::$entityManager = $b->getEntityManager();
                return null;
            }
        }
    }

    /**
     * remove: permet de déplacer une ligne d'une table corbeille en changeant le statut à 0
     * 
     * @param Entity $entityId, $listId
     *        	
     */
    public function remove($entity, $listId, $userId = null) {
        $this->doLogInfo('Debut suppression');
        $q = '';
        if ($userId != null)
            $q = ',e.removedBy=' . $userId;
        try {
            $dql = 'update ' . $entity . ' e set e.status=0 ,e.removedDate=CURRENT_TIMESTAMP()' . $q . ' WHERE e.id in (' . $listId . ') and e.status=1';
            $query = Bootstrap::$entityManager->createQuery($dql);
            $rslt = $query->getResult();
            $this->doLogInfo('Fin suppression');
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            $this->doLogError('Fin suppression');
            return -1;
            //throw $ex;
        }
    }

    /**
     * @author Diodio
     * remove: permet de supprimer définitivement une ligne d'une table 
     * 
     * @param $entityId, $listId
     *        	
     */
    public function delete($entity, $listId, $userId = null) {
        $this->doLogInfo('Debut suppression');
        $q = '';
        if ($userId != null)
            $q = ',e.deletedBy=' . $userId;
        try {
//            $dql = 'DELETE FROM '.$entity.' e WHERE e.id in (' . $listId.') AND e.status=0';
            $dql = 'update ' . $entity . ' e set e.status=-1 ,e.deletedDate=CURRENT_TIMESTAMP()' . $q . ' WHERE e.id in (' . $listId . ') and e.status=0';
            $query = Bootstrap::$entityManager->createQuery($dql);
            $rslt = $query->getResult();
            $this->doLogInfo('Fin suppression');
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            $this->doLogError('Fin suppression');
            return -1;
            //throw $ex;
        }
    }

    /**
     * @author Diodio
     * remove: permet de rechercher une entity par son code 
     * 
     * @param $entity, $entityCode
     *        	
     */
    public function findByCode($entity, $entityCode) {
        if ($entityCode != null) {
            $query = Bootstrap::$entityManager->createQuery("select e.id,e.code from '$entity' e where e.code=:entityCode");
            $query->setParameter('entityCode', $entityCode);
            $result = $query->getResult();
            if ($result != null)
                return $result[0];
            else
                return null;
        }
    }

    /**
     * @author Momar
     * remove: permet de rechercher un etablissement par son code 
     * 
     * @param $entity, $entityCode
     *        	
     */
    public function findEtablissementByCode($entity, $entityCode) {

        try {
            $etablissementRepository = Bootstrap::$entityManager->getRepository($entity);
            $etablissement = $etablissementRepository->findOneBy([
                'code' => $entityCode,
                'status' => 1,
            ]);

            if ($etablissement != null) {
                return $etablissement;
            } else {
                return null;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @author Momar
     * remove: permet de rechercher une entity par son code  et son etablissement
     * 
     * @param $entity, $entityCode,$etablissementId
     *        	
     */
    public function findByCodeAndEtablissement($entity, $entityCode, $etablissementId) {
        if ($entityCode != null) {
            $query = Bootstrap::$entityManager->createQuery("select e from '$entity' e where e.code=:entityCode and e.etablissement=:etablissementId");
            $query->setParameter('entityCode', $entityCode);
            $query->setParameter('etablissementId', $etablissementId);
            $result = $query->getResult();
            if ($result != null)
                return $result[0];
            else
                return null;
        }
    }

    /**
     * @author Diodio
     * remove: permet de rechercher une entity par son code 
     * 
     * @param $entity, $entityCode
     *        	
     */
    public function restore($entity, $listId, $userId = null) {
        $this->doLogInfo('Debut restauration');
        $q = '';
        if ($userId != null)
            $q = ',e.restoredBy=' . $userId;
        try {
            $dql = 'update ' . $entity . ' e set e.status=1 ,e.restoredDate=CURRENT_TIMESTAMP()' . $q . ' WHERE e.id in (' . $listId . ') and e.status=0';
            $query = Bootstrap::$entityManager->createQuery($dql);
            $rslt = $query->getResult();
            $this->doLogInfo('Fin restauration');
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            $this->doLogError('Fin restauration');
            return -1;
            //throw $ex;
        }
    }

    public function findAll() {
        $entityRepository = Bootstrap::$entityManager->getRepository($entity);
        $listtemplate = $entityRepository->findAll();
        return $listtemplate;
    }

    public function findById($entity, $entityId) {
        if ($entityId != null) {
            return Bootstrap::$entityManager->find($entity, $entityId);
        }
    }

    /**
     * @author Diodio MBODJ
     * Cette fonction permet de rechercher une entitt� � travers le code
     * @param $entity, $entityCode
     * 
     * @return Entity
     */
    public function findByCodeEntity($entity, $entityCode) {
        $criteria = array(
            'status' => 1,
            'code' => $entityCode
        );
        $entityRepository = Bootstrap::$entityManager->getRepository($entity);
        $entities = $entityRepository->findBy($criteria);
        if (count($entities) != 0) {
            return $entities [0];
        }
        return null;
    }

    public function view($id) {
        
    }

    public function activate($entity, $listId, $userId = null) {//$entity=namePackage\nameClass
        $this->doLogInfo('Debut activation');
        $q = '';
        if ($userId != null)
            $q = ',e.activatedBy=' . $userId;
        try {
            $dql = 'update ' . $entity . ' e set e.activate=1 ,e.activatedDate=CURRENT_TIMESTAMP() ' . $q . ' WHERE e.id in (' . $listId . ') and e.activate=0 and e.status=1';
            $query = Bootstrap::$entityManager->createQuery($dql);
            $rslt = $query->getResult();
            $this->doLogInfo('Fin activation');
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            $this->doLogError('Fin activation');
            return -1;
            //throw $ex;
        }
    }

    public function deactivate($entity, $listId, $userId = null) {
        $this->doLogInfo('Debut desactivation');
        $q = '';
        if ($userId != null)
            $q = ',e.deactivatedBy=' . $userId;
        try {
            $dql = 'update ' . $entity . ' e  set e.activate=0 ,e.deactivatedDate=CURRENT_TIMESTAMP() ' . $q . ' WHERE e.id in (' . $listId . ') and e.activate=1 and e.status=1';
            $query = Bootstrap::$entityManager->createQuery($dql);
            $rslt = $query->getResult();
            $this->doLogInfo('Fin desactivation');
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            $this->doLogError('Fin desactivation');
            return -1;
            //throw $ex;
        }
    }

    public function doArchive($entity, $listId, $userId = null) {
        $this->doLogInfo('Debut archivage');
        $q = '';
        if ($userId != null)
            $q = ',e.archivedBy=' . $userId;
        try {
            $dql = 'update ' . $entity . ' e set e.archive=1 ,e.archivedDate=CURRENT_TIMESTAMP() ' . $q . ' WHERE e.id in (' . $listId . ') and e.archive=0 and e.status=1';
            $query = Bootstrap::$entityManager->createQuery($dql);
            $rslt = $query->getResult();
            $this->doLogInfo('Fin archivage');
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            $this->doLogError('Fin archivage');
            return -1;
            //throw $ex;
        }
    }

    public function undoArchive($entity, $listId, $userId = null) {
        $this->doLogInfo('Debut desarchivage');
        $q = '';
        if ($userId != null)
            $q = ',e.undoarchivedBy=' . $userId;
        try {
            $dql = 'update ' . $entity . ' e set e.archive=0 ,e.undoArhivedDate=CURRENT_TIMESTAMP() ' . $q . ' WHERE e.id in (' . $listId . ') and e.archive=1 and e.status=1';
            $query = Bootstrap::$entityManager->createQuery($dql);
            $rslt = $query->getResult();
            $this->doLogInfo('Fin desarchivage');
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            $this->doLogError('Fin desarchivage');
            return -1;
            //throw $ex;
        }
    }

    /**
     * @author Diodio MBODJ
     * Cette fonction permet de tester si l'email donné en parametre esxiste ou pas selon etablissement
     * @param 
     * @param 
     * @return null
     */
    public function isExistEmailByEtablissement($entity, $email, $etablissementId) {
        $query = Bootstrap::$entityManager->createQuery("select e.email from '$entity' e where e.email = :email and e.etablissement=:etablissementId");
        $query->setParameter('email', $email);
        $query->setParameter('etablissementId', $etablissementId);
        $result = $query->getResult();
        if ($result != null)
            return $result[0];
        else
            return null;
    }

    /**
     * @author Diodio MBODJ
     * Cette fonction permet de tester si le numero de telephone donné en parametre esxiste ou pas selon etablissement
     * @param 
     * @param 
     * @return null
     */
    public function isExistNumberPhoneByEtablissement($entity, $telephone, $etablissementId) {
        $query = Bootstrap::$entityManager->createQuery("select e.telephone from '$entity' e where e.telephone = :telephone and e.etablissement=:etablissementId");
        $query->setParameter('telephone', $telephone);
        $query->setParameter('etablissementId', $etablissementId);
        $result = $query->getResult();
        if ($result != null)
            return $result[0];
        else
            return null;
    }
    

    /**
     * @author Momar
     * Cette fonction retourn une liste d'entite archive dans unn etablissement
     * @param $entity,$etablissementId
     */
    public function findAllEntitiesArchivesByEtablissement($entity, $etablissementId) {
        $query = Bootstrap::$entityManager->createQuery("select e.id, e.nom, e.prenom, e.dateNaissance, e.lieuDeNaissance, e.genre, e.email, e.adresse, e.telephone, e.archivedDate from '$entity' e where e.etablissement=:etablissementId and e.status=1 and e.archive=1");
        $query->setParameter('etablissementId', $etablissementId);
        $result = $query->getResult();
        if ($result != null)
            return $result;
        else
            return null;
    }

    /**
     * @author Momar
     * Cette fonction retourn une liste d'entite non archive dans unn etablissement
     * @param $entity,$etablissementId
     */
    public function findAllEntitiesNonArchivesByEtablissement($entity, $etablissementId) {
        $query = Bootstrap::$entityManager->createQuery("select e.id, e.nom, e.prenom, e.dateNaissance, e.lieuDeNaissance, e.genre, e.email, e.adresse, e.telephone, e.archivedDate from '$entity' e where e.etablissement=:etablissementId and e.status=1 and e.archive=0");
        $query->setParameter('etablissementId', $etablissementId);
        $result = $query->getResult();
        if ($result != null)
            return $result;
        else
            return null;
    }

    /**
     * @author Momar
     * Cette fonction genere un code 
     * @param $libelle
     */
    public function codeGenerator($libelle) {
        $tablibelle = explode(" ", $libelle);
        $code = "";
        for ($i = 0; $i < count($tablibelle); $i++) {
            $code = $code . substr($tablibelle[$i], 0, 3);
        }
        return $code;
    }

    public function getLasId($entity) {
        $query = Bootstrap::$entityManager->createQuery("select MAX(e.id)  from '$entity' e where e.status=1");
        $result = $query->getResult();
        if ($result != null)
            return $result;
        else
            return null;
    }

    /**
     * @author Momar
     * remove: permet de supprimer définitivement une ligne d'une table 
     * 
     * @param $entityId, $anneeScolaire,$classProfOrclasseSurvOrmatiereProfId
     *        	
     */
    public function revokeAssociation($entity, $anneeScolaireId, $classProfOrclasseSurvOrmatiereProfId) {
        if (preg_match("/CLASSEPROF/i", $entity)) {
            $sql = "DELETE  FROM '$entity' e "
                    . " where e.status=1 and e.anneeScolaire=:anneeSolaireId and e.id in(:classeProfId)";
            $query = Bootstrap::$entityManager->createQuery($sql);
            $query->setParameter('anneeSolaireId', $anneeScolaireId);
            $query->setParameter('classeProfId', $classProfOrclasseSurvOrmatiereProfId);
        }

        if (preg_match("/CLASSESURVEILLANT/i", $entity)) {
            $sql = "DELETE  FROM '$entity' e "
                    . " where e.status=1 and e.anneeScolaire=:anneeSolaireId and e.id in (:classeSurveillantId)";
            $query = Bootstrap::$entityManager->createQuery($sql);
            $query->setParameter('anneeSolaireId', $anneeScolaireId);
            $query->setParameter('classeSurveillantId', $classProfOrclasseSurvOrmatiereProfId);
        }
        if (preg_match("/MATIEREPROF/i", $entity)) {
            $sql = "DELETE  FROM '$entity' e "
                    . " where e.status=1 and e.anneeScolaire=:anneeSolaireId and e.id in (:matiereProfId) ";
            $query = Bootstrap::$entityManager->createQuery($sql);
            $query->setParameter('anneeSolaireId', $anneeScolaireId);
            $query->setParameter('matiereProfId', $classProfOrclasseSurvOrmatiereProfId);
        }
        $result = $query->getResult();
        if ($result != null)
            return $result;
        else
            return null;
    }

    /**
     * @author Diodio
     * remove: permet de supprimer définitivement une ligne d'une table 
     * 
     * @param $entityId, $listId
     *        	
     */
    public function revoke($entity, $id) {
        try {
            $sql = "DELETE  FROM $entity e where e.id=:id and e.status=1";
            $query = Bootstrap::$entityManager->createQuery($sql);
            $query->setParameter('id', $id);
            $rslt = $query->getResult();
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            return null;
        }
    }

    public function getEntitiesByEtabAndLib($entity, $libelle, $etablissementId) {
        $sql = "SELECT e.id  FROM $entity e WHERE e.etablissement=:etablissementId and e.libelle=:libelle ";
        $query = Bootstrap::$entityManager->createQuery($sql);
        $query->setParameter('etablissementId', $etablissementId);
        $query->setParameter('libelle', $libelle);
        $result = $query->getResult();
        if ($result != null)
            return $result;
        else
            return null;
    }

    /**
     * @author DIODIO

     * validate: permet de valider une facture en changeant le validate � 1
     *
     * @param Entity $entityId, $listId
     *
     */
    public function validate($entity, $listId, $userId = null) {
        $this->doLogInfo('Debut validation');
        $q = '';
        if ($userId != null)
            $q = ',e.validatedBy=' . $userId;
        try {
            $dql = 'update ' . $entity . ' e set e.validated=1 ,e.validatedDate=CURRENT_TIMESTAMP()' . $q . ' WHERE e.id in (' . $listId . ') and e.validated=0';
            $query = Bootstrap::$entityManager->createQuery($dql);
            $rslt = $query->getResult();
            $this->doLogInfo('Fin validation');
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            $this->doLogError('Fin validation');
            return -1;
            //throw $ex;
        }
    }

    /**
     * @author DIODIO

     * cancelled: permet d'annuler une facture en changeant le cancelled � 1
     *
     * @param Entity $entityId, $listId
     *
     */
    public function cancelled($entity, $listId, $userId = null) {
        $this->doLogInfo('Debut annulation');
        $q = '';
        if ($userId != null)
            $q = ',e.cancelledBy=' . $userId;
        try {
            $dql = 'update ' . $entity . ' e set e.cancelled=1 ,e.cancelledDate=CURRENT_TIMESTAMP()' . $q . ' WHERE e.id in (' . $listId . ') and e.cancelled=0 and e.validate=0';
            $query = Bootstrap::$entityManager->createQuery($dql);
            $rslt = $query->getResult();
            $this->doLogInfo('Fin annulation');
            return $rslt;
        } catch (\Exception $ex) {
            $this->doLogError($ex->getMessage());
            $this->doLogError('Fin annulation');
            return -1;
        }
    }

}

//$CommonQueries = new CommonQueries($_REQUEST);
