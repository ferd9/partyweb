<?php 
$this->pageTitle="Datos";
$baseUrl=Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/formee.js');
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/forms/formee-structure.css');
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/forms/formee-style.css');
?>
<?php $this->renderPartial('pasos/_form',array('model'=>$model));?>
<?php echo CHtml::link('Anterior',array('perfil/foto'))." - ".CHtml::link('Finalizar',array('perfil/index','id'=>Yii::app()->user->id)); ?>

