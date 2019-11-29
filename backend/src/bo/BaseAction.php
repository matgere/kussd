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
use Log\Loggers as Logger;
abstract class BaseAction{
    
    protected function doSuccess($id, $message){
        $array['rc'] = 0;
        $array['oId'] = $id;
        $array['message'] = $message;
        echo json_encode($array);
    }
    
    protected function doSuccessCB($id, $numero, $message){
        $array['rc'] = 0;
        $array['oId'] = $id;
        $array['message'] = $message;
        $array['oNumero'] = $numero;
        echo json_encode($array);
    }
    
    protected function doSuccessO($object){
        $object=json_encode((array)$object);
        echo str_replace("\u0000*\u0000", "", $object);
    }
    
    protected function doSuccessImport($nbrContact, $nbrContactExist){
        $array=array();
        $array['contactInserted']=$nbrContact;
        $array['contactExist']=$nbrContactExist;
        echo json_encode($array);
    }
    
    protected function doStatus($messageId, $status){
        $status['messageId'] = $messageId;
        echo json_encode($status);
    }
    
    protected function doError($errorCode,$message){
        $array['rc'] = $errorCode;
        $array['error'] = $message;
        echo json_encode($array);
    }
    protected function doLogError($message) {
        $logger = new Logger(__CLASS__);
        return $logger->log->error($this->doTag().$message);
    }
    
    protected function doLogInfo($message) {
        $logger = new Logger(__CLASS__);
        return $logger->log->info($this->doTag().$message);
    }
    
    protected function doTag() {
        $tag = "";
        if (isset($_REQUEST['code_etablissement'])) {
            $tag = $tag . '[code_eta-' . $_REQUEST['code_etablissement'] . ']';
        }
        if (isset($_REQUEST['code_annee_scolaire'])) {
            $tag = $tag . '[code_annee-' . $_REQUEST['code_annee_scolaire'] . ']';
        }
        if (isset($_REQUEST['user_id'])) {
            $tag = $tag . '[user_id-' . $_REQUEST['user_id'] . ']';
        }
        if (isset($_REQUEST['userId'])) {
            $tag = $tag . '[userId-' . $_REQUEST['userId'] . ']';
        }
        $tag = $tag . ' - ';
        return $tag;
    }
    protected function doGetListParam() {
        $params = "";
        foreach ($_REQUEST as $key => $value){
            $params =  $params.' - '.$key. ' : '.$value ;
        }
        return $params;
    }
    
    protected function generateNumeroDossier($anneeScolaire,$currentCode) {
        $code=0;
        if(strlen($currentCode)==1) $code=$anneeScolaire."-00000".$currentCode;
        else if(strlen($currentCode)==2) $code=$anneeScolaire."-0000".$currentCode;
        else if(strlen($currentCode)==3) $code=$anneeScolaire."-000".$currentCode;
        else if(strlen($currentCode)==4) $code=$anneeScolaire."-00".$currentCode;
        else if(strlen($currentCode)==5) $code=$anneeScolaire."-0".$currentCode;
        return $code;
    }
    protected function generateNumeroCandidat($anneeScolaire,$currentCode) {
        $code=0;
        if(strlen($currentCode)==1) $code="DA/".$anneeScolaire."-00000".$currentCode;
        else if(strlen($currentCode)==2) $code="DA/".$anneeScolaire."-0000".$currentCode;
        else if(strlen($currentCode)==3) $code="DA/".$anneeScolaire."-000".$currentCode;
        else if(strlen($currentCode)==4) $code="DA/".$anneeScolaire."-00".$currentCode;
        else if(strlen($currentCode)==5) $code="DA/".$anneeScolaire."-0".$currentCode;
        return $code;
    }
    protected function generateNumero($currentCode) {
        $code=0;
        if(strlen($currentCode)==1) $code="-00000".$currentCode;
        else if(strlen($currentCode)==2) $code="-0000".$currentCode;
        else if(strlen($currentCode)==3) $code="-000".$currentCode;
        else if(strlen($currentCode)==4) $code="-00".$currentCode;
        else if(strlen($currentCode)==5) $code="-0".$currentCode;
        return $code;
    }
    /**
     * Cette fonction retourne une liste d'objets sous forme de tableau
     * @param type listObject
     * @return array
     */
    protected function listObjectToArray($object){
        $array=array();
        foreach ($object as $value) {
            $array[]= (array)$value;
            
        }
        return $array;
    }
    protected function objectToArray($value){
        return (array)$value;
    }
    
    protected function dataTableFormat($objects, $sEcho, $iTotalRecords) {
        $arraySEcho['sEcho']=$sEcho;
        $arraySEcho['iTotalRecords']=  count($objects).'';
        $arraySEcho['iTotalDisplayRecords']= $iTotalRecords.'';
        $arraySEcho['aaData']=(array) $objects;
        return $arraySEcho;
    }
    
    protected function doSuccessJson($json) {
        echo $json;
    }
    
    //     protected function doResult($list, $result){
    //         $array['rc'] = 0;
    //         $array['list'] = $list;
    //         $array['resultat'] = $result;
    //         echo json_encode($array);
    //     }
    /**
     * @author Diodio
     *
     * Cette fonction permet de renvoyer une liste avec succes et erreur
     *
     * @param
     */
    protected function doResult($data){
        $array['rc'] = 0;
        //         $array['list'] = $list;
        $array['data'] = $data;
        echo json_encode($array);
    }
    /**
     * @author Diodio
     *
     * Cette méthode permet de vérifier si le format téléphone est valide ou pas
     *
     * @param
     */
    //    	protected function isValidTelephone($tel) {
    //		$telF = $tel.toString();
    //		if ($telF != null && $telF.trim().length() > 0)
        //
        //			return $telF.matches("^[0-9]{9,9}$");
        //		return false;
        //	}
        
        
}

