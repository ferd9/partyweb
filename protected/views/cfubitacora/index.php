<?php
$this->breadcrumbs=array(
	'Cfubitacoras',
);

$this->menu=array(
	array('label'=>'Create Cfubitacora', 'url'=>array('create')),
	array('label'=>'Manage Cfubitacora', 'url'=>array('admin')),
);
?>

<h1>Cfubitacoras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
