<?php
Yii::app()->clientScript->registerScript('allpost',"
 $('.viewpost').mouseover(function(){
 $('#spost').show();
}); 

 $('.viewpost').mouseout(function(){
 $('#spost').hide();
}); 
"
);

/*$this->breadcrumbs=array(
	$this->module->id,
);

echo $this->uniqueId . '/' . $this->action->id;
echo __FILE__;*/
?>


<?php $this->pageTitle=Yii::app()->name; 
$newaimagen=isset($newaimagen)?(int)$newaimagen:0;
?>
<?php if(Yii::app()->user->isGuest) {?>
<div class="span-25 last">    
      
<div class="portlet x4">    
    <div id="header">
	<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>        
    </div><!-- header -->
    <div class="portlet-content">
        
    </div>
</div>
<div class="portlet x8">    
    <div class="portlet-header">
        <h4><?php if(Yii::app()->user->isGuest) {
        echo CHtml::link('Registrarse',array('/site/registro'));
     }?>
     </h4></div> 
    <div class="portlet-content">
    </div>
</div>
</div>
<?php }?> 
<div class="portlet x12">
    <div class="portlet-header"><h4>IMAGENES DE USUARIOS ANONIMOS</h4></div> 
 <div class="portlet-content content-img">
 <?php  $inicio = 0;
    
    switch($newaimagen)
    {
        case 9:
            $inicio = 1;
            break;
        case 10:
            $inicio = 2;
            break;
        case 11:
            $inicio = 3;
            break;
        case 12:
            $inicio = 4;
            break;
        case 13:
            $inicio = 5;
            break;
        case 14:
            $inicio = 6;
            break;
        case 15:
            $inicio = 7;
            break;
    }
    if($newaimagen>=16){  
        $inicio = $newaimagen-8;
    }
    //echo $inicio."  ".$newaimagen."<br>";
     $aimages = Aimagen::model()->findAllBySql("SELECT idaimagen,nombre,imgWidth,imgHeight,thumb_path,nom_thumb  FROM aimagen LIMIT ".$inicio.", ".$newaimagen.";");
    // echo get_class($aimages[0]);
     echo CHtml::beginForm();
     foreach($aimages as $tmpimages)
     {?> 
    <div class="imagebox">
    <?php 
            
        $tmpimg = Yii::app()->request->baseUrl.'/'.$tmpimages->thumb_path.'/'.$tmpimages->nom_thumb; 
        $img= CHtml::image($tmpimg);        
        echo CHtml::link($img,Yii::app()->createAbsoluteUrl('site/aimage',array('id'=>$tmpimages->idaimagen)),array('class'=>'view-aimagen','rel'=>$tmpimages->nombre,'alto'=>$tmpimages->imgHeight));          
    ?></div>
         
   <?php  }
   echo CHtml::endForm();
    ?>   
<div class="clearfix">  </div>
</div>
</div>

<div class="portlet x12">
    <div class="portlet-header"><h4>PUBLICAR POST</h4></div>
    <div class="portlet-content">
  
<div class="forme" style="width: 500px; float: left;">   
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfapost-anonimopost-form',
        'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'formee'),        
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
)); ?>
    

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model2); ?>
        
        <div class="grid-6-12">
          <?php echo $form->labelEx($model2,'anombre'); ?>
             <?php echo $form->textField($model2,'anombre'); ?>
		<?php echo $form->error($model2,'anombre'); ?>
	</div>
        
        <div class="grid-6-12">
		<?php echo $form->labelEx($model2,'email'); ?>
		<?php echo $form->textField($model2,'email',array('size'=>'30')); ?>
		<?php echo $form->error($model2,'email'); ?>
	</div>
        
	<div class="grid-12-12">
		<?php echo $form->labelEx($model2,'titulo'); ?>
		<?php echo $form->textField($model2,'titulo',array('size'=>'30')); ?>
		<?php echo $form->error($model2,'titulo'); ?>
	</div>
        <div class="grid-4-12">
		<?php echo $form->labelEx($model2,'img'); ?>
		<?php echo $form->fileField($model2,'img'); ?>
		<?php echo $form->error($model2,'img');?>
	</div>

	<div class="grid-12-12 clear">
		<?php echo $form->labelEx($model2,'contenido'); ?>
		<?php echo $form->textArea($model2,'contenido',array('class'=>'tinymce','cols'=>'40','rows'=>'4')); ?>
		<?php echo $form->error($model2,'contenido'); ?>
	</div>
        
        <?php if(CCaptcha::checkRequirements()): ?>
	<div class="grid-5-12 clear">
		<?php echo $form->labelEx($model2,'codeVerify'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model2,'codeVerify'); ?>
		</div>
		<div class="hint" style="color: blue;">Genere un codigo nuevo y escriba el texto que se muestra</div>
		<?php echo $form->error($model2,'codeVerify'); ?>
	</div>
	<?php endif; ?>
        
	<div class="grid-3-12 clear">
		<?php echo CHtml::submitButton('Postear',array('submit' => array('default/post'))); ?>
	</div>
            
<?php $this->endWidget();?> 
        
</div><!-- form -->  

<?php echo $this->renderPartial('viewapost',array(),true); ?>
</div>
</div>    


<div class="portlet x3 spaceleft">
 <div class="portlet-header"><h4>Post recientes</h4></div> 
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
                                       
                echo CHtml::link($tt,array('default/comentspost','id'=>$post['idapost']));
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
                        echo CHtml::link($im,array('media/comentar','id'=>$imagen['idaimagen']));
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
                                       
                echo CHtml::link($tt,array('/notas/nt','ui'=>$nota['usuario'],'nota'=>$nota['idnotas'],'n'=>$nota['titulo']));
                ?>
                </li>               
             <?php }?>   
        </ul>
</div>
</div>
<div class="portlet x3">
<div class="portlet-header"><h4>column1 panel 4</h4></div> 
 <div class="portlet-content">
				
        <div id="invoice_total">$4100.00</div>

        <ul id="invoice_actions">
                <li class="send"><a href="javascript:;">Send Invoice</a></li>
                <li class="edit"><a href="javascript:;">Edit Invoice</a></li>
                <li class="print"><a href="javascript:;">Print Invoice</a></li>
                <li class="duplicate"><a href="javascript:;">Duplicate Invoice</a></li>
                <li class="delete"><a href="javascript:;">Delete Invoice</a></li>
                <li class="change"><a href="javascript:;">Change Status</a></li>
        </ul>
</div>
</div>

    
