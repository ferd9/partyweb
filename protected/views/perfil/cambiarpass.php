<div class="container-update">
<div class="menu-update">
    <?php
        $this->menu=array(
            array('label'=>'Cambiar Email', 'url'=>array('perfil/updateEmail','id'=>Yii::app()->user->id)),
            array('label'=>'Actualizar Datos', 'url'=>array('perfil/actualizarDatos','id'=>Yii::app()->user->id)),            
        );
           
            $this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
           	
	?>
</div>
<div class="form-update">
    <?php if(Yii::app()->user->hasFlash('ok')) { ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('ok'); ?>
    </div>
    <?php } ?>
    
     <?php if(Yii::app()->user->hasFlash('error')) { ?>
    <div class="errorMessage">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
    <?php } ?>
    
    <?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'newpassword-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

         <div class="row names">
             <div class="item-form">                
		<?php echo $form->labelEx($model,'actualpass',array('class'=>'lb')); ?>
		<?php echo $form->passwordField($model,'actualpass');?>
		<?php echo $form->error($model,'actualpass'); ?>
               </div>            
	</div>       
        <div class="row names">
             <div class="item-form">                
		<?php echo $form->labelEx($model,'password',array('class'=>'lb')); ?>
		<?php echo $form->passwordField($model,'password');?>
		<?php echo $form->error($model,'password'); ?>
               </div>            
	</div>
        <div class="row">
            <div class="item-form">
		<?php echo $form->labelEx($model,'verifyPass',array('class'=>'lb')); ?>
		<?php echo $form->passwordField($model,'verifyPass',array(
                    'size'=>'30px')); ?>
		<?php echo $form->error($model,'verifyPass'); ?>
                </div> 
	</div>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div>
