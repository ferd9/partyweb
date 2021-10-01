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
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/perfil/notifications.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/perfil/cfperfil.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php 
            Yii::app()->clientScript->registerScript('accepNeg','
                    function aceptar(elemento){
                        var datos=elemento.id.split("-");
                        $.getJSON("'.Yii::app()->getController()->createUrl('perfil/aceptarSolicitud').'",
                            {user:datos[0],ui:datos[1]},function(json){
                                alert(json.rsp);
                           }
                        );
                       
                    }
                    function rechazar(elemento){}
                ',
            CClientScript::POS_HEAD);
        ?>
</head>
<body>
<div class="cftopbar">
<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Actividad', 'url'=>array('/presentacion/index'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Anónimo', 'url'=>array('#'), 
                                    'linkOptions'=>array('onclick'=>'$("#mydialog").dialog("open"); return false;')
                                    ),
                                array('label'=>'Perfil','url'=>array('/perfil/index','id'=>Yii::app()->user->id),'visible'=>!Yii::app()->user->isGuest)
				
			),
		)); ?>
</div><!-- mainmenu -->
<div class="flogin portlet">
     
	<?php if(!Yii::app()->user->isGuest){
            echo "<ul>";
            //echo "<li>".CHtml::link(strtoupper(Yii::app()->user->name))."</li>";
            echo "<li>".CHtml::ajaxLink("NOTIFICACIONES", array("Notificaciones/notificar"), array(
                'success'=>'js:function(data){
                    $("#unotified").html(data);
                    $("#unotified").toggle();
                }'
            )).'<div id="unotified" style="display: none; z-index: 91; top:22px; left:-38px; position: absolute; background-color: #ffffff; text-align: center;">
                nadaaaaa   
                </div>
                '."</li>";
            echo "<li>".CHtml::ajaxLink("SOLICITUDES", array("perfil/solicitud"),array(
                'success'=>'js:function(data){
                    $("#usolicitud").html(data);
                    $("#usolicitud").toggle();
                    //$("#usolicitud").blur(function(){
                        //$("#usolicitud").hide();
                        //return false;
                    //})
                  }',
            )).'<div id="usolicitud" style="display: none; z-index: 91; top:22px; left:-42px; position: absolute; border: 2px blueviolet solid; background-color: #ffffff; width:200px; text-align: center;">
                nadaaaaa   
                </div> '."</li>";            
            echo "<li>".CHtml::link('SALIR',array('/site/logout'))."</li>";   
            echo "</ul>";
            }else{ 
	 ?>
    
    <?php $model=new LoginForm; ?>
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>	

	<div class="lrow">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>		
	</div>

	<div class="lrow">
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

<?php $this->endWidget(); }?>
    
 </div>
	 
</div>
<div class="clear"></div>
<div class="container showgrid">
<div class="spacer">
</div>

    
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

echo Yii::app()->getController()->renderPartial('//site/avisoanonimo', array(), true);

$this->endWidget('zii.widgets.jui.CJuiDialog');

?>
</body>
</html>