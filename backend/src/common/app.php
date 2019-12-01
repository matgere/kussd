<?php

/*
 * USSS_ 
 * ----------------------------------------
 *  @author     Kiwi <pathe.gueye@kiwi.sn>
 *  @copyright  2006-2015 Kiwi/2SI Group
 *  @version    2.0.0
 *  @link       http://www.kiwi.sn
 *  @link       http://www.ssi.sn
 * ----------------------------------------
 */
if (is_file('lib/doctrine/vendor/autoload.php')) {
    require_once 'lib/doctrine/vendor/autoload.php';
} else if (is_file('../lib/doctrine/vendor/autoload.php')) {
    require_once '../lib/doctrine/vendor/autoload.php';
} else if (is_file('../../lib/doctrine/vendor/autoload.php')) {
    require_once '../../lib/doctrine/vendor/autoload.php';
} else if (is_file('../../../lib/doctrine/vendor/autoload.php')) {
    require_once '../../../lib/doctrine/vendor/autoload.php';
} else if (is_file('../../../../lib/doctrine/vendor/autoload.php')) {
    require_once '../../../../lib/doctrine/vendor/autoload.php';
}



class App {

    const APP_ROOT = 'websms';
    const BO = 'src/bo';
    const ACTION_VIEWPLUS = 'VIEWPLUS';
    const FILE_PARAMETERS = "config/parameters.ini";
    const FILE_PARAMETERS_IN_PROCESSINGMANAGER = "../../../../portail/config/parameters.ini";
    const LANG = "../../lang";
    const AS_LANG = "../../../lang";
    const I18N_CLASS = "../../../lib/i18n/class/l18n.class.php";
    const AS_I18N_CLASS = "../../../../lib/i18n/class/l18n.class.php";
    const AUTOLOAD = "../../../../lib/doctrine/vendor/autoload.php";
    const MAILER = "../../../../lib/mail/class.phpmailer.php";
    const XLSXCLASS = "../../../../lib/pexcel/simplexlsx.class.php";
    const EXCELREADER = "../../../../lib/pexcel/excel_reader.php";
    const UPLOADFILE = "../../../../upload/";
    const UPLOAD_DIR="../../upload/";

    // Application actions
    const ACTION_GET_SESSION='GET_SESSION';
     const ACTION_SIGN_IN='SIGN_IN';
     const ACTION_UPDATE='UPDATE';
     const ACTION_INSERT='INSERT';
     const ACTION_INSERT_FILE='INSERT_FILE';
     const ACTION_UPDATE_NIVEAU='UPDATE_NIVEAU';
     const ACTION_REMOVE='REMOVE';
     const ACTION_ACCES = 'ACCES';
     const ACTION_ACTIVER = 'ACTIVER';
     const ACTION_CANCELLED = 'CANCELLED';
     const ACTION_VALIDATE = 'VALIDATE';
     const ACTION_DESACTIVER = 'DESACTIVER';
     const ACTION_DELETE = 'DELETE';
     const ACTION_RESTORE = 'RESTORE';
     const ACTION_LIST='LIST';
     const ACTION_GENERATE_MENU="GENERATE_MENU";
     const ACTION_GET_ALL_MENU_BY_USER="GET_ALL_MENU_BY_USER";



//push
    static function getBoPath() {
        if (is_file('config/parameters.ini')) {
            $parameters = parse_ini_file("config/parameters.ini");
            return $parameters['backend'] . '/src/bo';
        } else if (is_file('../config/parameters.ini')) {
            $parameters = parse_ini_file("../config/parameters.ini");
            return $parameters['backend'] . '/src/bo';
        } else if (is_file('../../config/parameters.ini')) {
            $parameters = parse_ini_file("../../config/parameters.ini");
            return $parameters['backend'] . '/src/bo';
        } else if (is_file('../../../config/parameters.ini')) {
            $parameters = parse_ini_file("../../../config/parameters.ini");
            return $parameters['backend'] . '/src/bo';
        } else if (is_file('../../../../config/parameters.ini')) {
            $parameters = parse_ini_file("../../../../config/parameters.ini");
            return $parameters['backend'] . '/src/bo';
        }

//        $parameters = parse_ini_file("../config/parameters.ini");
//         return $parameters['backend'] . '/src/bo';      
    }
    static function getHome() {
         if (is_file('config/parameters.ini')) {
            $parameters = parse_ini_file("config/parameters.ini");
            return $parameters['server'];
        } else if (is_file('../config/parameters.ini')) {
            $parameters = parse_ini_file("../config/parameters.ini");
            return $parameters['server'];
        } else if (is_file('../../config/parameters.ini')) {
            $parameters = parse_ini_file("../../config/parameters.ini");
            return $parameters['server'];
        } else if (is_file('../../../config/parameters.ini')) {
            $parameters = parse_ini_file("../../../config/parameters.ini");
            return $parameters['server'];
        } else if (is_file('../../../../config/parameters.ini')) {
            $parameters = parse_ini_file("../../../../config/parameters.ini");
            return $parameters['server'];
        }

    }
}
