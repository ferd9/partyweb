<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    public $name = array();
    public $id;
    private $modelUser;
    private $perfilUser;
    private $register = false;    
    
        public function __construct($username,$password)
	{
            $this->modelUser = new Cfusuario();
            $this->perfilUser = new Cfperfil();
            if($this->modelUser->exists("email = '".$username."'"))
            {
                $datauser = $this->modelUser->find("email = '".$username."'");
                if($datauser->verifyPassword($password))
                {
                   $puser = $this->perfilUser->find("idPerfil='".$datauser->iduser."'");                                
                    $this->username = $username;
                    $this->setReferData($datauser->iduser,$puser->nombre." ".$puser->apellidos);

                    if($this->register)
                    {
                        $bitacora = new Cfubitacora();
                        $bitacora->initValues($datauser->iduser);
                        $bitacora->save(); 
                    } 
                    $this->errorCode = self::ERROR_NONE;
                }else
                    $this->errorCode = self::ERROR_PASSWORD_INVALID; 
                
                                
            }else{
                $this->errorCode = self::ERROR_USERNAME_INVALID; 
            }             
	}
        
        public function isRegister()
        {
            $this->register = true;
        }
        //establece id y name del webuser
        private function setReferData($uid,$name)
        {
            $this->id=$uid; 
            //$this->name = array();            
            $this->name = $name;
            
        }

        /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		return !$this->errorCode;
	}
        
        public function getId()
	{
		return $this->id;
	}        
       
        public function getName()
        {
            return $this->name;
        }
        
       
}