<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of media
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class MediaController extends Controller {
    
    public $layout='/layouts/vistageneral';
    
    public function actionIndex()
    {             
           $criteria=new CDbCriteria(array(			
			'order'=>'fecha DESC',
			'with'=>'cfaimgcoments',
		));		

	   $dataProvider=new CActiveDataProvider('Aimagen', array(
			'pagination'=>array(
				'pageSize'=>35,
			),
			'criteria'=>$criteria,
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));          
    }
    
    public function actionComentar()
    {
        $imgComentario = new Cfaimgcoment();
        if(is_numeric($_GET['id']) and !isset($_POST['Cfaimgcoment']))
        {
            $model=new Cfacoment;
             $criteria2= new CDbCriteria(array(
                     'condition'=>'idaimagen ='.$_GET['id'],
                     'with'=>'idapost0'
                    )); 
        
            $tmppost = Apostimg::model()->find($criteria2);
            if($tmppost != null){                              
                
                $comentarios=new Cfacoment('search');
                $comentarios->unsetAttributes();  // clear any default values
                if(isset($_GET['Cfacoment']))
			$comentarios->attributes=$_GET['Cfacoment'];
                $this->redirect(array('default/comentspost','id'=>$tmppost->idapost));              
            }else
            {
                $model = Aimagen::model()->findByPk($_GET['id']);                
                $this->render('comentar',array(
                    'model'=>$model,
                    'imgComentario'=>$imgComentario
                ));
            }
             
        }
        
        if(isset($_POST['Cfaimgcoment']))
        {
           $imgComentario->attributes =  $_POST['Cfaimgcoment'];
           if($imgComentario->validate())
           {
               if($imgComentario->save())
               {
                    $model = Aimagen::model()->findByPk($_POST['Cfaimgcoment']['idaimagen']);
                    $this->redirect(array('comentar',
                        'id'=>$imgComentario->idaimagen,                        
                    )); 
                   return;
                    
               }else
               {
                   echo "<br/><br/><br/><br/>";
                   print_r($imgComentario->getErrors()); 
               }
           }else{
               echo "<br/><br/><br/><br/>";
               print_r($imgComentario->getErrors());
           }  
        }
        
    }
   
}

?>
