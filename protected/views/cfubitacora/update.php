<?php
$this->breadcrumbs=array(
	'Cfubitacoras'=>array('index'),
	$model->idBitacora=>array('view','id'=>$model->idBitacora),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cfubitacora', 'url'=>array('index')),
	array('label'=>'Create Cfubitacora', 'url'=>array('create')),
	array('label'=>'View Cfubitacora', 'url'=>array('view', 'id'=>$model->idBitacora)),
	array('label'=>'Manage Cfubitacora', 'url'=>array('admin')),
);
?>

<h1>Update Cfubitacora <?php echo $model->idBitacora; ?></h1>

<?php 
$mu = Cfubitacora::model()->find("idBitacora='23'");
            $as=$mu->hora;
            echo $as.' ****';
echo $this->renderPartial('_form', array('model'=>$model)); ?>