<?php
$cs=Yii::app()->clientScript;
$cs->coreScriptPosition=CClientScript::POS_HEAD;
$cs->scriptMap=array();
//$baseUrl=Yii::app()->request->baseUrl;
$cs->registerCoreScript('jquery');
//$cs->registerScriptFile($baseUrl.'/js/tools.tooltip-1.2.5.min.js');
//$cs->registerScriptFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.pack.js');
//$cs->registerCssFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.css');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />
	
	
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cfstyle.css" media="screen, projection" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.1.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
</head>
<body>
<div class="cftopbar">
<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
                                array('label'=>'Anónimo', 'url'=>array('#'), 
                                    'linkOptions'=>array('onclick'=>'$("#mydialog").dialog("open"); return false;')
                                    ),
                                array('label'=>'Perfil','url'=>array('/perfil/index','id'=>Yii::app()->user->id),'visible'=>!Yii::app()->user->isGuest)
				
			),
		)); ?>
</div><!-- mainmenu -->


<?php if(Yii::app()->user->isGuest) {?>	
	<div class="flogin">
	<?php $model=new LoginForm; ?>
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>	

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>		
		
	</div>

	<div class="row2 rememberMe">
		<span>
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
		</span>
		<span>
		<?php echo CHtml::submitButton('Entrar',array('submit' => array('/site/login'))); ?>
		</span>
	</div>	

<?php $this->endWidget(); ?>
	</div>
	
	<?php } else if(!Yii::app()->user->isGuest){?>
	<div class="flogin portlet">
         <ul> 
           <li>  
        <?php    
            echo CHtml::link('SALIR',array('/site/logout'));
            echo Yii::app()->user->name['login'];
         ?>
            </li>  
          </ul>
	</div>
	 <?php }  ?>
 
	 
</div>
<div class="clear"></div>
<div class="container showgrid">
    
<?php echo $content; ?>

<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by F3RD9.<br/>
		Todos los derechos reservados.<br/>
		<?php echo 'FPPB'; ?>
	</div><!-- footer -->
</div>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mydialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Aviso para los Anónimos',
        'autoOpen'=>false,
        'width'=>'500px',
        'height'=>'auto',
        //'position' => 'top',
        'top' => '20px',
        'modal' => true,
    ),
));

echo Yii::app()->getController()->renderPartial('avisoanonimo', array(), true);

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>
</body>
</html>