<?php
if($_GET['ui']==Yii::app()->user->id){
Yii::app()->clientScript->registerScript('snotas','
    function visibilidadTodos(enlace)
    {
        var datos = enlace.id.split("-");
        //v = $("#"+enlace.id).text();
        //alert(v);
        $.getJSON("'.$this->createUrl('notas/muestraatodos').'",
                   {ui:datos[0], nota:datos[1]},
                   function(json){
                        $("#"+enlace.id).text(json.texto);
                          enlace.href=json.href;
                   }
        
        );
    }
    
     function visibilidadAmigos(enlace)
    {
        var datos = enlace.id.split("-");
        //v = $("#"+enlace.id).text();
        //alert(v);
        $.getJSON("'.$this->createUrl('notas/muestraaamigos').'",
                   {ui:datos[0], nota:datos[1]},
                   function(json){
                        $("#"+enlace.id).text(json.texto);
                          enlace.href=json.href;
                   }
        
        );
    }
    
     function archivar(enlace)
    {
        var datos = enlace.id.split("-");
        if(enlace.href == "#ar")
            return false;
        //v = $("#"+enlace.id).text();
        //alert(v);
        $.getJSON("'.$this->createUrl('notas/archivar').'",
                   {ui:datos[1], nota:datos[2]},
                   function(json){
                        $("#"+enlace.id).text(json.texto);
                          enlace.href=json.href;
                   }
        
        );
    }
',  CClientScript::POS_HEAD);
}

if($_GET['ui']!=Yii::app()->user->id)
{
    $this->menu=array(
	array('label'=>'Crear Nota', 'url'=>array('notas/index')),
        array('label'=>'Ver mis notas', 'url'=>array('notas/lista','ui'=>Yii::app()->user->id)),	
       );
}else if($_GET['ui']==Yii::app()->user->id)
{   
    $this->menu=array(
            array('label'=>'Crear Nota', 'url'=>array('notas/index')),
            array('label'=>'Ver Todas las Notas', 'url'=>array('notas/lista','ui'=>Yii::app()->user->id)),
            array('label'=>'Ver Notas Publicadas', 'url'=>array('notas/lista','ui'=>Yii::app()->user->id,'tipo'=>'publish')),
            array('label'=>'Ver Notas Pendientes', 'url'=>array('notas/lista','ui'=>Yii::app()->user->id,'tipo'=>'pendiente')),
            array('label'=>'Ver Notas Eliminadas', 'url'=>array('notas/lista','ui'=>Yii::app()->user->id,'eliminado'=>'0')),
    );
}
?>

<div class="portlet x9">
<?php

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$adp,
	'itemView'=>'subitems/_items',
        'template' => '{pager}{items}{pager}',
    ));
?>
</div>
