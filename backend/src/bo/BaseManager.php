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
interface BaseManager{
    
    function insert($entity);

    function update($entity);

    function view($id);
    
    function findById($entity, $id);
    
    function remove($entity, $listId, $userId);
    
    function delete($entity, $listId, $userId);

    function restore($entity, $listId, $userId);

    function activate($entity, $listId, $userId);
    
    function deactivate($entity, $listId, $userId);
    
}
