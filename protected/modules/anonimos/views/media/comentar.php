<div class="portlet x12">
<div class="portlet-content img-apost">
           <?php
           echo CHtml::image(Yii::app()->request->baseUrl.'/'.$model->directory.'/'.$model->nombre,$model->nombre);    
         ?>
       </div>
<?php echo CHtml::link("Ver tamaño Real de la imagen",Yii::app()->createAbsoluteUrl('site/aimage',array('id'=>$model->idaimagen)),array('class'=>'view-aimagen,','rel'=>$model->nombre,'alto'=>$model->imgHeight,'target'=>'_blank'));?>
</div>
<div class="clearfix"></div>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Cfaimgcoment-coments-form',
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'formee'),
)); ?>

	<?php echo $form->errorSummary($imgComentario); ?>
        <?php echo $form->hiddenField($imgComentario,'idaimagen',array('value'=>$model->idaimagen)); ?>
        <?php echo $form->hiddenField($imgComentario,'fecha',array('value'=>time())); ?>
	<div class="row">
		<?php echo $form->labelEx($imgComentario,'contenido'); ?>
		<?php echo $form->textArea($imgComentario,'contenido'); ?>
		<?php echo $form->error($imgComentario,'contenido'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar Comentario'); ?>
	</div>

<?php $this->endWidget();?>

</div><!-- form -->
<?php 
$coments = Cfaimgcoment::model()->find("idaimagen=".$model->idaimagen);
if(!is_null($coments)){
    $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$coments->search($model->idaimagen),
	'itemView'=>'_comentarios',
));
}
 ?>