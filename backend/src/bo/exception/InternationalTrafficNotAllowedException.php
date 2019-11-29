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
 * Description of InternationalTrafficNotAllowed
 *
 * @author admin
 */

class InternationalTrafficNotAllowedException extends MessageException {
    
    function __construct() {

        parent::__construct(222);
    }
}
