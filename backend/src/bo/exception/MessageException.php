<?php
namespace Exceptions;
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
 * Classe mere des classes d'exception qui retournent un message correspondant a un code
 *
 * @author ssi
 */
class MessageException extends \Exception{
    /**
     * le code de l'exception
     */
    protected $code;
    
    function __construct($code=null) {
        $this->code=$code;
        parent::__construct(parent::getMessage(), $code, NULL);
    }

    /** redéfinir la methode getMessage de \Exception
     * Elle retourne le statut correspondant au code d'exception
     * @return type
     */
    
    public final function getMessages(){
        // Localiser le statut correspondant au code
        return "message";
    }
    
}
