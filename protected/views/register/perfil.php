<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfperfil-perfil-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'edad'); ?>
		<?php echo $form->textField($model,'edad'); ?>
		<?php echo $form->error($model,'edad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido'); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nextel'); ?>
		<?php echo $form->textField($model,'nextel'); ?>
		<?php echo $form->error($model,'nextel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'celular'); ?>
		<?php echo $form->textField($model,'celular'); ?>
		<?php echo $form->error($model,'celular'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tel_fijo'); ?>
		<?php echo $form->textField($model,'tel_fijo'); ?>
		<?php echo $form->error($model,'tel_fijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado_senti'); ?>
		<?php echo $form->textField($model,'estado_senti'); ?>
		<?php echo $form->error($model,'estado_senti'); ?>
	</div>

	<div class="row">
            
		<?php echo $form->labelEx($model,'f_nacimiento'); ?>
		<?php echo $form->textField($model,'f_nacimiento'); ?>
		<?php echo $form->error($model,'f_nacimiento'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->