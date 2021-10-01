<?php
/**
 * Description of CDataPerfil
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class CDataPerfil extends CWidget{
    
    
    public $islogin = false;
    public $ouwner;
    private $imagen;
    public $perfil;
    public $user;
    public $boxCss = array(
        'imagenperfi'=>'imagenperfi',
        'infop'=>'infop',
        'acciones'=>'acciones'
        );
    public function run()
    {        
       $this->getImg();
       
       $this->render("boxintro",array('boxCss'=>$this->boxCss,
           'perfil'=>$this->perfil,
           'imagen'=>$this->imagen,
           'ouwner'=>$this->ouwner,
           'islogin'=>$this->islogin    
               )
           );
    }
    
    private function getImg()
    {
        $media = Cfmedia::model()->findByPk($this->perfil->foto);
        if($media != null)
            $this->imagen = Cfimagen::model()->find("id_media=".$media->idmedia." and en_perfil=1");
    }
}

?>
