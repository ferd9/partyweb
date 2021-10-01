<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CFuploadImg
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class CFuploadImg extends CUploadedFile{
    
    private $height;
    private $width;
    private $imagen;
    
    public function __construct($name,$tempName,$type,$size,$error)
    {
        parent::__construct($name,$tempName,$type,$size,$error);       
    }
    
    public function getHeight()
    {
        return $this->height;
    }
    
    public function getWidth()
    {
        return $this->width;
    }
    
    private function setDimension()
    {
        $largeImg = "";
        switch($this->getType())
        {
            case "image/jpg":
            case "image/jpeg":
                $largeImg = imagecreatefromjpeg($this->imagen);
                break;
            case "image/png":
                $largeImg = imagecreatefrompng($this->imagen);
                break;
            case "image/gif":
                $largeImg = imagecreatefromgif($this->imagen);
                break;
        }
        $this->width = imagesx($largeImg);
        $this->height = imagesy($largeImg);
    }
    
    public function saveAs($file,$deleteTempFile=true)
    {   
        if(parent::saveAs($file))
        {
             $this->imagen = $file;
             $this->setDimension();
             return true;
        }else
            return false;
               
    }
    
   
}

?>
