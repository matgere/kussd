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
/**
 * Interface 
 */
 interface BaseController{
     
    function doInsert($request);
    
    function doUpdate($request);
    
    function doRemove($request);
    
    function doView($request);
    
    function doList($request);
    
    function dofindById($request);
    
    function doRestore($request);
    
    function doActivate($request);
    
    function doDeactivate($request);
    
}
