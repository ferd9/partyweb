<div class="pfotos">
    <?php 
        $query = "select * from cfmediacategoria where id_perfil=".$iu." order by fecha desc";
        $albums = Yii::app()->db->createCommand($query)->queryAll(); 
        foreach($albums as $album){        
      ?>
    <div class="box-album">
        <?php 
            $ft = CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default_album.png', 'Sin Foto');
            if(is_numeric($album['portada']))
                $portada = Cfimagen::model()->find("id_media=".$album['portada']);
            if($portada != null)
                $ft = CHtml::image(Yii::app()->request->baseUrl."/".$portada->thumb_path."/".$portada->nom_thumb, "Imagen de Perfil");
            echo CHtml::link($ft,array("fotos/showpic",'iu'=>$iu,"album"=>$album['idmcategoria']));
            $portada = null;
        ?>
        <span><?php echo $album['nombre']." (".Cfmedia::model()->count("id_mCategoria=".$album['idmcategoria']).")";?></span>
    </div> 
    <?php } ?>
<div class="clear"></div>    
</div>
