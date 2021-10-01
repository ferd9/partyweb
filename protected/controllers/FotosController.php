<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminMedia
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class FotosController extends CController{
    
     public $layout='//layouts/fotos';
	
    public $menu=array();
    public $uploadButtom="";
	
    public $breadcrumbs=array();
    
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','misfotos','uploadfoto','showalbum','showpic','comentarFoto','crearAlbum'),
				'users'=>array('@'),
                             ),	
                        array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionIndex(){
            $this->render("index");
        }
        
        public function actionMisfotos($album)
        {
            if(is_numeric($album))
             $this->render('fotosalbum',array('album'=>$album));
        }
        
        public function actionUploadfoto()
        {
            //usleep(1000000);            
            // list of valid extensions, ex. array("jpeg", "xml", "bmp")
            $allowedExtensions = array("jpeg","jpg","png","gif");
            // max file size in bytes
            $sizeLimit = 5 * 1024 * 1024;

            $uploader = new qqFotoUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload('uphoto/');
            // to pass data through iframe you will need to encode all html tags            
           echo htmlspecialchars(json_encode($result),ENT_NOQUOTES); 
        }
        
        /**
         * muestra album a amigos
         * @param type $iu 
         */
        public function actionShowalbum($iu)
        {
            if(is_numeric($iu))
            {
              if(Cfusuario::model()->exists("iduser=".$iu))  
              {
                  $this->render("mostrarmisalbums",array('iu'=>$iu));
              }
            }
        }
        
        /**
         *metodo muestra fotos de un album especifico
         * @param type $ui
         * @param type $album 
         */
        public function actionShowpic($iu,$album)
        {
            if(is_numeric($iu) and is_numeric($album))
            {
              if(Cfusuario::model()->exists("iduser=".$iu) and Cfmediacategoria::model()->exists("idmcategoria=".$album." and id_perfil=".$iu))  
              {
                  $this->render("mostrarmisfotos",array('iu'=>$iu,'album'=>$album));
              }
            }
        }
        
        public function actionComentarFoto($iu,$album,$foto)
        {
           if(is_numeric($iu) and is_numeric($album) and is_numeric($foto))
           {
               if(Cfusuario::model()->exists("iduser=".$iu) and Cfmediacategoria::model()->exists("idmcategoria=".$album." and id_perfil=".$iu)
                   and Cfmedia::model()->exists("idmedia=".$foto))  
               {
                   $md = Cfmedia::model()->find("idmedia=".$foto);
                   $ufoto = Cfimagen::model()->find("id_media=".$foto);
                   $this->render("comentarfoto",array('iu'=>$iu,'md'=>$md,'ufoto'=>$ufoto));
               }
           }
        }
        
        public function actionCrearAlbum()
        {
            //print_r($_POST);
            
            //print_r($_SERVER);
           $album = new Cfmediacategoria();
           $allok = false;
          if(!empty($_GET)){
              
                      
            $album->id_perfil = Yii::app()->user->id;
            $album->nombre = $_GET['name'];
            $album->fecha = time();
            $album->tipo = 2;
            $abs = $album->save();
            if(!$abs)
            {
                echo -1;
                return;
            }
            
            $input = fopen("php://input", "r");
            $temp = tmpfile();
            $realSize = stream_copy_to_stream($input, $temp);
            fclose($input);
            
            $target = fopen("tfile/".$_GET['foto'], "w");        
            fseek($temp, 0, SEEK_SET);
            stream_copy_to_stream($temp, $target);
            $pathinfo = pathinfo($_GET['foto']);
            $ext = $pathinfo['extension'];
            switch ($ext)
            {
                case 'jpeg':
                case 'jpg':
                    $ext='image/jpeg';
                    break;
                case 'png':
                    $ext='image/png';
                    break;
                case 'gif':
                    $ext='image/gif';
                    break;
            }
            
        $imgThumb = Aimagen::createThumbnail($_GET['foto'], $ext, "tfile", "uthumb", 224, 264);
         if(!is_bool($imgThumb))
         {
             $dir = Yii::getPathOfAlias('webroot')."/uphoto";
             $media = new Cfmedia();
             if($abs)
                $media->id_mCategoria = $album->idmcategoria;
             $media->idPrivcm = 1;
             $media->nombre=$_GET['foto'];
             $media->directorio="uphoto";
             $media->ruta = $dir;
             $media->size = (int)$_SERVER["CONTENT_LENGTH"];
             $media->fecha = microtime(true);
             if($media->validate())
             {
                 if($media->save())
                  {
                     $img = new Cfimagen();
                     $img->id_media = $media->idmedia;
                     $img->imgHeight = Aimagen::$alto;
                     $img->imgWidth = Aimagen::$ancho;
                     $img->nom_thumb = $imgThumb['namethumb'];
                     $img->thumb_path = "uthumb";                                 
                     $img->thumbWidth = 224;
                     $img->thumbHeight = 264; 
                     $img->en_perfil = 0;
                     if($img->save())
                     {
                        $album->portada = $media->idmedia;
                        if($album->update())
                        {
                            $ft = CHtml::image(Yii::app()->request->baseUrl."/".$img->thumb_path."/".$img->nom_thumb, "Imagen de Perfil");
                            $bimagen = '<div class="box-album">'.CHtml::link($ft,array("fotos/misfotos","album"=>$album->idmcategoria));
                            $bimagen .= "<span>".$album->nombre."(1)</span> </div>";
                            echo $bimagen;
                        }else{
                            echo -6;
                            return; 
                        }
                        
                     }else{
                             echo -5;
                             return;             
                         }
                  }else{
                         echo -4;
                         return;             
                     }
             }else{
                 echo -3;
                 return;             
             }
                
             
         }else
         {  
             echo -2;
             return;
         }
           
        }else if(!empty($_POST) and (empty($_FILES) or (isset($_FILES) and $_FILES['mcportada']['error']==4)))
        {
            $album->id_perfil = Yii::app()->user->id;
            $album->nombre = $_POST['name'];
            $album->fecha = time();
            $album->tipo = 2;
            if($album->save())
            {
                 $ft = CHtml::image(Yii::app()->request->baseUrl."/uphoto/default_album.png", "Imagen de Perfil");
                $bimagen = '<div class="box-album">'.CHtml::link($ft,array("fotos/misfotos","album"=>$album->idmcategoria));
                $bimagen .= "<span>".$album->nombre."(0)</span> </div>";
                echo $bimagen;
            }else{
                echo -1;
            }
        }else if(!empty($_POST) and !empty($_FILES))
        {
            $dir = Yii::getPathOfAlias('webroot')."/uphoto";
            $file = new CFuploadImg($_FILES['mcportada']['name'],$_FILES['mcportada']['tmp_name'],$_FILES['mcportada']['type'],$_FILES['mcportada']['size'],$_FILES['mcportada']['error']);
            if($file!=null)
                    $subido =$file->saveAs($dir."/".$file->getName());
            if($subido)
            {
                $imgThumb = Aimagen::createThumbnail($file->getName(), $file->getType(), "uphoto", "uthumb", 224, 264);
                if(!is_bool($imgThumb))
                {
                    $album->id_perfil = Yii::app()->user->id;
                    $album->nombre = $_POST['name'];
                    $album->fecha = time();
                    $album->tipo = 2;
                    if($album->save())
                     {
                            $media = new Cfmedia();                         
                             $media->id_mCategoria = $album->idmcategoria;
                             $media->idPrivcm = 1;
                             $media->nombre=$file->getName();
                             $media->directorio="uphoto";
                             $media->ruta = $dir;
                             $media->size = $file->getSize();
                             $media->fecha = microtime(true);
                         if($media->validate())
                         {
                          if($media->save())
                          {
                             $img = new Cfimagen();
                             $img->id_media = $media->idmedia;
                             $img->imgHeight = Aimagen::$alto;
                             $img->imgWidth = Aimagen::$ancho;
                             $img->nom_thumb = $imgThumb['namethumb'];
                             $img->thumb_path = "uthumb";                                 
                             $img->thumbWidth = 224;
                             $img->thumbHeight = 264; 
                             $img->en_perfil = 0;
                             if($img->save())
                             {
                                $album->portada = $media->idmedia;
                                if($album->update())
                                {
                                    $ft = CHtml::image(Yii::app()->request->baseUrl."/".$img->thumb_path."/".$img->nom_thumb, "Imagen de Perfil");
                                    $bimagen = '<div class="box-album">'.CHtml::link($ft,array("fotos/misfotos","album"=>$album->idmcategoria));
                                    $bimagen .= "<span>".$album->nombre."(1)</span> </div>";
                                    echo $bimagen;
                                }else{
                                    echo -6;
                                    return; 
                                }

                             }else{
                                     echo -5;
                                     return;             
                                 }
                          } 
                         }
                    }
                }                
            }
            
        }
            
      }
   
}

?>
