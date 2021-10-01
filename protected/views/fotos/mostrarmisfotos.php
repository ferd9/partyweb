<div class="pfotos" id="pf">
    <?php 
        $query = "select * from cfmedia where id_mCategoria=".$album." order by fecha desc";
        $fotos = Yii::app()->db->createCommand($query)->queryAll(); 
        foreach($fotos as $foto){        
      ?>
    <div class="box-album">
        <?php $portada = Cfimagen::model()->find("id_media=".$foto['idmedia']);
            $ft = CHtml::image(Yii::app()->request->baseUrl."/".$portada->thumb_path."/".$portada->nom_thumb, "Imagen de Perfil");
            echo CHtml::link($ft,array('fotos/comentarFoto','iu'=>$iu,'album'=>$album,'foto'=>$foto['idmedia']));
        ?>
        <span><?php echo $foto['nombre'];?></span>
    </div> 
    <?php } ?>
<div class="clear"></div>    
</div>
