<?php
if(Cfamistad::model()->exists("id_User=".Yii::app()->user->id." and idamigo=".$data->iduser." and confirmado=1"))
{
    if($data->tipo=='amistad'){
    $executor = Yii::app()->db;
    $Sqlagregados  = "select idamigo from cfamistad where id_User=".$data->iduser." and solicitante=1 and confirmado=1";
    $agregador=$executor->createCommand($Sqlagregados)->queryAll();
    if($agregador != null and count($agregador)>0)
        echo Yii::app()->getController()->renderPartial('//presentacion/tipos/amigo',array('model'=>$agregador,'amigo'=>$data->iduser,'fecha'=>$data->fecha),true);
    }
    
            switch($data->tipo)
            {
                case 'estado':
                    $model = Cfestado::model()->find('idestado='.$data->idestado);
                    if($model!=null)
                        echo Yii::app()->getController()->renderPartial('//presentacion/tipos/estado',array('model'=>$model),true);
                    $model=null;
                    break;
                case 'nota':
                    $model = Cfnotas::model()->find('idnotas='.$data->idnota);
                    if($model!=null)
                        echo Yii::app()->getController()->renderPartial('//presentacion/tipos/nota',array('data'=>$model),true);
                    $model=null;
                    break;
                case 'album':
                    $model = Cfmediacategoria::model()->find('id_perfil='.$data->idalbum);;
                    if($model!=null)
                        echo Yii::app()->getController()->renderPartial('//presentacion/tipos/album',array('model'=>$model),true);
                    $model=null;
                    break;
                case 'comentario':
                    $model = Cfcomentario::model()->find('idcomentario='.$data->idcomentario." and tipo='coment'");
                    if($model!=null)
                        echo Yii::app()->getController()->renderPartial('//presentacion/tipos/comentario',array('data'=>$model),true);
                    break;
                
            }
}
?>
