<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$baseUrl=Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/forms/login.css');

$this->breadcrumbs=array(
	'Login',
);
?>

<div class="form-login" style="position: relative" id="login">
<h1><a>Login</a></h1>

<p>Verifique sus datos porfavor:</p>
<?php echo CHtml::link('Registrarme',array('site/registro')); ?>
<div id="login-body">    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login_form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="content_front">
            <div class="pad">
                <div class="field">
		<?php echo $form->labelEx($model,'username'); ?>
                 <div class=""> 
                  <span class="input">   
		<?php echo $form->textField($model,'username',array('class'=>'text')); ?>
		<?php echo $form->error($model,'username'); ?>
                  </span>
                 </div>
                </div>

                <div class="field">
                    <?php echo $form->labelEx($model,'password'); ?>
                 <div class=""> 		
                 <span class="input"> 
		<?php echo $form->passwordField($model,'password',array('class'=>'text login_password')); ?>
		<a id="forgot_my_password" href="javascript:;" style="">Forgot password?</a>
                <?php echo $form->error($model,'password'); ?>
                    </span>
                  </div>
                </div>

             <div class="checkbox">  
                 <span class="label">&nbsp;</span>
                 <div class="">
		<?php echo $form->checkBox($model,'rememberMe',array('class'=>'checkbox','id'=>'remember')); ?>	
                 <?php echo $form->label($model,'rememberMe',array('style'=>'display: inline;')); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
                  </div>    
              </div>  
                <div class="field">
                     <span class="label">&nbsp;</span>
                 <div class=""> 
		<?php //echo CHtml::submitButton('Login',array('class'=>'btn')); ?> 
                  <button class="btn" type="submit">Ingresar</button>   
                 </div>
                </div>    
                
             </div>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
<div style="clear: both"></div>
