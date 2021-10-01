<?php
/**
 * Description of PerfilController
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class PerfilController extends CController{
    
    public $layout='//layouts/columnperfil';
	
    public $menu=array();
    
    public $estados = "";//$this->renderPartial('/cestados/listar');
	
    public $breadcrumbs=array();
    
    
    public function __construct($id,$module=null)
    {
	parent::__construct($id, $module);
        
     }
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        'ajaxOnly + addFriend'
                    );
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                        array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('personal', 
                                                 'addFriend',
                                                 'solicitud',
                                                 'aceptarSolicitud',
                                                 'actualizarDatos',
                                                 'updatePass',
                                                 'updateEmail',
                                                 'seguridad',
                                                 'foto',
                                                 'misDatos'
                                                ),
				'users'=>array('@'),
                              ),
                        array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionSolicitud(){
            $sendInvitation = Cfamistad::model()->count("id_User=".Yii::app()->user->id." and confirmado = 0");
            $invitation = Cfamistad::model()->count("idamigo=".Yii::app()->user->id." and confirmado = 0");
             $noti = $this->renderPartial("viewsolicitud", array(
                'sendInvitation'=>$sendInvitation,
                'invitation'=>$invitation
                ), true);
            
            echo $noti;
        }
        
        /**
         * metodo ejecuta aceptar una amistad
         */
        public function actionAceptarSolicitud()
        {
            $userInvitation = $_GET['ui'];
            $user = $_GET['user'];
            $amistad = Cfamistad::model()->find("id_User=".$user." and idamigo = ".$userInvitation." and confirmado=0");
            $amistad->confirmado=1;
            if($amistad->update())
            {
                $actividad = Cfactividad::model()->find("idamistad=".$amistad->idamistad);
                $actividad->aceptado=1;
                $actividad->update();
                
                $amistad = new Cfamistad();
                $amistad->id_User = $userInvitation;
                $amistad->idamigo = $user;
                $amistad->confirmado = 1;
                if($amistad->save())
                {                    
                    if(Yii::app()->request->isAjaxRequest)
                        echo json_encode(array('rsp'=>1));
                     else   
                         $this->redirect(array('perfil/index','id'=>$user));
                }
                    
            }
        }
        
        public function actionAddFriend()
        {
            $friend = new Cfamistad();
            $friend->id_User = $_GET['user'];
            $friend->idamigo = $_GET['friend'];
            $friend->solicitante=1;            
            
            if($friend->save())
            {
              $actividad = new Cfactividad();
              $actividad->iduser = $friend->id_User;
              $actividad->idamistad = $friend->idamistad;
              $actividad->tipo = Cfactividad::$tipos['Amistad'];
              $actividad->fecha=$friend->fecha;
              $actividad->save();
              echo "Solicitud Enviada";   
            }               
            else
                echo "Error!!";
            //echo $friend->id_User."recibido.....".$friend->idamigo;
            
        }
        
        
    public function actionIndex($id,$paso="")
    {
        if($paso==1)
            $this->redirect(array('perfil/personal'));
        $model = "";
        $ounwer = true;
        if($id == Yii::app()->user->id){
            $model = Cfperfil::model()->findByPk(Yii::app()->user->id);            
        }
        else{
            $model = Cfperfil::model()->findByPk($id);
            $ounwer = false;
        }
        $this->setPageTitle($model->nombre." ".$model->apellidos);
        $this->render('index',array('model'=>$model,'ounwer'=>$ounwer));
    }
    
    public function actionPersonal()
    {
        $this->layout = '//layouts/pasosperfil'; 
        $this->render('pasos/paso1');
    }
    
    public function actionFoto()
    {
        $this->layout = '//layouts/pasosperfil';
        $model = new Upfoto();
        $foto = CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default.png', 'Sin Foto');    
            $perfil = Cfperfil::model()->find("idPerfil=".Yii::app()->user->id);
          if(is_numeric($perfil->foto)){
                $mdia = Cfmedia::model()->find("idmedia=".$perfil->foto);//es validopor se asigna un id de imagen directamente
                $imagen = Cfimagen::model()->find("id_media=".$mdia->idmedia." and en_perfil=1");
                $idfoto = $imagen->idimagen;
              if(is_numeric($idfoto))
              {
                  $mfoto = Cfimagen::model()->find("idimagen=".$idfoto);
                  if($mfoto != null)
                  {
                     $foto = CHtml::image(Yii::app()->request->baseUrl.'/'.$mfoto->thumb_path.'/'.$mfoto->nom_thumb,'Sin Foto'); 
                  }
              }
          }
          
          if(isset($_POST['Upfoto']))
          {
             $dir = Yii::getPathOfAlias('webroot')."/uphoto";
             $model->attributes = $_POST['Upfoto'];              
             $file = new CFuploadImg($_FILES['Upfoto']['name']['foto'],$_FILES['Upfoto']['tmp_name']['foto'],$_FILES['Upfoto']['type']['foto'],$_FILES['Upfoto']['size']['foto'],$_FILES['Upfoto']['error']['foto']);
             
             if($model->validate())
             {
                 if($file!=null)
                    $subido =$file->saveAs($dir."/".$file->getName());
                 if($subido)
                 {
                   $imgThumb = Aimagen::createThumbnail($file->getName(), $file->getType(), "uphoto", "uthumb", 224, 264);
                    if(!is_bool($imgThumb)){
                        
                        
                     $media = new Cfmedia();
                     $media->idPrivcm = 1;
                     $media->nombre=$file->getName();
                     $media->directorio="uphoto";
                     $media->ruta = $dir;
                     $media->size = $file->getSize();
                     $media->fecha = microtime(true);                         
                         if($media->save())
                         {
                             $img = new Cfimagen();
                             $img->id_media = $media->idmedia;
                             $img->imgHeight = $file->getHeight();
                             $img->imgWidth = $file->getWidth();
                             $img->nom_thumb = $imgThumb['namethumb'];
                             $img->thumb_path = "uthumb";                                 
                             $img->thumbWidth = 224;
                             $img->thumbHeight = 264; 
                             $img->en_perfil = 1;

                             if($img->save())
                             {
                                 //este album ya debe existir porque se crear cuando el usuario se registra
                                 $album = Yii::app()->db->createCommand("select idmcategoria, tipo from cfmediacategoria where id_perfil = ".Yii::app()->user->id." and tipo = 1")->queryRow();
                                 $saved = false;
                                 if(!empty($album))
                                 {                                                                                          
                                  $mc = Cfmediacategoria::model()->findByPk($album['idmcategoria']);
                                  $mc->portada=$media->idmedia;
                                  $mc->update();

                                 }
                                    $media->id_mCategoria = $mc->idmcategoria;
                                    $media->update();

                                    //actualiza imagen actualen el perfil 
                                    $perfil = Cfperfil::model()->find("idPerfil=".Yii::app()->user->id);
                                    if(is_numeric($perfil->foto)){
                                    $imagen = Cfimagen::model()->find("id_media=".$perfil->foto." and en_perfil=1 and idimagen != ".$img->idimagen);
                                        if($imagen != null)
                                        {
                                           $imagen->en_perfil = 0;
                                           $imagen->update();
                                        }
                                    }

                                    $perfil = Cfperfil::model()->find("idPerfil=".Yii::app()->user->id);
                                    $perfil->foto = $media->idmedia;
                                    $perfil->paso_dos = 1;
                                    $perfil->update();
                                    $this->redirect(array('foto'));

                             }

                     } 
                        
                    }
                   
                 }
                 
             }
          }
        
        $this->render('pasos/paso2',array('model'=>$model,'foto'=>$foto));
    }
    
    
    public function actionMisDatos()
    {
        $this->layout = '//layouts/pasosperfil';
        $model =  Cfperfil::model()->findByPk(Yii::app()->user->id);
            if(isset($_POST['Cfperfil']))
            {
                $model->attributes=$_POST['Cfperfil'];
                $model->paso_tres = 1;
                $actual = date('Y',time());
                $nac = date("Y",strtotime($model->fecha_nac));                
                $model->edad = ($actual-$nac);
		 if($model->update())
			$this->redirect(array('index','id'=>Yii::app()->user->id));
            }
          $this->render('pasos/paso3',array('model'=>$model));      
    }


    public function actionActualizarDatos($id)
    {   
        if(is_numeric($id)){
             $model = Cfperfil::model()->findByPk($id);
             $usuario = Cfusuario::model()->findByPk($id);            
             if(isset($_POST['Cfperfil']) and isset($_POST['Cfusuario']))
             {
                $model->attributes = $_POST['Cfperfil'];
                $model->fecha_nac = $model->anio."-".$model->mes."-".$model->dia;                
                $usuario->login = $_POST['Cfusuario']['login'];
                if($model->update() and $usuario->update()){
                    Yii::app()->user->setFlash('success', 'Datos actualizados correctamente');
                    $this->redirect(array('perfil/actualizarDatos','id'=>$id));
                }
                     
             }
             if($model != null)
                $this->render('actualizar',array('model'=>$model,'usuario'=>$usuario));
        } 
           
    }
    
    public function actionUpdatePass($id)
    {
        if(is_numeric($id)){
            $model = new NewPassword($id);
            if(isset($_POST['NewPassword']))
            {
                $model->setAttributes($_POST['NewPassword']);
                if($model->save($id))
                {
                    Yii::app()->user->setFlash('ok','cambio de contraseña ok.');
                    $this->redirect(array('perfil/updatePass','id'=>$id));
                }else
                {
                    Yii::app()->user->setFlash('error',$model->getErrores());
                    $this->redirect(array('perfil/updatePass','id'=>$id));
                }
                    
            }  
            $this->render('cambiarpass',array('model'=>$model));
        }
    }
    
    public function actionUpdateEmail($id)
    {
        if(is_numeric($id)){
            $model = new NewEmail($id);
            if(isset($_POST['NewEmail']))
            {
              $model->setAttributes($_POST['NewEmail']);
              if($model->save($id))
                {
                    Yii::app()->user->setFlash('ok','cambio de EMAIL ok.');
                    $this->redirect(array('perfil/updateEmail','id'=>$id));
                }else
                {
                    Yii::app()->user->setFlash('error',$model->getErrores());
                    $this->redirect(array('perfil/updateEmail','id'=>$id));
                }
              
            }
            $this->render('cambiaremail',array('model'=>$model));
        }
    }
    
    public function actionSeguridad($id)
    {
        

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='cfseguridad-seguridad-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */
        
        if(is_numeric($id)){
            $model=Cfseguridad::model()->find('iduser='.$id);
            if($model != null){
                if(isset($_POST['Cfseguridad']))
                {
                    $model->attributes=$_POST['Cfseguridad'];
                    if($model->validate())
                    {
                        if($model->update())
                            $this->redirect(array('perfil/seguridad','id'=>$id));
                        return;
                    }
                }
                $this->render('seguridad',array('model'=>$model));
            }
        }
     }
}

?>
