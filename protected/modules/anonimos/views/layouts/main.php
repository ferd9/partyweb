<?php
$cs=Yii::app()->clientScript;
$cs->coreScriptPosition=CClientScript::POS_HEAD;
$cs->scriptMap=array();
$baseUrl=Yii::app()->request->baseUrl;
$cs->registerCoreScript('jquery');
//$cs->registerScriptFile($baseUrl.'/js/tools.tooltip-1.2.5.min.js');
$cs->registerScriptFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.pack.js');
$cs->registerCssFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.css');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/tiny_mce/jquery.tinymce.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('tynimce','
    $().ready(function() {
		$("textarea.tinymce").tinymce({
			// Location of TinyMCE script
			script_url : "'.Yii::app()->request->baseUrl.'/js/tiny_mce/tiny_mce.js",

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "link,unlink,emotions,media,image,help,code,|,preview",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "'.Yii::app()->request->baseUrl.'/css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
    ',CClientScript::POS_HEAD);
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
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cssanonimo/fpostform.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cfstyle.css" media="screen, projection" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/formee.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/forms/formee-structure.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/forms/formee-style.css" />
        
</head>
<body>
<div class="cftopbar">
    
<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Postear', 'url'=>array('/anonimos'),'visible'=>Yii::app()->getController()->getId() != 'default' or Yii::app()->getController()->getAction()->getId() != 'index'),
				array('label'=>'Ver Imagenes', 'url'=>array('/anonimos/media'),'visible'=>Yii::app()->getController()->getId()== 'default'),
                                array('label'=>'Anónimo', 'url'=>array('#'),                                     
                                    'visible'=>Yii::app()->user->isGuest,
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
<div class="spacer">
</div>

    
<?php echo $content; ?>



<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by 3l@aprendiz.<br/>
		Todos los derechos reservados.<br/>
		<?php echo 'Fernando Perez'; ?>
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

echo "*************";

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>
</body>
</html>
