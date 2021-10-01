<?php
echo "SEGUNDO PASO";
?>
<div class="containerup">
<h3>Sube una imagen</h3>
<div class="u-photo">
    
    <?php 
    $model =isset($model)?$model:new Upfoto();
    echo $foto;
    ?>
</div>
<div class="form-pic">
<?php 
//echo $subido;
echo CHtml::beginForm('','POST',array('enctype'=>'multipart/form-data'));
echo CHtml::error($model, 'foto');
echo CHtml::activeFileField($model,'foto');
echo CHtml::submitButton('Subir Imagen');
echo CHtml::endForm();
?>    
    
</div>
<?php echo CHtml::link('Omitir','#')." - ".CHtml::link('Anterior','personal')." - ".CHtml::link('Siguiente',array('perfil/misDatos')); ?>
</div>
