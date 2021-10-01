<?php
/**
 * Description of NotificacionesController
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class NotificacionesController extends CController{
    public $layout='//layouts/columnperfil';
    
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
				'actions'=>array('index','notificar'),
				'users'=>array('@'),
                              ),
                        array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionIndex()
        {
            
        }
        
        public function actionNotificar()
        {
            $model = Cfactividad::model()->findAll("tipo in ('comentario','amistad')");
            echo $this->renderPartial('_item',array('model'=>$model),true);            
        }
}

?>
