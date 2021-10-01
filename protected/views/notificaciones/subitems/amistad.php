<?php
 $user = Yii::app()->db->createCommand("select * from cfperfil where idPerfil=".$amigo)->query()->read();
    
        $foto = CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default.png', 'Sin Foto');
        if(is_numeric($user['foto'])){
             $media = Cfmedia::model()->findByPk($user['foto']);
             $imagen = Cfimagen::model()->find("id_media=".$media->idmedia." and en_perfil=1");
             if($imagen != null)
                $foto = CHtml::image(Yii::app()->request->baseUrl."/".$imagen->thumb_path."/".$imagen->nom_thumb, "Imagen de Perfil");
          }
          ?>        
        
        <div class="boxusers" id="bx<?php echo $user['idPerfil'];?>">
      <div class='bimg'> 
          <?php
            echo $foto;
          ?>
      </div>
        <div class="unom">
     <?php 
         echo CHtml::link($user['nombre']." ".$user['apellidos'],array("perfil/index",'id'=>$user['idPerfil']))."</br>";
     ?>
        </div>
        <ul class="olist">
            <?php if($data->confirmado == 0){ ?>
            <li><?php echo CHtml::link("ACEPTAR","#",array('id'=>$user['idPerfil'].'-'.Yii::app()->user->id,'onclick'=>'aceptar(this); return false'));?></li>
            <li><?php echo CHtml::link("RECHAZAR","#",array('id'=>$user['idPerfil'],'onclick'=>'return false'));?></li>
            <?php }?>
            
             <?php if($data->confirmado == 1){ ?>
            <li><?php echo CHtml::link("ACEPTO TU SOLICITUD","#",array('id'=>$user['idPerfil'],'onclick'=>'rechazar(this); return false'));?></li>
             <?php }?>
        </ul>
            <div style="clear:left;"></div>
      </div>        
        
    