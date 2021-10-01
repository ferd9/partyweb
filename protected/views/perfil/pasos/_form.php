
<div class="formee-msg-info">

<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfubitacora-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'formee')
)); ?>

    <div class="formee-msg-info"><p class="note">Fields with <span class="required">*</span> are required.</p></div>
	

	<?php echo $form->errorSummary($model); ?>
<fieldset>
    <legend>MARQUETEATE</legend>
	<div class="grid-4-12">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="grid-6-12">
		<?php echo $form->labelEx($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos'); ?>
		<?php echo $form->error($model,'apellidos'); ?>
	</div>
        <div class="grid-4-12 clear">
		<?php echo $form->labelEx($model,'estado_senti'); ?>
		<?php echo $form->dropDownList($model,'estado_senti',Cfperfil::getEstados(),
                        array(
                            'options'=>array($model->estado_senti=>array('selected'=>true)),                    
                    'empty'=>'¿Cuál es tu situacion?')
                        ); ?>
		<?php echo $form->error($model,'estado_senti'); ?>
	</div>

	<div class="grid-4-12 clear">
		<?php echo $form->labelEx($model,'nextel'); ?>
		<?php echo $form->textField($model,'nextel'); ?>
		<?php echo $form->error($model,'nextel'); ?>
	</div>

	<div class="grid-4-12">
		<?php echo $form->labelEx($model,'movil'); ?>
		<?php echo $form->textField($model,'movil'); ?>
		<?php echo $form->error($model,'movil'); ?>
	</div>

	<div class="grid-4-12">
		<?php echo $form->labelEx($model,'fijo'); ?>
		<?php echo $form->textField($model,'fijo'); ?>
		<?php echo $form->error($model,'fijo'); ?>
	</div>
    
        <div class="grid-8-12 clear">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion'); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="grid-4-12 clear">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Grabar'); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->