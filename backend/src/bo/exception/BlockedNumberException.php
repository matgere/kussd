<?php

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

namespace Exceptions;
/**
 * Exception lancée quand le numéro est bloqué par l'utilisateur
 *
 * @author Soukeyna
 */
class BlockedNumberException extends MessageException{
    
    function __construct() {

        parent::__construct(220);
    }
}
