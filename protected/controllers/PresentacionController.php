<?php

/**
 * Description of PresentacionController
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class PresentacionController extends CController{
    
    public $layout='//layouts/intro';
	
    public $menu="";
    public $headerMenu = "Sin novedad";
	
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
				'actions'=>array('index'),
				'users'=>array('@'),
                             ),	
                        array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionIndex()
        {   
            $model = Cfactividad::model();
            $this->render("index",array('model'=>$model));
        }
}

?>
