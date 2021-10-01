<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewPassword
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class NewPassword extends CFormModel{    
    public $actualpass;
    public $password;
    public $verifyPass;
    public $errores="";
    
           
        public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('actualpass, password, verifyPass', 'required'),			
			array('password, verifyPass', 'length', 'max'=>128),			
                        array("verifyPass", "compare", "compareAttribute" => "password"),			
		);
	}
    
        public function attributeLabels()
	{
		return array(			
			'actualpass' => 'Contraseña Actual',
			'password' => 'Contraseña Nueva',
			'verifyPass' => 'Repita la contraseña Nueva',			
		);
	}        
            
        
        public function save($id)
        {
            $model = Cfusuario::model()->findByPk($id);            
            if($model->verifyPassword($this->actualpass))
            {  
               if(!empty($this->password) and !empty($this->verifyPass) and ($this->password==$this->verifyPass))
               {  
                   $model->password =  $this->password;
                   $model->verifyPass = $this->verifyPass;
                   $model->encryptPassword(); 
                   
                   if($model->validate())
                   {
                       if($model->update())
                           return true;
                       else
                           $this->errores .= "no se pudo guardar";

                   }else{
                       foreach($model->getErrors() as $k=>$v)
                       {
                           foreach($v as $c=>$val)
                           {
                               $this->errores .= $val; 
                           } 
                       }
                       return false;
                   }
               }
               else{                   
                   if($this->password != $this->verifyPass)
                         $this->$errores .="Las Contraseñas no coinciden";
                  return false; 
               } 
                    
            }else
            {
                $this->errores.="Contraseña actual no es correcta";
                return false;
            }
                
        }
        
        public function getErrores()
        {
            return $this->errores;
        }
}

?>
