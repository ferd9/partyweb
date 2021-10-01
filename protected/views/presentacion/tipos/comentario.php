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
            Comento.
            <?php 
                $imagen=null;
                if(is_numeric($data->idcmendia))
                {
                    $media = Cfmedia::model()->findByPk($data->idcmendia);
                    $imagen = Cfimagen::model()->find("id_media=".$media->idmedia);
                } 
                 if($imagen != null){
                     $categoria = Cfmediacategoria::model()->find('idmcategoria='.$media->id_mCategoria);
                 }
              ?>
        </div>
    </div>
    
    <div class="p-contenido">
        <?
        if($imagen != null)
             echo $foto = CHtml::image(Yii::app()->request->baseUrl."/".$imagen->thumb_path."/".$imagen->nom_thumb, "Imagen comentada",array('width'=>'180','height'=>'120'));
        ?>
        <?php echo $data->contenido?>
        <div class="f-incoment" style="display: none;" id="fin<?php echo $data->idcomentario?>">
            <?php 
                echo CHtml::beginForm();
                echo CHtml::textArea("content1", "", array('id'=>'farea'.$data->idcomentario));
                echo CHtml::endForm();
            ?>
        </div>
        <ul>
            <?php if(!is_null($imagen)){?>
             <li><?php echo CHtml::link("Comentar",array('fotos/comentarFoto','iu'=>$categoria->id_perfil,'album'=>$categoria->idmcategoria,'foto'=>$data->idcmendia))?></li>
              <?php }?>
            <li>Comentarios: <?php echo Cfccomentario::model()->count("idCcomentario=".$data->idcomentario); ?></li>    
            <li>Fecha:<?php echo date("d/m/Y", $data->fecha)?></li>    
            <li>Hora: <?php echo date("h:i:s", $data->fecha)?></li>   
         </ul>
    </div>
    </div>    
</div> 
