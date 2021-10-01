<?php
echo CHtml::link("Cerrar","#",array('id'=>'inCerrar'));
?>
<?php if($invitation>0) {?>
<div class="sre">
    <?php echo CHtml::link("Recibidas: ".$invitation,"#"); 
          $amigos = Cfamistad::model()->findAll("idamigo=".Yii::app()->user->id." and confirmado = 0");
          foreach($amigos as $amigo)
          {
              echo CHtml::link("Ver Perfil",array("perfil/index",'id'=>$amigo->id_User));
          }
    ?>
</div>
<?php } ?>
<?php if($sendInvitation>0) {?>
<div class="sin">
     <?php echo CHtml::link("Enviadas: ".$sendInvitation,"#"); ?>
</div>
<?php } ?>
