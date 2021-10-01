<div class="span-12 p-estado portlet">
    <div class="pimg">
            <?php $pf = Cfperfil::model()->findByPk($data->usuario);
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
                <?php echo $data->titulo?>
        </div>
    </div>
    
    <div class="p-contenido nt-content">
         <ul>
            <li><?php echo CHtml::link("Ver y comentar",array('notas/nt','ui'=>$data->usuario,'nota'=>$data->idnotas,'n'=>$data->titulo))?></li>
            <li>Fecha:<?php echo date("d/m/Y", $data->fechamodificado)?></li>    
            <li>Hora: <?php echo date("h:i:s", $data->fechamodificado)?></li>    
        </ul>
        <?php echo $data->contenido;?>  
       
    </div>
   </div>     
</div> 

