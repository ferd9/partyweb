<div class="formee-msg-info"> 
   
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

        <div class="row">
          <div class="flabel">  <?php echo $form->labelEx($model2,'anombre'); ?></div>
             <?php echo $form->textField($model2,'anombre'); ?>
		<?php echo $form->error($model2,'anombre'); ?>
	</div>
        
        <div class="row">
		<div class="flabel"><?php echo $form->labelEx($model2,'email'); ?></div>
		<?php echo $form->textField($model2,'email',array('size'=>'30')); ?>
		<?php echo $form->error($model2,'email'); ?>
	</div>
        
	<div class="row">
		<div class="flabel"><?php echo $form->labelEx($model2,'titulo'); ?></div>
		<?php echo $form->textField($model2,'titulo',array('size'=>'30')); ?>
		<?php echo $form->error($model2,'titulo'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model2,'img'); ?>
		<?php echo $form->fileField($model2,'img'); ?>
		<?php echo $form->error($model2,'img');?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model2,'contenido'); ?>
		<?php echo $form->textArea($model2,'contenido',array('class'=>'tinymce','cols'=>'40','rows'=>'4')); ?>
		<?php echo $form->error($model2,'contenido'); ?>
	</div>
        
        <?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model2,'codeVerify'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model2,'codeVerify'); ?>
		</div>
		<div class="hint" style="color: blue;">Genere un codigo nuevo y escriba el texto que se muestra</div>
		<?php echo $form->error($model2,'codeVerify'); ?>
	</div>
	<?php endif; ?>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton('Postear',array('submit' => array('default/post'))); ?>
	</div>

<?php $this->endWidget();?> 
</div><!-- form -->
