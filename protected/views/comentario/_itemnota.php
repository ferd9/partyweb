<div class="comment-foto">
 <div class="info-top">
     <?php $pf = Cfperfil::model()->findByPk($data->idUser);
                   $foto = CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default.png', 'Sin Foto');
                   if(is_numeric($pf->foto))
                   {
                       $media = Cfmedia::model()->findByPk($pf->foto);
                       $imagen = Cfimagen::model()->find("id_media=".$media->idmedia." and en_perfil=1");
                         if($imagen != null)
                            $foto = CHtml::image(Yii::app()->request->baseUrl."/".$imagen->thumb_path."/".$imagen->nom_thumb, "Imagen de Perfil");
                   }
                   echo $foto;
            ?>
     <ul>
         <li>Fecha: <?php echo date("d/m/Y", $data->fecha); ?></li>
         <li>Hora: <?php echo date("H:i:s", $data->fecha); ?></li>
         <?php 
         $us = -1;
         if(isset($_GET['iu']))
         {
            $us = $_GET['iu']; 
         }else if(isset($iu))
         {
             $us = $iu;
         }
         
         if($us == Yii::app()->user->id){?>
            <li>Eliminar Comentario</li>
         <?php }?>
     </ul>
     <div class="clear"></div>
 </div>
 <div class="content-coment">
     <?php echo $data->contenido?>
     <div class="clear"></div>
 </div>    
</div>