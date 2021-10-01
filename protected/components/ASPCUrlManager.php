<?php
/**
 * Description of ASPCUrlManager
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class ASPCUrlManager extends CUrlManager{
    
     public function createUrl($route,$params=array(),$ampersand='&')
     {
        /*if (!isset($params['lang']))
            $params['lang']=Yii::app()->language;*/
        return parent::createUrl($route, $params, $ampersand);        
     }
}

?>
