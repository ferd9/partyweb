<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CfpController
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class CfpController extends Controller{
    
    /*public function beforeAction($action)
    {
        //se ejecuta si llama a la accion registro del controlador site
        if($action->id === 'registro')
        {
            if(isset($_POST['Cfusuario']) && isset($_POST['Cfperfil']))
            { 
                $model=new Cfusuario;                
                $model->attributes = $_POST['Cfusuario']; 
                $model->encryptPassword();                
                if(!$model->validate())
                    $_POST['userError']=$model->getErrors();                
                    
                //print_r($model->getErrors());
                if($model->save())
                {   
                    $bitacora = new Cfubitacora();
                    $bitacora->initValues($model->iduser);                    
                    $bitacora->save();                    
                    $_POST['Cfperfil']['idPerfil']=$model->iduser;
                    $_POST['Cfperfil']['fecha_nac']=$_POST['Cfperfil']['anio'].'-'.$_POST['Cfperfil']['mes'].'-'.$_POST['Cfperfil']['dia'];
                    $_POST['save']=true;
                    $_POST['vacio']=false;
                }else
                {
                    $_POST['save']=false;
                    $_POST['vacio']=false;
                } 
                
            }else
                $_POST['vacio']=true;
        }
	return true;
    }*/
    
    /*public function __construct($id, $module = null) {
            parent::__construct($id, $module);
            Yii::app()->language=(isset($_GET['lang']))?$_GET['lang']:Yii::app()->language;            
        }
    
    public function createMultilanguageReturnUrl($lang='pt')
    {
            $arr = array('lang'=>$lang);
            if(count($_GET>0))
            {
                $arr = $_GET;
                $arr['lang']=$lang;
            }
            return $this->createUrl('',$arr);
    }*/
}

?>
