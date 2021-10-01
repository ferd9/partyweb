<?php $this->beginContent('//layouts/perfil'); ?>
<div class="span-3">
	<div id="sidebar">
	
	</div><!-- sidebar -->
</div>
<div class="span-12">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-7 portlet last">
    <div class="portlet-header"><h4><?php echo $this->headerMenu ?></h4></div>
    <div class="portlet-content">
	<div id="sidebar">
	<?php
		echo $this->menu;
	?>
	</div><!-- sidebar -->
        <div class="clearfix">  </div>
     </div>
    
    <div class="portlet x3 spaceleft">
 <div class="portlet-header"><h4>Publicaciones Anónimos</h4></div> 
 <div class="portlet-content">
	<ul id="invoice_actions">
                 <?php $posts = Yii::app()->db->createCommand("select idapost, titulo from cfapost order by fecha desc limit 7")->queryAll();
            ?>
            <?php foreach($posts as $post){?>
                <li class="send">
                <?php 
                    $tt = $post['titulo'];
                    if(strlen($post['titulo'])>34)
                    {
                       $tmp = str_split($post['titulo'], 31);
                       $tt=$tmp[0]."...";
                    }                        
                                       
                echo CHtml::link($tt,array('anonimos/default/comentspost','id'=>$post['idapost']));
                ?>
                </li>               
             <?php }?>   
        </ul>
</div>
</div>
    
    <div class="portlet x3">
<div class="portlet-header"><h4>Publicaciones Registrados</h4></div> 
 <div class="portlet-content">

        <ul id="invoice_actions">
            <?php $notas = Yii::app()->db->createCommand("select idnotas, titulo, usuario from cfnotas where publicado='si' and publico = 1 and estado=1 order by fechamodificado desc limit 7")->queryAll();
            ?>
            <?php foreach($notas as $nota){?>
                <li class="send">
                <?php 
                    $tt = $nota['titulo'];
                    if(strlen($nota['titulo'])>34)
                    {
                       $tmp = str_split($nota['titulo'], 31);
                       $tt=$tmp[0]."...";
                    }                        
                                       
                echo CHtml::link($tt,array('notas/nt','ui'=>$nota['usuario'],'nota'=>$nota['idnotas'],'n'=>$nota['titulo']));
                ?>
                </li>               
             <?php }?>   
        </ul>
</div>
</div>

 <div class="portlet x3">
<div class="portlet-header"><h4>Imagenes Recientes</h4></div> 
 <div class="portlet-content">
	
        <ul id="invoice_actions">
            <?php $images = Yii::app()->db->createCommand("select * from aimagen order by fecha desc limit 7")->queryAll();
            ?>
            <?php foreach($images as $imagen){?>
                <li class="send">
                <?php $img= Yii::app()->request->baseUrl."/".$imagen['thumb_path']."/".$imagen['nom_thumb']; 
                        $im = Chtml::image($img, $imagen['nombre'],array('width'=>'45','height'=>'30'));
                        echo CHtml::link($im,array('anonimos/media/comentar','id'=>$imagen['idaimagen']));
                        ?>
                </li>               
            <?php }?>
        </ul>
</div>
</div>   
    
    
</div>
<?php $this->endContent(); ?>