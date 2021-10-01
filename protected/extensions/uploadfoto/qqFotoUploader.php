<?php

/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    private $idImagen = -1;
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {    
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        $pathinfo = pathinfo($this->getName());    
        
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
         $imgThumb = Aimagen::createThumbnail($this->getName(), $ext, "uphoto", "uthumb", 224, 264);
         if(!is_bool($imgThumb))
         {
             $dir = Yii::getPathOfAlias('webroot')."/uphoto";
             $media = new Cfmedia();
             $media->id_mCategoria = $_GET['album'];
             $media->idPrivcm = 1;
             $media->nombre=$this->getName();
             $media->directorio="uphoto";
             $media->ruta = $dir;
             $media->size = $this->getSize();
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
                        $ft = CHtml::image(Yii::app()->request->baseUrl."/".$img->thumb_path."/".$img->nom_thumb, "Imagen de Perfil");
                        $this->idImagen = '<div class="box-album">'.CHtml::link($ft,array('fotos/comentarFoto','iu'=>Yii::app()->user->id,'album'=>$_GET['album'],'foto'=>$media->idmedia));
                        $this->idImagen .= "<span>".$media->nombre."</span> </div>";
                     }else
                         return false;
                  }else
                      return false;
             }else
                 return false;
             
         }else
         {
             return false;
         }
        
        fclose($target);
        
        return true;
    }
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }
    
    public function getId(){
        return $this->idImagen;
    }
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {  
    private $idImagen = -1;
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
            return false;
         }
         
          $imgThumb = Aimagen::createThumbnail($_FILES['qqfile']['name'], $_FILES['qqfile']['type'], "uphoto", "uthumb", 224, 264);
         if(!is_bool($imgThumb))
         {
             $dir = Yii::getPathOfAlias('webroot')."/uphoto";
             $media = new Cfmedia();
             $media->id_mCategoria = $_GET['album'];
             $media->idPrivcm = 1;
             $media->nombre=$this->getName();
             $media->directorio="uphoto";
             $media->ruta = $dir;
             $media->size = $this->getSize();
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
                        $ft = CHtml::image(Yii::app()->request->baseUrl."/".$img->thumb_path."/".$img->nom_thumb, "Imagen de Perfil");
                        $this->idImagen = '<div class="box-album">'.CHtml::link($ft,array('fotos/comentarFoto','iu'=>Yii::app()->user->id,'album'=>$_GET['album'],'foto'=>$media->idmedia));
                        $this->idImagen .= "<span>".$media->nombre."</span> </div>";
                     }else
                         return false;
                  }else
                      return false;
             }else
                 return false;
             
         }else
         {
             return false;
         }
        return true;
    }
    function getName() {
        return $_FILES['qqfile']['name'];
    }
    function getSize() {
        return $_FILES['qqfile']['size'];
    }
    
    public function getId(){
        return $this->idImagen;
    }
}

class qqFotoUploader {
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760,$album=-1){        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
            
        $this->allowedExtensions = $allowedExtensions;        
        $this->sizeLimit = $sizeLimit;
        
        $this->checkServerSettings();       

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false; 
        }
    }
    
    private function checkServerSettings(){        
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';             
            die("{'error':'increase post_max_size and upload_max_filesize to $size - $postSize - $uploadSize'}");    
        }        
    }
    
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
    
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
        if (!is_writable($uploadDirectory)){
            return array('error' => "Server error. Upload directory isn't writable.");
        }
        
        if (!$this->file){
            return array('error' => 'No files were uploaded.');
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            return array('error' => 'File is empty');
        }
        
        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }
        
        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }
        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }
        
        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)){
            return array('success'=>true,'foto'=>$this->file->getId());
        } else {
            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
        
    }    
}

/*// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array();
// max file size in bytes
$sizeLimit = 5 * 1024 * 1024;

$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
$result = $uploader->handleUpload('uploads/');
// to pass data through iframe you will need to encode all html tags
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);*/
