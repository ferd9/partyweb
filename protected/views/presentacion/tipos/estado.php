<?php $data=Cfcomentario::model()->find('idcomentario='.$model->id_ecomentario);?>
<div class="span-12 p-estado portlet">
    <div class="pimg">
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
     </div>
    
    <div class="column-info-right portlet">
    <div class="p-head">        
        <div class="pdescription">
            <?php echo $data->cfestados[0]->enlace?>
        </div>
    </div>
    
    <div class="p-contenido">
        <div class="p-texto">
        <?php echo $data->contenido?>
         </div>
        <div class="f-incoment" style="display: none;" id="fin<?php echo $data->idcomentario?>">
            <?php 
                echo CHtml::beginForm();
                echo CHtml::textArea("content1", "", array('id'=>'farea'.$data->idcomentario));
                echo CHtml::endForm();
            ?>
        </div>
            <ul>
                <li><?php echo CHtml::link("Comentar", "#", array("id"=>$data->idcomentario,'onClick'=>"lcoment(this);return false;"))?></li>
                <li>Comentarios: <?php echo Cfccomentario::model()->count("idCcomentario=".$data->idcomentario); ?></li>    
                <li>Fecha:<?php echo date("d/m/Y", $data->fecha)?></li>    
                <li>Hora: <?php echo date("h:i:s", $data->fecha)?></li>    
            </ul>
    </div>
   </div>
</div> 
