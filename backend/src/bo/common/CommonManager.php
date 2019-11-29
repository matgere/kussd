<?php

namespace Common;

/**
 * les classes utilis�es dans ce fichier.
 *
 */
//use Common\Template as Template;
use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Types\TimeType;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Entity;
use Common\CommonQueries as CommonQueries;
/*
 * 2SMOBILE 
 * ----------------------------------------
 *  @author     Kiwi <pathe.gueye@kiwi.sn>
 *  @copyright  2006-2015 Kiwi/2SI TemplateManager
 *  @version    2.0.0
 *  @link       http://www.kiwi.sn
 *  @link       http://www.ssi.sn
 * ----------------------------------------
 */
/**
 * Fait office d'intermédiaire entre le controller et les queries.
 * 
 */
use Bo\BaseAction as BaseAction;

class CommonManager extends BaseAction implements \Bo\BaseManager {

    private $commonQueries;

    public function __construct() {
        $this->commonQueries = new CommonQueries();
    }

    public function activate($entity, $listId, $userId = null) {
        return $this->commonQueries->activate($entity, $listId, $userId);
    }

    public function cancelled($entity, $listId, $userId = null) {
        return $this->commonQueries->cancelled($entity, $listId, $userId);
    }

    public function validate($entity, $listId, $userId = null) {
        return $this->commonQueries->validate($entity, $listId, $userId);
    }

    public function deactivate($entity, $listId, $userId = null) {
        return $this->commonQueries->deactivate($entity, $listId, $userId);
    }

    public function findById($entity, $entityId) {
        return $this->commonQueries->findById($entity, $entityId);
    }

    public function insert($entity, $supp = null, $ligneEntities = null) {
        return $this->commonQueries->insert($entity, $supp, $ligneEntities);
    }
    

    /**
     * remove: permet de déplacer une ligne d'une table dans corbeille en changeant le statut à 0
     * 
     * @param Entity $entityId, $listId
     *        	
     */
    public function remove($entity, $listId, $userId = null) {
        return $this->commonQueries->remove($entity, $listId, $userId);
    }

    /**
     * @author Diodio
     * remove: permet de supprimer une ligne d'une table  en changeant son statut à -1
     * 
     * @param Entity $entityId
     *        	
     */
    public function delete($entity, $listId, $userId) {
        return $this->commonQueries->delete($entity, $listId, $userId);
    }

    /**
     * @author Diodio
     * Cette methode permet de verifier si ce codes existe ou pas
     * @param type $codeType
     * @return type
     */
    public function findByCode($entity, $entityCode) {
        return $this->commonQueries->findByCode($entity, $entityCode);
    }

    /**
     * @author Diodio
     * Cette methode permet de verifier si ce codes existe ou pas
     * @param type $codeType
     * @return entity
     */
    public function findByCodeEntity($entity, $entityCode) {
        return $this->commonQueries->findByCodeEntity($entity, $entityCode);
    }

    /**
     * @author Diodio
     * Cette methode permet de verifier si ce codes existe ou pas selon un autre parametre
     * @param type $codeType
     * @return type
     */
    public function findByCodeByEntityId($entity, $entityCode, $entityId) {
        return $this->commonQueries->findByCodeByEntityId($entity, $entityCode, $entityId);
    }
   

    public function restore($entity, $listId, $userId = null) {
        return $this->commonQueries->restore($entity, $listId, $userId);
    }

    public function update($entity) {
        return $this->commonQueries->update($entity);
    }

    public function view($id) {
        return $this->commonQueries->view($id);
    }

    public function doArchive($entity, $listId, $userId = null) {
        return $this->commonQueries->doArchive($entity, $listId, $userId);
    }

    public function undoArchive($entity, $listId, $userId = null) {
        return $this->commonQueries->undoArchive($entity, $listId, $userId);
    }

    public function isExistEmailByEtablissement($entity, $email, $etablissementId) {
        return $this->commonQueries->isExistEmailByEtablissement($entity, $email, $etablissementId);
    }

    public function isExistNumberPhoneByEtablissement($entity, $telephone, $etablissementId) {
        return $this->commonQueries->isExistNumberPhoneByEtablissement($entity, $telephone, $etablissementId);
    }

    public function findAllEntitiesArchivesByEtablissement($entity, $etablissementId) {
        return $this->commonQueries->findAllEntitiesArchivesByEtablissement($entity, $etablissementId);
    }

    public function findAllEntitiesNonArchivesByEtablissement($entity, $etablissementId) {
        return $this->commonQueries->findAllEntitiesNonArchivesByEtablissement($entity, $etablissementId);
    }

    public function findByCodeAndEtablissement($entity, $entityCode, $etablissementId) {
        return $this->commonQueries->findByCodeAndEtablissement($entity, $entityCode, $etablissementId);
    }

    public function codeGenerator($libelle) {
        return $this->commonQueries->codeGenerator($libelle);
    }

    public function getLasId($entity) {
        return $this->commonQueries->getLasId($entity);
    }

    public function revokePersonnelAssociation($entity, $anneeScolaireId, $classProfOrclasseSurvOrmatiereProfId) {
        return $this->commonQueries->revokeAssociation($entity, $anneeScolaireId, $classProfOrclasseSurvOrmatiereProfId);
    }

    public function revoke($entity, $id) {
        return $this->commonQueries->revoke($entity, $id);
    }

    public function getEntitiesByEtabAndLib($entity, $libelle, $etablissementId) {
        return $this->commonQueries->getEntitiesByEtabAndLib($entity, $libelle, $etablissementId);
    }

    public function getLastId($entity) {
        $maxId = $this->commonQueries->getLasId($entity);
        if ($maxId != null) {
            foreach ($maxId as $maxid) {
                $idMax = $maxid;
            }
            return $idMax[1];
        }
        return null;
    }

    public function findEtablissementByCode($entity, $entityCode) {
        return $this->commonQueries->findEtablissementByCode($entity, $entityCode);
    }
    
   

}
