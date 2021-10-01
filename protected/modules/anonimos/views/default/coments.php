
<?php if(isset($post) and isset($img)){
    $elpost = Cfapost::model()->findByPk($post);
    $laimg = Aimagen::model()->findByPk($img);   
    ?>

    <div class="imagebox">
           <?php
            $img= CHtml::image(Yii::app()->request->baseUrl.'/'.$laimg->thumb_path.'/'.$laimg->nom_thumb);      
            echo CHtml::link($img,Yii::app()->createAbsoluteUrl('site/aimage',array('id'=>$laimg->idaimagen)),array('class'=>'view-aimagen','rel'=>$laimg->nombre,'alto'=>$laimg->imgHeight));          
           ?>
       </div>         
      <?php echo "<h5>".$elpost->titulo."</h5>";
            echo "<p>".htmlentities($elpost->contenido)."</p>";?>

    
<?php }else if(isset($post) and !isset($img)){
    $elpost = Cfapost::model()->findByPk($post);
    ?>
    <div class="imagebox">
           <?php
            echo CHtml::image(Yii::app()->request->baseUrl.'/images/default.png'); 
           ?>
    </div> 
    <?php echo "<h5>".$elpost->titulo."</h5>";
          echo $elpost->contenido;?>

<?php } ?>


<?php if(isset($post)){?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfacoment-coments-form',
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'idapost',array('value'=>$post)); ?>
        <?php echo $form->hiddenField($model,'fecha',array('value'=>time())); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'contenido'); ?>
		<?php echo $form->textArea($model,'contenido',array('class'=>'tinymce','cols'=>'40','rows'=>'4')); ?>
		<?php echo $form->error($model,'contenido'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget();?>

</div><!-- form -->

<?php 
$cometarys=isset($comentarios)?$comentarios:new Cfacoment();
$this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'cfacoment-grid',
      'dataProvider'=>  $cometarys->search($post),
      'filter'=>$cometarys,
      'columns'=>array(
          'contenido', // display the 'title' attribute
          array(            // display 'create_time' using an expression
              'name'=>'fecha',
              'value'=>'date("d/m/Y - h:i:s", $data->fecha)',
          ),
          
      ),
  ));

}//fin if

?>