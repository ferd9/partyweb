<div class="span-12 p-estado portlet">
    <div class="pimg">
            <?php $pf1 = Cfperfil::model()->findByPk($amigo);
                   $foto = CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default.png', 'Sin Foto');
                   if(is_numeric($pf1->foto))
                   {
                       $media = Cfmedia::model()->findByPk($pf1->foto);
                       $imagen = Cfimagen::model()->find("id_media=".$media->idmedia." and en_perfil=1");
                         if($imagen != null)
                            $foto = CHtml::image(Yii::app()->request->baseUrl."/".$imagen->thumb_path."/".$imagen->nom_thumb, "Imagen de Perfil");
                   }
                   echo CHtml::link($foto,array('perfil/index','id'=>$pf1->idPerfil));
            ?>
     </div>
    <div class="column-info-right portlet">
    <div class="p-head">        
        <div class="pdescription">            
                <?php echo $pf1->nombre;?> Agrego nuevos amigos
        </div>
    </div>
    
    <div class="p-contenido">        
        <?php foreach($model as $data){ 
            if($data['idamigo'] != Yii::app()->user->id ){?>
         <?php $pf = Cfperfil::model()->findByPk($data['idamigo']);
                   $foto = CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default.png', 'Sin Foto',array('width'=>'80px','height'=>'60px'));
                   if(is_numeric($pf->foto))
                   {
                       $media = Cfmedia::model()->findByPk($pf->foto);
                       $imagen = Cfimagen::model()->find("id_media=".$media->idmedia." and en_perfil=1");
                         if($imagen != null)
                            $foto = CHtml::image(Yii::app()->request->baseUrl."/".$imagen->thumb_path."/".$imagen->nom_thumb, "Imagen de Perfil",array('width'=>'80px','height'=>'60px'));
                   }
                   echo CHtml::link($foto,array('perfil/index','id'=>$pf->idPerfil));
            ?>
        <?php }} ?>
        
        <ul>                    
            <li>N de Amigos Agregados: <?php echo count($model); ?></li>    
            <li>Fecha:<?php echo date("d/m/Y", $fecha)?></li>    
            <li>Hora: <?php echo date("h:i:s", $fecha)?></li>    
        </ul>
    </div>
      </div>
</div> 
