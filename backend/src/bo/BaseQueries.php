<?php

namespace Bo;

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
interface BaseQueries{

    function insert($entity,  $ligneFactures=null) ;

    function update($entity, $supp = null);
    
    
    function view($id);

    function remove($entity, $listId, $userId = null);
    
    function delete($entity, $listId);

    function restore($entity, $listId, $userId = null);

    function activate($entity, $listId, $userId = null);
    
    function deactivate($entity, $listId, $userId = null);
    
}