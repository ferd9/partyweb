<?php
/**
 * Description of InformacionController
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class InformacionController extends CController{
     
    public $layout='//layouts/columnperfil';
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        //'ajaxOnly + addFriend'
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
				'actions'=>array('index','notificar'),
				'users'=>array('@'),
                              ),
                        array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionIndex($id)
        {
            $user = Cfusuario::model()->findByPk($id);
            $perfil = Cfperfil::model()->findByPk($user->iduser);
            $foto = CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default.png', 'Sin Foto');
             if(is_numeric($perfil->foto))
             {
                 $media = Cfmedia::model()->findByPk($perfil->foto);
                if($media != null){
                         $imagen = Cfimagen::model()->find("id_media=".$media->idmedia." and en_perfil=1");
                    if($imagen != null){
                         $foto = CHtml::image(Yii::app()->request->baseUrl."/".$imagen->thumb_path."/".$imagen->nom_thumb, "Imagen de Perfil");
                    }
                } 
             }
            $this->render("index",array('user'=>$user,'perfil'=>$perfil,'foto'=>$foto));
        }
}

?>
