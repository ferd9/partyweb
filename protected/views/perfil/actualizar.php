<div class="container-update">
<div class="menu-update">
    <?php
        $this->menu=array(
            array('label'=>'Cambiar Contraseña', 'url'=>array('perfil/updatePass','id'=>Yii::app()->user->id)),
            array('label'=>'Cambiar Email', 'url'=>array('perfil/updateEmail','id'=>Yii::app()->user->id)),            
        );
           
            $this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
           	
	?>
</div>
<div class="form-update">
    <?php if(Yii::app()->user->hasFlash('success')) { ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php  }
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cperfil-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row names">
            <div class="item-form">
                <span class="aviso-s">Escribe el sobrenombre que te gustaria tener</span>
		<?php echo $form->labelEx($usuario,'login',array('class'=>'lb')); ?>
		<?php echo $form->textField($usuario,'login'); ?>
		<?php echo $form->error($usuario,'login'); ?>
               </div>            
	</div>
	<div class="row names">
            <div class="item-form">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'lb')); ?>
		<?php echo $form->textField($model,'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
               </div>
            <div class="item-form">
		<?php echo $form->labelEx($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos'); ?>
		<?php echo $form->error($model,'apellidos'); ?>
             </div>
	</div>
       
         <div class="row datos-select">
             <span class="aviso-s">Si no ingresas tu edad. entoces se calculara en base a tu fecha de nacimiento</span>
             <div class="item-form">
                 <span class="aviso-s">Ingresa tu edad</span>
                <?php echo $form->labelEx($model,'edad',array('class'=>'lb'));?>
		<?php echo $form->textField($model,'edad'); ?>
		<?php echo $form->error($model,'edad');?>
               </div>   
             
             <div class="item-form">
                 <span class="aviso-s">Seleccione su fecha de nacimiento</span>
                <div class="nfecha">
		<?php echo $form->labelEx($model,'dia'); ?>
		<?php 
                $sdia = date('d', strtotime($model->fecha_nac));
                echo $form->dropDownList($model,'dia',Cfperfil::dias(),array(
                    'options'=>array($sdia=>array('selected'=>true)                        
                    ),                    
                    'empty'=>'Dia:')); ?>
		
                </div>
                <div class="nfecha">
                <?php echo $form->labelEx($model,'mes'); ?>
		<?php $mes = date('m', strtotime($model->fecha_nac));
                    echo $form->dropDownList($model,'mes',Cfperfil::meses(),array(
                    'options'=>array($mes=>array('selected'=>true)),
                    'empty'=>'Mes:')); ?>
		
                </div>
                <div class="nfecha">
                <?php echo $form->labelEx($model,'anio'); ?>
		<?php $anio = date('Y', strtotime($model->fecha_nac));
                    echo $form->dropDownList($model,'anio',Cfperfil::anios(),array(
                    'options'=>array($anio=>array('selected'=>true)),
                    'empty'=>'A&ntilde;o:')); ?>
		
                </div>
              </div>  
             
	</div>
       
        
        <div class="row">
            <div class="item-form">
		<?php echo $form->labelEx($model,'sexo',array('class'=>'lb')); ?>
		<?php echo $form->dropDownList($model,'sexo',Cfperfil::usexo(),
                        array(
                            'options'=>array($model->sexo=>array('selected'=>true)),                    
                    'empty'=>'¿Eres?')
                        ); ?>
		<?php echo $form->error($model,'estado_senti'); ?>
            </div> 
            <div class="item-form">
                <?php echo $form->labelEx($model,'estado_senti'); ?>
		<?php echo $form->dropDownList($model,'estado_senti',Cfperfil::getEstados(),
                        array(
                            'options'=>array($model->estado_senti=>array('selected'=>true)),                    
                    'empty'=>'¿Cuál es tu situacion?')
                        ); ?>
		<?php echo $form->error($model,'estado_senti'); ?>
            </div> 
	</div>        
        <div class="row">
                <div class="item-form">
		<?php echo $form->labelEx($model,'nextel',array('class'=>'lb')); ?>
		<?php echo $form->textField($model,'nextel'); ?>
		<?php echo $form->error($model,'nextel'); ?>
                </div>    
            
                <div class="item-form">    
                <?php echo $form->labelEx($model,'movil'); ?>
		<?php echo $form->textField($model,'movil'); ?>
		<?php echo $form->error($model,'movil'); ?>
                </div>    
            
                <div class="item-form">
                <?php echo $form->labelEx($model,'fijo'); ?>
		<?php echo $form->textField($model,'fijo'); ?>
		<?php echo $form->error($model,'fijo'); ?>
                </div>    
	</div>
        
        
	<div class="row">
            <div class="item-form">
		<?php echo $form->labelEx($model,'descripcion',array('class'=>'lb')); ?>
		<?php echo $form->textArea($model,'descripcion'); ?>
		<?php echo $form->error($model,'descripcion'); ?>
           </div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div>