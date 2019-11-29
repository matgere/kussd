<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Be;

/**
 * Description of BaseEntite
 *
 * @author Admin
 */
abstract class BaseEntite {
    /**
    *  * @Column(type="integer", options={"default":1})
    */
    protected $status;
      /**
     * @Column(type="integer", options={"default":1})
     */
    protected $activate;//0=desactivite
    
    /**
     * @Column(type="integer", options={"default":0})
     */
    protected $archive;
    
    /**
     * @Column(type="datetime", nullable=true)
     * */
    protected $createdDate;
    /**
     * @Column(type="datetime", nullable=true)
     * */
    protected $updatedDate;
    /**
     * @Column(type="datetime", nullable=true)
     * */
    protected $deletedDate;
    
    /**
     * @Column(type="datetime", nullable=true)
     * */
    protected $activatedDate;
    
    /**
     * @Column(type="datetime", nullable=true)
     * */
    protected $deactivatedDate;
    /**
     * @Column(type="datetime", nullable=true)
     * */
    protected $archivedDate;
     /**
     * @Column(type="datetime", nullable=true)
     * */
    protected $restoredDate;
    /**
     * @Column(type="datetime", nullable=true)
     * */
    protected $removedDate;
    /**
     * @Column(type="datetime", nullable=true)
     * */
    protected $undoArhivedDate;
    
    
    /**
     * @Column(type="integer", length=11, nullable=true)
     * */
     protected $createdBy;
     
     /**
     * @Column(type="integer", length=11, nullable=true)
     * */
     protected $updatedBy;
    /**
     * @Column(type="integer", length=11, nullable=true)
     * */
      protected $removedBy;
     /**
     * @Column(type="integer", length=11, nullable=true)
     * */
     protected $deletedBy;
    /**
     * @Column(type="integer", length=11, nullable=true)
     * */
     protected $restoredBy;
     /**
     * @Column(type="integer", length=11, nullable=true)
     * */
     protected $activatedBy;
     /**
     * @Column(type="integer", length=11, nullable=true)
     * */
     protected $deactivatedBy;
     
     /**
     * @Column(type="integer", length=11, nullable=true)
     * */
     protected $archivedBy;
     /**
     * @Column(type="integer", length=11, nullable=true)
     * */
     protected  $undoarchivedBy;
     
     public function getStatus() {
         return $this->status;
     }

     public function getActivate() {
         return $this->activate;
     }

     public function getArchive() {
         return $this->archive;
     }

     public function getCreatedDate() {
         return $this->createdDate;
     }

     public function getUpdatedDate() {
         return $this->updatedDate;
     }
     public function getRemovedDate() {
         return $this->removedDate;
     }

     public function getDeletedDate() {
         return $this->deletedDate;
     }

     public function getActivatedDate() {
         return $this->activatedDate;
     }

     public function getDeactivatedDate() {
         return $this->deactivatedDate;
     }

     public function getArchivedDate() {
         return $this->archivedDate;
     }

     public function getUndoArhivedDate() {
         return $this->undoArhivedDate;
     }

     public function getCreatedBy() {
         return $this->createdBy;
     }

     public function getUpdatedBy() {
         return $this->updatedBy;
     }

      public function getRemovedBy() {
         return $this->$removedBy;
     }
     
     public function getDeletedBy() {
         return $this->deletedBy;
     }

     public function getRestoredBy() {
         return $this->restoredBy;
     }
     
      public function getRestoredDate() {
         return $this->restoredDate;
     }

     public function getActivatedBy() {
         return $this->activatedBy;
     }

     public function getDeactivatedBy() {
         return $this->deactivatedBy;
     }

     public function getArchivedBy() {
         return $this->archivedBy;
     }

     public function getUndoarchivedBy() {
         return $this->undoarchivedBy;
     }

     public function setStatus($status) {
         $this->status = $status;
     }

     public function setActivate($activate) {
         $this->activate = $activate;
     }

     public function setArchive($archive) {
         $this->archive = $archive;
     }

     public function setCreatedDate($createdDate) {
         $this->createdDate = $createdDate;
     }

     public function setUpdatedDate($updatedDate) {
         $this->updatedDate = $updatedDate;
     }
     public function setRemovedDate($removedDate) {
         $this->removedDate = $removedDate;
     }

     public function setDeletedDate($deletedDate) {
         $this->deletedDate = $deletedDate;
     }
     public function setRestoredDate($restoredDate) {
         $this->$restoredDate = $restoredDate;
     }

     public function setActivatedDate($activatedDate) {
         $this->activatedDate = $activatedDate;
     }

     public function setDeactivatedDate($deactivatedDate) {
         $this->deactivatedDate = $deactivatedDate;
     }

     public function setArchivedDate($archivedDate) {
         $this->archivedDate = $archivedDate;
     }

     public function setUndoArhivedDate($undoArhivedDate) {
         $this->undoArhivedDate = $undoArhivedDate;
     }

     public function setCreatedBy($createdBy) {
         $this->createdBy = $createdBy;
     }

     public function setUpdatedBy($updatedBy) {
         $this->updatedBy = $updatedBy;
     }

     public function setRemovedBy($removedBy) {
         $this->$removedBy = $removedBy;
     }
     public function setDeletedBy($deletedBy) {
         $this->deletedBy = $deletedBy;
     }

     public function setRestoredBy($restoredBy) {
         $this->restoredBy = $restoredBy;
     }

     public function setActivatedBy($activatedBy) {
         $this->activatedBy = $activatedBy;
     }

     public function setDeactivatedBy($deactivatedBy) {
         $this->deactivatedBy = $deactivatedBy;
     }

     public function setArchivedBy($archivedBy) {
         $this->archivedBy = $archivedBy;
     }

     public function setUndoarchivedBy($undoarchivedBy) {
         $this->undoarchivedBy = $undoarchivedBy;
     }
     
    /** @PrePersist */
    public function doPrePersist() {
        $this->archive = 0;
        $this->activate = 1;
        $this->status = 1;
        $this->createdDate = new \DateTime("now");
    }
    
    /** @PreUpdate */
    public function doPreUpdate() {
        $this->updatedDate = new \DateTime("now");
    }
     
    
}
