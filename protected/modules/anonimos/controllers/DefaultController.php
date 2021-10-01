<?php

class DefaultController extends Controller
{
    public $layout='/layouts/vistageneral';
    
    
    public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFAABB,
			),
			
		);
	}
    
	public function actionIndex()
	{             
            $numImages = Aimagen::model()->count();
            $model2=new Cfapost;
            $this->render('index',array('newaimagen'=>$numImages,'model2'=>$model2));            
	}
        
        public function actionPost()
        {
            $model=new Cfapost();

            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='cfapost-anonimopost-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */
            
            /*if(isset($_GET['post']) and isset($_GET['image']))
            {
                if(!is_numeric($_GET['post']) and !is_numeric($_GET['dataimg']))
                    throw new CHttpException(400,'Solicitud no valida.');
                else{
                    $this->render('index',array('newaimagen'=>$numImages,
                    'post'=>$_GET['post'],
                    'dataimg'=>$_GET['image']
                    ));
                }
                return;
            } */          
           
            
           $numImages = Aimagen::model()->count();
           $fpost = time();
           $dataImagen =new Aimagen();           
           $withImg = false;            
            if(isset($_POST['Cfapost']))
            {
                if($_FILES['Cfapost']['error']['img']==0)
                {   
                    $withImg = true;
                    
                    if(Aimagen::getTypeImage($_FILES['Cfapost']['type']['img']))
                    {
                        if(move_uploaded_file($_FILES['Cfapost']['tmp_name']['img'], 'images/'.basename($_FILES['Cfapost']['name']['img'])))
                        {
                           $imgThumbnail = Aimagen::createThumbnail($_FILES['Cfapost']['name']['img'], $_FILES['Cfapost']['type']['img'], 'images', 'imgthumb');
                           if(is_bool($imgThumbnail))
                           {
                               unlink(Yii::getPathOfAlias('webroot').'/images/'.basename($_FILES['Cfapost']['name']['img']));
                               $this->redirect(Yii::app()->user->returnUrl);
                           }else
                           {                                 
                                 $dataImagen->nombre=basename($_FILES['Cfapost']['name']['img']);
                                 $dataImagen->directory='images';
                                 $dataImagen->path=Yii::app()->request->baseUrl.'/images/';
                                 $dataImagen->size=$_FILES['Cfapost']['size']['img'];
                                 $dataImagen->type=$_FILES['Cfapost']['type']['img'];
                                 $dataImagen->imgWidth = $imgThumbnail['width']; 
                                 $dataImagen->imgHeight = $imgThumbnail['height'];
                                 $dataImagen->nom_thumb = $imgThumbnail['namethumb'];
                                 $dataImagen->thumb_path = 'imgthumb';
                                 $dataImagen->thumbWith=108;
                                 $dataImagen->thumbHeight=90;
                                 $dataImagen->fecha=$fpost;
                                 
                                     
                           }
                        }
                    }                    
                    
                 }
                
                $model->anombre = $_POST['Cfapost']['anombre'];
                $model->email = $_POST['Cfapost']['email'];
                $model->titulo = $_POST['Cfapost']['titulo']; 
                $model->contenido = $_POST['Cfapost']['contenido'];
                $model->codeVerify = $_POST['Cfapost']['codeVerify'];                
                $model->fecha = $fpost;
                
                if($model->validate())
                {  
                    if($model->save())
                    {                        
//                        $this->refresh();
//                        $this->render('error',array('error'=>$model->attributes));
//                        return;
                    Cookie::set('anonimopost', $model->idapost);
                        if($withImg)
                        {
                            if($dataImagen->save())
                            {
                                $postimg = new Apostimg();
                                $postimg->idapost = $model->idapost;
                                $postimg->idaimagen = $dataImagen->idaimagen;
                                $postimg->save();                                
                                $this->redirect(array('default/index'));
                            }

                        } 
                      $this->redirect(array('default/index'));
                        
                    }
                }else
                {
                    print_r($model->getErrors());
                }
            }
          $this->redirect(array('default/index'));
        }
        
        //eliminar vista relacionada a esta action
       /* public function actionComents()
        {
            $model=new Cfacoment;

            // uncomment the following code to enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='cfacoment-coments-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            
            $comentarios=new Cfacoment('search');
            $comentarios->unsetAttributes();  // clear any default values
            if(isset($_GET['post']) and isset($_GET['img']) and $_GET['img'] !=0 and !isset($_POST['Cfacoment']))
            {
                
		if(isset($_GET['Cfacoment']))
			$comentarios->attributes=$_GET['Cfacoment'];
                
               $this->render('coments',array('model'=>$model,'post'=>$_GET['post'],'img'=>$_GET['img'],'comentarios'=>$comentarios));
               return;
            } else if(isset($_GET['post']) and !isset($_POST['Cfacoment'])) {
                
                if(isset($_GET['Cfacoment']))
			$comentarios->attributes=$_GET['Cfacoment'];
               $this->render('coments',array('model'=>$model,'post'=>$_GET['post'],'comentarios'=>$comentarios));               
               return;
            }
            
                   
            if(isset($_POST['Cfacoment']))
            {
                $model->attributes=$_POST['Cfacoment'];
                if($model->validate())
                {
                    $model->save();
                    $this->refresh();
                    if(isset($_GET['Cfacoment']))
			$comentarios->attributes=$_GET['Cfacoment'];
                    $this->render('coments',array('model'=>$model,'post'=>$_GET['post'],'img'=>$_GET['img'],'comentarios'=>$comentarios));
                    return;
                }
            }
            $this->render('coments',array('model'=>$model));
        }*/
        
        public function actionPruebas()
        {
            $post = Cfapost::model()->find("40");
            //$post->
        }
        
        
        public function actionMensaje()
        {
             
        $rpost =Cfapost::model()->findAllBySql("SELECT idapost,anombre, email, titulo, contenido, fecha FROM cfapost ORDER BY idapost DESC LIMIT 0,4;");
            $json = "{";
            $index=1;
            foreach($rpost as $apost){
                if(Apostimg::model()->exists("idapost = '".$apost->idapost."'")){
                    $imgTmpPost = Apostimg::model()->find("idapost = '".$apost->idapost."'");
                    $imgPost =Aimagen::model()->find("idaimagen='".$imgTmpPost->idaimagen."'");
                    $json .= "fila".$index.": {";
                    $json .='img:"'.Yii::app()->request->baseUrl.'/'.$imgPost->thumb_path.'/'.$imgPost->nom_thumb.'",';
                    $json .='url:"'.Yii::app()->createAbsoluteUrl('site/aimage',array('id'=>$imgPost->idaimagen)).'",';
                    $json .='titulo:"'.$apost->titulo.'",';
                    $json .='contenido:"'.htmlentities($apost->contenido).'",';
                    $json .='comentarios:"'.Cfacoment::model()->count("idapost='".$apost->idapost."'").'",';
                    $json .='rulenlace:"'.Yii::app()->createAbsoluteUrl('anonimos/default/coments',array('post'=>$apost->idapost,'img'=>$imgPost->idaimagen)).'",';
                    $json .='vcometarios:"'.Yii::app()->createAbsoluteUrl('anonimos/default/comentspost',array('id'=>$apost->idapost)).'"';
                    if($index<4)
                    $json .="},";
                    else if ($index==4)
                    $json .="}";
                    
                }else{
                    $json .="fila".$index.": {";
                    $json .='img:"'.Yii::app()->request->baseUrl.'/images/default.png'.'",';
                    $json .='url:"#",';
                    $json .='titulo:"'.$apost->titulo.'",';
                    $json .='contenido:"'.htmlentities($apost->contenido).'",';
                    $json .='comentarios:"'.Cfacoment::model()->count("idapost='".$apost->idapost."'").'",';
                    $json .='rulenlace:"'.Yii::app()->createAbsoluteUrl('anonimos/default/coments',array('post'=>$apost->idapost,'img'=>0)).'",';
                    $json .='vcometarios:"'.Yii::app()->createAbsoluteUrl('anonimos/default/comentspost',array('id'=>$apost->idapost)).'"';
                    if($index<4)
                    $json .="},";
                    else if ($index==4)
                    $json .="}";

                }//fin else  
               $index++; 
           }//fin for            
          $json .= "}"; 
          echo $json;
        }
        
        public function actionAllpost(){
            
            if(isset($_GET['inicio']) and isset($_GET['final'])){
                if(!is_numeric($_GET['inicio']) or !is_numeric($_GET['final'])){
                    throw new CHttpException(400,'Solicitud no valida.');
                    return;
                }
                $this->render('alistpost',array('inicio'=>$_GET['inicio'],'final'=>$_GET['final']));
            }
            else
                throw new CHttpException(400,'Solicitud no valida.');
        }
        
        public function actionComentspost()
        {
            if(isset($_GET['id']) and is_numeric($_GET['id']))
            {
                $model=new Cfacoment; 
                if(isset($_POST['Cfacoment']))
                {
                    $model->attributes=$_POST['Cfacoment'];
                    if($model->validate())
                    {
                        if($model->save())
                            $this->refresh();                       
                    }
                }
                
                
                
                  $criteria=new CDbCriteria(array(
			'condition'=>'idapost='.$_GET['id'],
			'order'=>'fecha DESC',
			//'with'=>'idapost0',
		));
                  
                 $criteria2= new CDbcriteria(array(
                     'condition'=>'idapost='.$_GET['id'],
                     'with'=>'idaimagen0'
                    )); 
                 $img = null;
                 $imgp = Apostimg::model()->find($criteria2);
                 $post = Cfapost::model()->find("idapost='".$_GET['id']."'");                 
                 if(is_object($imgp ))
                 {
                     $img = Aimagen::model()->find("idaimagen=".$imgp->idaimagen);                     
                 }
                 
                
                  
		/*if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);*/

		$dataProvider=new CActiveDataProvider('Cfacoment', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['postsPerPage'],
			),
			'criteria'=>$criteria,
		)); 
                $fotolink = null;
                if($img !=null)
                {
                    $foto= CHtml::image(Yii::app()->request->baseUrl.'/'.$img->directory.'/'.$img->nombre);      
                    $fotolink = CHtml::link($foto,Yii::app()->createAbsoluteUrl('site/aimage',array('id'=>$img->idaimagen)),array('class'=>'view-aimagen','rel'=>$img->nombre,'alto'=>$img->imgHeight));          
                }
                $model=new Cfacoment;    
		$this->render('comentarios',array(
			'dataProvider'=>$dataProvider,
                        'elpost'=>$post,
                        'laimg'=>$fotolink,
                        'model'=>$model
		));
            }else
                throw new CHttpException(400,'La pagina solicitada no existe.');
          
        }
        
        /*public function actionVerPost($id)
        {
            if(is_numeric($id))
            {                
               $post = Cfapost::model()->find("idapost=".$id); 
               $imgpost = Apostimg::model()->find('idapost='.$id);
            }
        }*/
}