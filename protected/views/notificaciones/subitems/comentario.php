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
            <li><?php echo CHtml::link("Comento tu foto",array('fotos/comentarFoto','iu'=>Yii::app()->user->id,'album'=>$album,'foto'=>$data->idcmendia));?></li>
       </ul>
            <div style="clear:left;"></div>
      </div>        
