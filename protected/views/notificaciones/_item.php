<?php 
if($model != null && count($model)>0)
{   
    $csql = 'select fecha from cfubitacora where iduser='.Yii::app()->user->id." order by fecha desc limit 1";
     $bitacora = Yii::app()->db->createCommand($csql)->queryRow();
     $fecha = strtotime($bitacora['fecha']);
     
    foreach($model as $mdl)
    {
        switch($mdl->tipo){        
           case 'comentario':
                    $data = Cfcomentario::model()->find("idcomentario=".$mdl->idcomentario);
                    $media = Cfmedia::model()->findByPk($data->idcmendia);
                    $usuario = -1;
                    if($media != null)
                        $usuario = $media->idMCategoria->id_perfil;
                   
                    if($data!=null and $usuario==Yii::app()->user->id and $mdl->iduser != Yii::app()->user->id){
                        echo $this->renderPartial('subitems/comentario',array('data'=>$data,'amigo'=>$mdl->iduser,'album'=>$media->idMCategoria->idmcategoria),true);
                        $mdl->mostrado=1;
                        $mdl->update(); 
                    }
                    $data = null;
                    break;
           case 'amistad':
                    $data = Cfamistad::model()->find("idamistad=".$mdl->idamistad." and id_User=".$mdl->iduser);
                    if($data!=null){
                        if($data->idamigo==Yii::app()->user->id and $data->confirmado==0){
                            echo $this->renderPartial('subitems/amistad',array('data'=>$data,'amigo'=>$data->id_User),true);
                        }
                        else if($data->id_User==Yii::app()->user->id and $data->confirmado==1 and $mdl->fecha>=$fecha){
                            echo $this->renderPartial('subitems/amistad',array('data'=>$data,'amigo'=>$data->idamigo),true);
                            $mdl->mostrado=1;
                            $mdl->update();                            
                        }
                       }
                     $data = null;
                    break;      
        }
    }
}
?>

