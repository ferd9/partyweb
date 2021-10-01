<?php
$this->breadcrumbs=array(
	'Cfubitacoras'=>array('index'),
	$model->idBitacora,
);

$this->menu=array(
	array('label'=>'List Cfubitacora', 'url'=>array('index')),
	array('label'=>'Create Cfubitacora', 'url'=>array('create')),
	array('label'=>'Update Cfubitacora', 'url'=>array('update', 'id'=>$model->idBitacora)),
	array('label'=>'Delete Cfubitacora', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idBitacora),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cfubitacora', 'url'=>array('admin')),
);
?>

<h1>View Cfubitacora #<?php echo $model->idBitacora; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idBitacora',
		'iduser',
		'fecha',
		'hora',
		'browser',
		'sistema',
		'ip',
		'last_login',
	),
)); ?>
