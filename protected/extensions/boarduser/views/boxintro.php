<div class="span-25 last">
<div class="<?php echo $this->boxCss['imagenperfi']; ?> portlet x4">
    
<?php if($imagen != null){
    echo CHtml::image(Yii::app()->request->baseUrl."/".$imagen->thumb_path."/".$imagen->nom_thumb, "Imagen de Perfil");
  }else
      echo CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default.png', 'Sin Foto');   
  ?>
   
</div>
<div class="<?php echo $this->boxCss['infop']; ?> portlet x6">
    <div class="portlet-header">
<h4>Nombre: <?php echo $perfil->nombre." ".$perfil->apellidos;
    echo " ".CHtml::link("ver informacion completa",array('informacion/index','id'=>$perfil->idPerfil));
?></h4>
    </div>
    <div class="portlet-content">
<table>
<tr><td>Edad:</td><td><?php echo $perfil->edad?></td></tr>    
<tr><td>Sexo:</td><td><?php echo $perfil->sexo=='H'?'Hombre':'Mujer';?></td></tr>   
<tr><td>Situacion Sentimental:</td><td>
<?php 
if(empty($perfil->estado_senti))
{
    echo "sin definir";
}else
{
    /*
     * 's'=>'Soltero(a)',
                'c'=>'Casado(a)',
                'a'=>'Abandonado(a)',
                'n'=>'Comprometido(a)',
                'd'=>'Dificil',
                'l'=>'Abierta'
     */
    switch($perfil->estado_senti)
    {
        case 's':echo 'Soltero(a)';
            break;
        case 'c':echo 'Casado(a)';
            break;
        case 'a':echo 'Abandonado(a)';
            break;
        case 'n':echo 'Comprometido(a)';
            break;
        case 'd':echo 'Dificil';
            break;
        case 'l':echo 'Abierta';
            break;
    }   
}
?></td></tr>
</table>
<div class="estado">
<?php if($ouwner){
    Yii::app()->clientScript->registerScript('aComt',"
    $('#a-estado').click(function(){
    $('#a-estado').hide();
    $('#hform').show();
})

    $('#f-cancelar').click(function(){
    $('#a-estado').show();
    $('#hform').hide();
})

    $('#ltext2').click(function(){
    $('#a-estado').hide();
    $('#hform').show();    
})

         ",CClientScript::POS_END);    
 ?>
<div id ="hform" style="display:none">    
<div class="form">
<?php 
$comentario = new Cfcomentario();
$estado = new Cfestado();
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfomentario-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($comentario); ?>
        <?php echo $form->errorSummary($estado); ?>	
	<div class="prow">		
		<?php echo $form->textField($estado,'enlace'); ?>
		<?php echo $form->error($estado,'enlace'); ?>
	</div>
	<div class="prow">		
		<?php echo $form->textArea($comentario,'contenido'); ?>
		<?php echo $form->error($comentario,'contenido'); ?>
	</div> 
	<div class="prow buttons">
		<?php echo CHtml::ajaxSubmitButton("Actualizar estado", array('comentario/addComentario'), array(
                    'success'=>'js:function(data){
                        if(data != "error")
                        {
                           $("#a-estado").html(data);
                           $("#hform").hide();
                           $("#a-estado").show();
                        }else{
                            alert("el estado no pudo ser actualizado");
                        }
                    }'
                )); 
                
                echo Chtml::link("Cancelar","#",array('id'=>'f-cancelar'));
                ?> 
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->    
 </div>   
    
<?php
   $comentario = Cfcomentario::model()->find("idUser = ".Yii::app()->user->id." and tipo = 'status' order by fecha desc");   
    if($comentario != null)
    {
        $estado = Cfestado::model()->find("id_ecomentario = ".$comentario->idcomentario);
        echo"<div id='a-estado'>";
        echo "<h4>".$estado->enlace."</h4>";
        echo "<p>".$comentario->contenido."</p>";        
        echo "</div>";
    }    
    if($comentario == null)
    {
        $opcion = CHtml::ajaxLink("En que piensas", array('comentario/comentarios'),array(
            'success'=>'js:function(data){
                $("#hform").toggle();
                $("#ltext").hide();
               }'
        ),array('id'=>'ltext'));
        echo $opcion;
        echo"<div id='a-estado' style='display:none;'>".CHtml::link("En que piensas","#",array('id'=>'ltext2'))."</div>";       
    }
}
?>
   </div>
  </div>      
</div><!--fin-->
 <div class="<?php echo $this->boxCss['acciones']; ?> portlet x3">
        <ul>
           <?php if($ouwner){?> 
            <li><?php echo CHtml::link("ACTUALIZAR DATOS",array('perfil/actualizarDatos','id'=>Yii::app()->user->id)) ?></li>
            <li><?php echo CHtml::link("SEGURIDAD",array('perfil/seguridad','id'=>Yii::app()->user->id)) ?></li>
            <li><?php echo CHtml::link("SUBIR FOTOS",array('fotos/index')) ?></li>
            <li><?php echo CHtml::link("POSTEAR",array('notas/lista','ui'=>Yii::app()->user->id)) ?></li>
            <li><?php echo CHtml::link("OPCION 5") ?></li>
            <li><?php echo CHtml::link("MODIFICAR PERFIL") ?></li>
            <?php }else{
                //se verifica si el usuario tiene agregar al usuario k visita.
                //luego se verfica si el usuario tiene inviaciocien deamistad cin confirmar
            if($islogin){    
            $amix = Cfamistad::model()->find("id_User=".Yii::app()->user->id." and idamigo = ".$perfil->idPerfil." and confirmado=1");
            $existInvitation = Cfamistad::model()->find("id_User=".Yii::app()->user->id." and idamigo = ".$perfil->idPerfil." and confirmado=0");
            $haveInvitation = Cfamistad::model()->find("id_User=".$perfil->idPerfil." and idamigo = ".Yii::app()->user->id." and confirmado=0");
            $accepted = Cfamistad::model()->find("id_User=".$perfil->idPerfil." and idamigo = ".Yii::app()->user->id." and confirmado=1");
                
            ?> 
            <li><?php 
                if(is_null($existInvitation) and $amix==null and is_null($haveInvitation) and $accepted==null){
                echo CHtml::ajaxLink("Agregar", array('addFriend','user'=>Yii::app()->user->id,'friend'=>$perfil->idPerfil), 
                    array('success'=>'js:function(data){
                            var prt = $("#uadd").parent();
                            prt.remove("#uadd");
                            prt.text(data);
                        }'),
                    array('id'=>'uadd'));
                }else if($haveInvitation != null){
                    echo CHtml::link("Aceptar Solicitud",array('perfil/aceptarSolicitud',"user"=>$perfil->idPerfil,'ui'=>Yii::app()->user->id));
                 }else if($accepted == null and ($haveInvitation!=null or $existInvitation != null))
                    echo "Solicitud Enviada";
                 else
                     echo "Enviar Mensaje";
            ?>
            </li>
            <?php if($accepted != null or $amix != null){?>
            <li><?php echo CHtml::link("Ver Fotos",array("fotos/showalbum",'iu'=>$perfil->idPerfil));?></li>
            <li><?php echo CHtml::link('Notas Publicadas',array("notas/lista",'ui'=>$perfil->idPerfil,'tipo'=>'publish'));?></li>
            <li>Opcion X</li>
            <?php }?>
            
            <?php }else{
                        echo "<li>";
                        echo "registrarse"; 
                        echo "</li>";
                    }            
                } ?> 
        </ul>
 </div>
</div>
<?php 
if($ouwner && $islogin){
    $amigos = Cfamistad::model()->findAll("id_User=".Yii::app()->user->id." and confirmado=1");    
  }         
 else{
     $amigos = Cfamistad::model()->findAll("id_User=".$perfil->idPerfil." and confirmado=1");     
 }
 
   
 ?>

<div class="portlet x12">
    <div class="portlet-header">
        <h4><?php 
        echo "AMIGOS DE ".$perfil->nombre." ".$perfil->apellidos;
     ?>
     </h4></div>
    <div class="portlet-content content-img">
    <?php
     if(isset($amigos) && $amigos != null)
    {
        foreach($amigos as $amigo){
         $fimg = null;
         $dataAmigo = Cfperfil::model()->find("idPerfil=".$amigo->idamigo);
         if(is_numeric($dataAmigo->foto)){
         $md = Cfmedia::model()->find("idmedia = ".$dataAmigo->foto);
         $fimg = Cfimagen::model()->find("id_media=".$md->idmedia." and en_perfil=1");
         }
        ?>
        <div class="imagebox"><?php 
        if($fimg!=null){
            $fimagen = "";
            $fimagen = CHtml::image(Yii::app()->request->baseUrl."/".$fimg->thumb_path."/".$fimg->nom_thumb, "Imagen de Perfil");
        }else{
            $fimagen = CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default.png', 'Sin Foto');
        }
            echo CHtml::link($fimagen, array('perfil/index','id'=>$amigo->idamigo));
        ?>
        <span class="nameu"><?php echo $dataAmigo->nombre; ?></span>
        </div>
        <?php } 
    }?> 
        <div class="clearfix">  </div> 
   </div>     
</div>
 

