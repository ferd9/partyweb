<?php if(isset($elpost)){
    $this->setPageTitle($elpost->titulo);
    ?>  

       <div class="portlet x12">
        <div class="portlet-header"><h4> <?php echo $elpost->titulo; ?></h4></div>   
         <div class="portlet-content img-apost">
             <?php if($laimg != null) {          
                    echo $laimg;
                 } ?>
            <?php echo $elpost->contenido;?>
         </div>     
       </div>    

    
<?php } ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfacoment-coments-form',
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'formee'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'idapost',array('value'=>$elpost->idapost)); ?>
        <?php echo $form->hiddenField($model,'fecha',array('value'=>time())); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'contenido'); ?>
		<?php echo $form->textArea($model,'contenido',array('class'=>'tinymce','cols'=>'40','rows'=>'4')); ?>
		<?php echo $form->error($model,'contenido'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar Comentario'); ?>
	</div>

<?php $this->endWidget();?>

</div>

<?php 
    $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
 ?>
