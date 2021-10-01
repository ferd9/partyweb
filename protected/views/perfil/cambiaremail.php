<div class="container-update">
<div class="menu-update">
    <?php
        $this->menu=array(
            array('label'=>'Cambiar Contraseña', 'url'=>array('perfil/updatePass','id'=>Yii::app()->user->id)), 
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
	'id'=>'newemail-form',
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
                <span class="aviso-s">Escribe el sobrenombre que te gustaria tener</span>
		<?php echo $form->labelEx($model,'email',array('class'=>'lb')); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
               </div>            
	</div> 

	<div class="row buttons">
		<?php echo CHtml::submitButton('Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div>

