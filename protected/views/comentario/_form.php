<?php 
Yii::app()->clientScript->registerScript('aComt',"
    $('#bsend').click(function(){
    alert('Has hecho click');
})
         ",CClientScript::POS_END);
?>
<div class="form">

<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfomentario-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($comentario); ?>
        <?php echo $form->errorSummary($estado); ?>

	
	<div class="row">		
		<?php echo $form->textField($estado,'enlace'); ?>
		<?php echo $form->error($estado,'enlace'); ?>
	</div>

	<div class="row">		
		<?php echo $form->textArea($comentario,'contenido'); ?>
		<?php echo $form->error($comentario,'contenido'); ?>
	</div> 
	<div class="row buttons">
		<?php echo CHtml::Button("Actualiar estado",array('id'=>'bsend')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
