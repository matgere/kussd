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

namespace tools;

use Log\Loggers as Logger;

class Tool {

    static function  affichageDateSpreciale($date){
           if(!ctype_digit($date))
           $date = strtotime($date);
           if(date('Ymd', $date) == date('Ymd'))
               return 'Aujourd\'hui à '.date('H:i:s', $date);
           
           else if(date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY')))
               return 'Hier à '.date('H:i:s', $date);
           
           else if(date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY')))
               return 'Avant-hier à '.date('H:i:s', $date);
           
           else
           return 'Le '.date('d/m/Y à H:i:s', $date);
              
}
}
