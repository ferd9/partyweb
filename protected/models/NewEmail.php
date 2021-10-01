<?php

/**
 * Description of NewEmail
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class NewEmail extends CFormModel{
    public $email;
    public $actualpass;
    public $errores="";
    
         public function __construct($id,$scenario='')
        {
            parent::__construct($scenario);
            $model = Cfusuario::model()->findByPk($id);
            $this->email = $model->email;
            $model = null;
        }
        
        
        public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('email','unique'),
                        array('email','email'),
			array('actualpass, email', 'required'),			
			array('actualpass', 'length', 'max'=>128),
		);
	}
    
        public function attributeLabels()
	{
		return array(
			'email' => 'Email',
			'actualpass' => 'Ingrese Contraseña Actual',					
		);
	} 
        
        public function save($id){
            $model = Cfusuario::model()->findByPk($id);            
            if($model->verifyPassword($this->actualpass))
            {  
               if(!empty($this->email))
               {  
                   
                   $model->email = $this->email;
                   if($model->validate(array('email')))
                   {
                       if($model->update())
                           return true;
                       else
                           $this->errores .= "No se pudo Cambiar el Email";

                   }else{
                       $errs = $model->getErrors();
                       foreach($errs as $k=>$v)
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
                  $this->$errores .="Email no valido";
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
