<?php
/**
 * Description of ComentarioController
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class ComentarioController extends CController{
    
    public $layout='//layouts/columnperfil';
	
    public $menu=array();
	
    public $breadcrumbs=array();
    
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        //'ajaxOnly + comentarios'
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
				'actions'=>array('index','comentarios',
                                                 'addComentario','comentarFoto',
                                                 'upFileComent','comentarNota'),
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
        
        public function actionComentarios()
        {
            /*$comentario = new Cfcomentario();
            $estado = new Cfestado();
            echo $this->renderPartial('_form',array(
               'comentario'=>$comentario,
               'estado'=>$estado
               ),true);*/
            echo "ok";
        }
        
        public function actionAddComentario()
        {
            $comentario = new Cfcomentario();
            $estado = new Cfestado();
            $comentario->attributes = $_POST['Cfcomentario'];
            $comentario->idUser = Yii::app()->user->id;
            $comentario->idprivcm = 1;
            $comentario->fecha=time();
            $comentario->tipo='status';
            $estado->attributes = $_POST['Cfestado'];
            $respuesta = "error";
            if($comentario->validate())
            {
                if($comentario->save())
                {
                    $estado->id_ecomentario = $comentario->idcomentario;
                    if($estado->validate())
                    {
                       if($estado->save())
                       {
                           $act = new Cfactividad();
                           $act->iduser= Yii::app()->user->id;
                           $act->idestado=$estado->idestado;
                           $act->tipo=Cfactividad::$tipos['Estado'];
                           $act->fecha=$comentario->fecha;
                           $act->save();
                           
                           
                           $respuesta = "<h4>".$estado->enlace."</h4>";
                           $respuesta .= "<p>".$comentario->contenido."</p>";
                       }
                    }
                }
            }
            
            echo $respuesta;
        }
        
        public function actionComentarFoto()
        {
            $data = -1;          
            if(empty($_POST['Cfcomentario']['contenido']))
            {
                echo $data = -2;
            }else
            {
                $model = new Cfcomentario();
                $model->attributes = $_POST['Cfcomentario'];
                $model->idUser = Yii::app()->user->id;
                $model->idprivcm = 1;
                $model->fecha = time();
                $model->tipo = 'coment';
                if($model->save())
                {
                   $act = new Cfactividad();
                   $act->iduser= $model->idUser;
                   $act->idcomentario=$model->idcomentario;
                   $act->tipo=Cfactividad::$tipos['Comentario'];
                   $act->fecha=$model->fecha;
                   $act->save();
                   
                   echo $this->renderPartial('_item',array('data'=>$model,'iu'=>$_POST['user']),true);
                }
                    
            }
            //print_r($_POST);
        }
        
        public function actionComentarNota()
        {
            $data = -1;          
            if(empty($_POST['Cfcomentario']['contenido']))
            {
                echo $data = -2;
            }else
            {
                $model = new Cfcomentario();
                $model->attributes = $_POST['Cfcomentario'];
                $model->idUser = Yii::app()->user->id;                 
                $model->idprivcm = 1;
                $model->fecha = time();
                $model->tipo = 'coment';
                if($model->save())
                {
                   $act = new Cfactividad();
                   $act->iduser= $model->idUser;
                   $act->idcomentario=$model->idcomentario;
                   $act->tipo=Cfactividad::$tipos['ComentPost'];
                   $act->fecha=$model->fecha;
                   $act->save();
                   
                   echo $this->renderPartial('_itemnota',array('data'=>$model,'iu'=>$_POST['user']),true);
                }
                    
            }
        }
        
        public function actionUpFileComent()
        {
            echo json_encode(array('success'=>true,));
        }
}

?>
