<?php

class SiteController extends CfpController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

        
        public function actionRegistro()
        {
            $model=new Cfusuario;
            $perfil = new Cfperfil;
            if(isset($_POST['Cfusuario']) && isset($_POST['Cfperfil']))
            {
                $model=new Cfusuario;                
                $model->attributes = $_POST['Cfusuario']; 
                $model->encryptPassword();
                
                $perfil->attributes= $_POST['Cfperfil'];
                $perfil->fecha_nac = $perfil->anio."-".$perfil->mes."-".$perfil->dia;
                
                if($model->save())
                {
                   $bitacora = new Cfubitacora();
                   $bitacora->initValues($model->iduser);                    
                   $bitacora->save(); 
                   
                   $sg = new Cfseguridad();
                   $sg->iduser = $model->iduser;
                   $sg->fecha=time();
                   $sg->save();
                   
                                     
                   $perfil->idPerfil =$model->iduser;
                   if($perfil->save())
                   {                       
                       $userIdent = new UserIdentity($model->email,$_POST['Cfusuario']['password']); 
                       $userIdent->isRegister();
                       Yii::app()->user->login($userIdent,0);
                       
                       $mc = new Cfmediacategoria();
                       $mc->id_perfil = Yii::app()->user->id;
                       $mc->nombre = "Imagenes perfil";                       
                       $mc->fecha=time();
                       $mc->tipo=1;
                       $mc->save();
                       
                       $this->redirect(array('perfil/index','id'=>Yii::app()->user->id,'paso'=>1));
                   }else{
                        $msj = "";
                        foreach($perfil->getErrors() as $error)
                        {
                            foreach($error as $des){
                               $msj .= $des; 
                            }
                        }
                        Yii::app()->user->setFlash('ep',$msj);
                        $this->render('registro',array('model'=>$model,'perfil'=>$perfil));
                        return;
                   }
                }else
                {
                   $msj = "";
                        foreach($model->getErrors() as $error)
                        {
                            foreach($error as $des){
                               $msj .= $des; 
                            }
                        }
                        Yii::app()->user->setFlash('eu',$msj);
                        $model->password = "";
                        $model->verifyPass = "";
                  $this->render('registro',array('model'=>$model,'perfil'=>$perfil));  
                }
            }
            $this->render('registro',array('model'=>$model,'perfil'=>$perfil));
        }
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
       
	public function actionIndex()
	{                           
                $numImages = Aimagen::model()->count();
                $this->render('index',array('newaimagen'=>$numImages));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid                         
			if($model->validate() && $model->login())
                        {
                           $this->redirect($this->createUrl('perfil/index',array('id'=>Yii::app()->user->id))); 
                        }else
                        {   
                            $this->layout='//layouts/column2';
                            $this->render('login',array('model'=>$model)); 
                        }	
                       
		}else
                {
                 $this->layout='//layouts/column2';
                  $this->render('login',array('model'=>$model));   
                }
		
	}
        
       /* public function actionTestbd()
        {
            $mu = Cfusuario::model();
            $mu->find("login='ferd9'");
            echo $mu->login;
            
        }*/

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        //mejorar validacion de imagen
        public function actionUploadImage()
        {
            //sleep(15);
            // list of valid extensions, ex. array("jpeg", "xml", "bmp")
            $allowedExtensions = array("jpeg","jpg","png","gif");
            // max file size in bytes
            $sizeLimit = 5 * 1024 * 1024;

            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload('images/');
            // to pass data through iframe you will need to encode all html tags
            echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            //echo json_encode($result);            
            /*           
            $model=new Cfusuario;
            $perfil = new Cfperfil;            
            $numImages = Aimagen::model()->count();
            if(isset($_FILES['aimagen']) and $_FILES['aimagen']['error']==0)
            {
              if(Aimagen::getTypeImage($_FILES['aimagen']['type']))
              {
                   if(move_uploaded_file($_FILES['aimagen']['tmp_name'],'images/'.basename($_FILES['aimagen']['name'])))
                  {
                     //echo CFileHelper::getExtension($_FILES['aimagen']['tmp_name']);
                     $dataImagen =new Aimagen();
                     $dataImagen->nombre=basename($_FILES['aimagen']['name']);
                     $dataImagen->directory='images';
                     $dataImagen->path=Yii::app()->request->baseUrl.'/images/';
                     $dataImagen->size=$_FILES['aimagen']['size'];
                     $dataImagen->type=$_FILES['aimagen']['type'];
                     
                      $imgThumbnail = Aimagen::createThumbnail($_FILES['aimagen']['name'], $_FILES['aimagen']['type'],'images','imgthumb');
                      if(is_bool($imgThumbnail))
                      {
                          echo $_FILES['aimagen']['name']." no es una imagen valida";
                          unlink(Yii::getPathOfAlias('webroot').'/images/'.basename($_FILES['aimagen']['name']));
                          $this->redirect(Yii::app()->user->returnUrl);                          
                          
                      }else
                      {
                         $dataImagen->imgWidth = $imgThumbnail['width']; 
                         $dataImagen->imgHeight = $imgThumbnail['height'];
                         $dataImagen->nom_thumb = $imgThumbnail['namethumb'];
                         $dataImagen->thumb_path = 'imgthumb';
                         $dataImagen->thumbWith=108;
                         $dataImagen->thumbHeight=90;
                         $dataImagen->fecha=time();
                         $dataImagen->save();
                         $numImages = Aimagen::model()->count(); 
                         $this->redirect('index',array('model'=>$model,'perfil'=>$perfil,'errores'=>false,'newaimagen'=>$numImages)); 
                      }
                          
                     $numImages = Aimagen::model()->count();                    
                     $this->render('index',array('model'=>$model,'perfil'=>$perfil,'errores'=>false,'newaimagen'=>$numImages));
                    
                  }                    
                  else{
                      echo basename($_FILES['aimagen']['name']);
                  }
                  echo 'Formato de imagen valido ';
                  
                  //echo $_FILES['aimagen']['type'];
              }
             
                    
            }else{
                $this->render('index',array('model'=>$model,'perfil'=>$perfil,'errores'=>false,'newaimagen'=>$numImages));
            }*/
        }
        
        public function actionAimage()
        {
                if(isset($_GET['id']))
		{
                    $image = Aimagen::model()->findByPk($_GET['id']);
			$this->renderPartial('viewimganonimo', array(
				'directory'=>$image->directory,
                                'nombre'=>$image->nombre
			));
		}
        }
        
        
}