<?php 
$baseUrl=Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/formee.js');
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/forms/formee-structure.css');
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/forms/formee-style.css');
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfseguridad-seguridad-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'formee'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
<fieldset>
    <legend>¿Qué datos deseas mostrar?</legend>
	<?php echo $form->errorSummary($model); ?>

	<div class="grid-3-12">
		<?php echo $form->labelEx($model,'setlogin'); ?>
		<?php echo $form->dropDownList($model,'setlogin',array('1'=>'mostrar','0'=>'no mostrar'),
                                array(
                            'options'=>array($model->setlogin=>array('selected'=>true)),                    
                                    )); ?>
		<?php echo $form->error($model,'setlogin'); ?>
	</div>

	<div class="grid-3-12">
		<?php echo $form->labelEx($model,'setemail'); ?>
		<?php echo $form->dropDownList($model,'setemail',array('1'=>'mostrar','0'=>'no mostrar'),
                                                array(
                            'options'=>array($model->setemail=>array('selected'=>true)),                    
                                    )); ?>
		<?php echo $form->error($model,'setemail'); ?>
	</div>

	<div class="grid-3-12">
		<?php echo $form->labelEx($model,'setnombre'); ?>
		<?php echo $form->dropDownList($model,'setnombre',array('1'=>'mostrar','0'=>'no mostrar'),
                                 array(
                            'options'=>array($model->setnombre=>array('selected'=>true)),                    
                                    )); ?>
		<?php echo $form->error($model,'setnombre'); ?>
	</div>

	<div class="grid-3-12">
		<?php echo $form->labelEx($model,'setedad'); ?>
		<?php echo $form->dropDownList($model,'setedad',array('1'=>'mostrar','0'=>'no mostrar'),
                                 array(
                            'options'=>array($model->setedad=>array('selected'=>true)),                    
                                    )); ?>
		<?php echo $form->error($model,'setedad'); ?>
	</div>

	<div class="grid-3-12 clear">
		<?php echo $form->labelEx($model,'setdescripcion'); ?>
		<?php echo $form->dropDownList($model,'setdescripcion',array('1'=>'mostrar','0'=>'no mostrar'),
                                                     array(
                            'options'=>array($model->setdescripcion=>array('selected'=>true)),                    
                                    )); ?>
		<?php echo $form->error($model,'setdescripcion'); ?>
	</div>

	<div class="grid-3-12">
		<?php echo $form->labelEx($model,'setnextel'); ?>
		<?php echo $form->dropDownList($model,'setnextel',array('1'=>'mostrar','0'=>'no mostrar'),
                                        array(
                            'options'=>array($model->setnextel=>array('selected'=>true)),                    
                                    )); ?>
		<?php echo $form->error($model,'setnextel'); ?>
	</div>

	<div class="grid-3-12">
		<?php echo $form->labelEx($model,'setmovil'); ?>
		<?php echo $form->dropDownList($model,'setmovil',array('1'=>'mostrar','0'=>'no mostrar'),
                                        array(
                            'options'=>array($model->setmovil=>array('selected'=>true)),                    
                                    )); ?>
		<?php echo $form->error($model,'setmovil'); ?>
	</div>

	<div class="grid-3-12">
		<?php echo $form->labelEx($model,'setfijo'); ?>
		<?php echo $form->dropDownList($model,'setfijo',array('1'=>'mostrar','0'=>'no mostrar'),
                                        array(
                            'options'=>array($model->setfijo=>array('selected'=>true)),                    
                                    )); ?>
		<?php echo $form->error($model,'setfijo'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->