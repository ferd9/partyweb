<?php Yii::app()->clientScript->registerScript('scomentsp','
 function lcoment(clink){
        var elemt = $("#fin"+clink.id);       
        elemt.show();
        $("#farea"+clink.id).focus();
        $("#farea"+clink.id).blur(function(){
            var texto = $("#farea"+clink.id).val();
            if(texto == null || texto.length == 0 || /^\s+$/.test(texto))
                elemt.hide();
        })        
       
    }
',CClientScript::POS_HEAD)
        
  
?> 


<?php
Yii::app()->clientScript->registerScript('usrivd','
    function invuser(enlace){        
        var container = $("#bx"+enlace.id);
        $.get("'.$this->createUrl("perfil/addFriend").'",{user:"'.Yii::app()->user->id.'", friend:enlace.id},
            function(data){
            if(data != "Error!!")
                container.hide()
            else
                alert("Hubo un error");
            
       })
    }
',  CClientScript::POS_HEAD);

$this->menu= $this->renderPartial("funknow/desconocidos",array(),true);
?>
<h3 style="text-align: center;">Actividades de tus amigos</h3>
<?php 
      $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search(),
	'itemView'=>'funknow/_items',
        'template' => '{items}{pager}',
    ));
?>


