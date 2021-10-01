<?php Yii::app()->clientScript->registerScript('scoments','
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
<?php if(!Yii::app()->user->isGuest and $ounwer)
 {
    $pasos = Cfperfil::model()->findByPk(Yii::app()->user->id);
    if($pasos->paso_uno == 0)
    {
 ?>
<div class="span-24">
    <?php 
    if($pasos->paso_dos == 0 and $pasos->paso_tres == 0)
        echo CHtml::link("Completar Datos", array('perfil/personal'));
    else
        echo CHtml::link("Invita a tus amigos", "#")
       ?>
</div>
 <?php
    }
 }
?>
<?php $this->widget('ext.boarduser.CDataPerfil',array(
     'islogin'=>!Yii::app()->user->isGuest?true:false,
     'ouwner'=>$ounwer,
     'perfil'=>$model,
));?>


<div class="portlet x3 bottombox">
column1 panel 1

</div>
<div class="portlet x7 column bottombox">
<div class="portlet-content content-img">    
<div class="lcenter">    
 <?php if(!Yii::app()->user->isGuest){ ?>
    <?php 
        $estados = Cfcomentario::model();//"idUser=".Yii::app()->user->id   
    /*foreach($estados as $estado){
        echo $this->renderPartial('cestados/listaestados',array('data'=>$estado),true);
    }*/
    $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$estados->search($_GET['id']),
	'itemView'=>'cestados/listaestados',
        'template' => '{pager}{items}{pager}',
    ));
 ?> 
<?php }?> 
    <div class="clearfix">  </div>
 </div>
    <div class="clearfix">  </div>
</div>   
</div>
<div class="portlet x2 bottombox  last">
column1 panel 3
</div>
