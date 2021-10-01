<?php
$this->breadcrumbs=array(
	'Cfubitacoras'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cfubitacora', 'url'=>array('index')),
	array('label'=>'Manage Cfubitacora', 'url'=>array('admin')),
);
?>

<h1>Create Cfubitacora</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>