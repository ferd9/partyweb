<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotasController
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class NotasController extends CController {
    
    public $layout='//layouts/columnnotas';
	
    public $menu=array();
    
    public $estados = "";//$this->renderPartial('/cestados/listar');
	
    public $breadcrumbs=array();
    
    
        
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
				'actions'=>array('nt'),
				'users'=>array('*'),
                              ),
			array('allow',  
				'actions'=>array('index','lista',
                                                 'actualizar','dlt',
                                                 'restaurar','finaldlt',
                                                 'publicar','muestraaamigos',
                                                 'muestraatodos','archivar'),
				'users'=>array('@'),
                              ),
                        array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionIndex()
        {
            $this->layout='//layouts/columnperfil';
            $model = new Cfnotas();
            if(isset($_POST['Cfnotas']))
            {
                $model->attributes = $_POST['Cfnotas'];
                if(isset($_POST['publicar']))
                {
                    $model->publicado='si';
                    $publcadas = new Cfnotaspublicadas();
                    if($model->save())
                    {
                        $publcadas->id_notas = $model->idnotas;
                        $publcadas->fecha = time();
                        if($publcadas->save())
                        {
                           $act = new Cfactividad();
                           $act->iduser= Yii::app()->user->id;
                           $act->idnota=$model->idnotas;
                           $act->tipo=Cfactividad::$tipos['Nota'];
                           $act->fecha=$model->fechacreado;
                           $act->save();
                           $this->redirect(array('notas/lista','ui'=>Yii::app()->user->id));
                        }
                            
                        else
                            print_r($publcadas->getErrors());
                    }
                }else if(isset($_POST['grabar']))
                {
                    $model->publicado='no';
                    $pendientes = new Cfnotaspendientes();
                    if($model->save())
                    {
                        $pendientes->id_notas = $model->idnotas;
                        $pendientes->fecha = time();
                        if($pendientes->save())
                            $this->redirect(array('notas/lista','ui'=>Yii::app()->user->id));
                         else
                            print_r($pendientes->getErrors());
                    }
                }
               
            }
            $this->render('index',array('model'=>$model));
        }
        
        public function actionActualizar($ui,$in)
        {
            $this->layout='//layouts/columnperfil';
            if(is_numeric($ui) and is_numeric($in))
            {   
                $model = Cfnotas::model()->find("idnotas=".$in." and usuario=".$ui);
            }else
            {
                echo "Error!!";
            }
            
            if(isset($_POST['Cfnotas']))
            {
                $model->attributes = $_POST['Cfnotas'];
                if($model->update())
                {
                   $act = Cfactividad::model()->find("idnota=".$model->idnotas);
                   if($act!=null)
                   {
                      $act->fecha=$model->fechamodificado;
                      $act->save(); 
                   }                   
                   $this->redirect(array('notas/lista','ui'=>Yii::app()->user->id,'tipo'=>'publish'));
                }                    
            }
            $this->render('index',array('model'=>$model)); 
        }
        
        public function actionLista($ui,$tipo='',$eliminado='')
        {
            $model = Cfnotas::model();
            if(is_numeric($ui)){
                $adp = $model->search($ui,$tipo,$eliminado);
                $this->render('listaNotas',array('adp'=>$adp,'ui'=>$ui));
            }                
            else
                $this->redirect('site/index');
        }
        
        /***action para visualizar nota publicada***/
        public function actionNt($ui,$nota,$n="")
        {
            if(is_numeric($ui) and is_numeric($nota))
            {
                $model2 = new Cfcomentario();
                if(Yii::app()->user->isGuest)
                     $model = Cfnotas::model()->find("idnotas=".$nota." and usuario=".$ui." and publico=1 and estado = 1");
                else
                     $model = Cfnotas::model()->find("idnotas=".$nota." and usuario=".$ui." and estado = 1");
                if($model !=null)
                    $this->render('vnotas',array('model'=>$model,'model2'=>$model2));
                 else
                     echo "noexiste";
            }
        }
        
        public function actionDlt($ui,$nota)
        {
            if(is_numeric($ui) and is_numeric($nota))
            {
                $model = Cfnotas::model()->find("idnotas=".$nota." and usuario=".$ui);
                $model->estado = 0;
                if($model->update())
                    $this->redirect(array("notas/lista",'ui'=>$ui));
            }
        }
        
        public function actionRestaurar($ui,$nota)
        {
            if(is_numeric($ui) and is_numeric($nota))
            {
                $model = Cfnotas::model()->find("idnotas=".$nota." and usuario=".$ui);
                $model->estado = 1;
                if($model->update())
                    $this->redirect(array("notas/lista",'ui'=>$ui));
            }
        }
        
        public function actionFinaldlt($ui,$nota)
        {
            if(is_numeric($ui) and is_numeric($nota))
            {
                $model = Cfnotas::model()->find("idnotas=".$nota." and usuario=".$ui);                
                if($model->delete())
                    $this->redirect(array("notas/lista",'ui'=>$ui,'eliminado'=>'0'));
            }
        }
        
        /***action para publicar notas pendientes***/
        public function actionPublicar($ui,$nota)
        {
            if(is_numeric($ui) and is_numeric($nota))
            {
                $model = Cfnotas::model()->find("idnotas=".$nota." and usuario=".$ui); 
                $model->publicado=1;
                if($model->update())
                {
                   $act = new Cfactividad();
                   $act->iduser= Yii::app()->user->id;
                   $act->idnota=$model->idnotas;
                   $act->tipo=Cfactividad::$tipos['Nota'];
                   $act->fecha=$model->fechacreado;
                   $act->save();
                   $this->redirect(array("notas/lista",'ui'=>$ui));
                }
                    
            }
        }
        
        public function actionMuestraatodos($ui,$nota)
        {
            if(is_numeric($ui) and is_numeric($nota))
            {
                $model = Cfnotas::model()->find("idnotas=".$nota." and usuario=".$ui); 
                $model->publico=2; // 2 mostrar a todos
                if($model->update())
                   echo json_encode(array('texto'=>'Mostrar a todos','href'=>$this->createUrl('notas/muestraaamigos',array('ui'=>$ui,'nota'=>$nota))));
            }
        }
        
        public function actionMuestraaamigos($ui,$nota)
        {
            if(is_numeric($ui) and is_numeric($nota))
            {
                $model = Cfnotas::model()->find("idnotas=".$nota." and usuario=".$ui); 
                $model->publico=1;// 1 mostrar a los amisgos
                if($model->update())
                    echo json_encode(array('texto'=>'Mostrar solo a mis amigos','href'=>$this->createUrl('notas/muestraatodos',array('ui'=>$ui,'nota'=>$nota))));
            }
            
        }
        
        public function actionArchivar($ui,$nota)
        {
             if(is_numeric($ui) and is_numeric($nota))
             {
                 $model = Cfnotas::model()->find("idnotas=".$nota." and usuario=".$ui); 
                 $model->archivado = 1;
                    if($model->update())
                        echo json_encode(array('texto'=>'Archivado','href'=>'#ar'));
             }
        }
}

?>
