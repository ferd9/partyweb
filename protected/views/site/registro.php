<?php $this->pageTitle=Yii::app()->name; 
$baseUrl=Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/formee.js');
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/forms/formee-structure.css');
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/forms/formee-style.css');
?>
<div class="span-24 last">
<div class="portlet x4">    
    <div id="header">
	<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>        
    </div><!-- header -->
    <div class="portlet-content">
       
        <?php 
        /*
        echo CHtml::beginForm(Yii::app()->getController()->createUrl('site/uploadImage'),'post',array('enctype'=>'multipart/form-data'));
        echo CHtml::fileField('aimagen');
        echo CHtml::submitButton('Subir Imagen');
        echo CHtml::endForm(); */   
            ?>
    </div>
</div>
<div class="portlet x7 right last">    
    <div class="portlet-header">
        <h4>Formulario de registro
     </h4></div> 
    <div class="portlet-content">
    </div>
</div>
</div>
   
<?php if(Yii::app()->user->isGuest) {?>
<div class="formee-msg-info">
 <?php if(Yii::app()->user->hasFlash('ep')){?>
    <div class="formee-msg-warning"><?php echo Yii::app()->user->getFlash('ep') ?></div>
 <?php }?>
 
 <?php if(Yii::app()->user->hasFlash('eu')){?> 
     <div class="formee-msg-warning"><?php echo Yii::app()->user->getFlash('eu') ?></div>
 <?php }?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfusuario-usuario-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'formee')
)); ?>

    <fieldset>
        <legend>Bienvenido</legend>
	<?php echo $form->errorSummary($model); ?>
	<div class="grid-4-12">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array(
                    'value'=>$model->login,
                    'size'=>'25px')); ?>
                <?php echo $form->error($model,'login'); ?>
		
	</div>

	<div class="grid-6-12">
		<?php echo $form->labelEx($model,'email');?>
		<?php echo $form->textField($model,'email',array(
                    'value'=> $model->email,
                    'size'=>'25px')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
        
         <div class="grid-4-12 clear">
		<?php echo $form->labelEx($perfil,'nombre'); ?>
		<?php echo $form->textField($perfil,'nombre',array(
                    'value'=>$perfil->nombre,
                    'size'=>'25px')); ?>
		<?php echo $form->error($perfil,'nombre'); ?>
	</div> 
        
        <div class="grid-6-12">
		<?php echo $form->labelEx($perfil,'apellidos'); ?>
		<?php echo $form->textField($perfil,'apellidos',array(
                    'value'=>$perfil->apellidos,
                    'size'=>'25px')); ?>
		<?php echo $form->error($perfil,'apellidos'); ?>
	</div>    
        
        
        <div class="grid-4-12 clear">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array(
                    'value'=>$model->password,
                    'size'=>'30px')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="grid-6-12">
		<?php echo $form->labelEx($model,'verifyPass'); ?>
		<?php echo $form->passwordField($model,'verifyPass',array(
                    'value'=>$model->verifyPass,
                    'size'=>'30px')); ?>
		<?php echo $form->error($model,'verifyPass'); ?>
	</div>         
    
        <div class="grid-2-12 clear">            
               
		<?php echo $form->labelEx($perfil,'dia'); ?>
		<?php echo $form->dropDownList($perfil,'dia',Cfperfil::dias(),array(
                    'options'=>array($perfil->dia=>array('selected'=>true)                        
                    ),                    
                    'empty'=>'Dia:')); ?>
            <?php echo $form->error($perfil,'dia'); ?>
                               
	</div>
        
         <div class="grid-2-12">    
            <?php echo $form->labelEx($perfil,'mes'); ?>
            <?php echo $form->dropDownList($perfil,'mes',Cfperfil::meses(),array(
                'options'=>array($perfil->mes=>array('selected'=>true)),
                'empty'=>'Mes:')); ?>
             <?php echo $form->error($perfil,'mes'); ?>
         </div>
        
         <div class="grid-2-12"> 
             <?php echo $form->labelEx($perfil,'anio'); ?>
            <?php echo $form->dropDownList($perfil,'anio',Cfperfil::anios(),array(
                'options'=>array($perfil->anio=>array('selected'=>true)),
                'empty'=>'A&ntilde;o:')); ?>
              <?php echo $form->error($perfil,'anio'); ?>
       </div>          
          
       
        <div class="grid-3-12 clear">
		<?php echo $form->labelEx($perfil,'sexo'); ?>
		<?php echo $form->dropDownList($perfil,'sexo',  $perfil::usexo(),array(
                    'options'=>array($perfil->sexo=>array('selected'=>true)),
                    'empty'=>'Seleccione el sexo','size'=>'1px')); ?>
		<?php echo $form->error($perfil,'sexo'); ?>
	</div>    
	<div class="grid-12-12 clear">
		<?php echo CHtml::submitButton('Registrarse',array('class'=>'right')); ?>
	</div>
        
      </fieldset>  

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php }?> 
