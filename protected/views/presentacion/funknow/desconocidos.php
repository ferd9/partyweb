<?php 
$users = Cfperfil::model()->findAll("idPerfil != ".Yii::app()->user->id);
if($users!=null)
    $this->headerMenu = 'Usuarios Nuevos';
foreach($users as $user)
{   
    if(!Cfamistad::model()->exists("id_user = ".$user->idPerfil." and idamigo= ".Yii::app()->user->id." and confirmado=0")){
    $amistad = Cfamistad::model()->find("id_user = ".Yii::app()->user->id." and idamigo= ".$user->idPerfil);
    $foto = CHtml::image(Yii::app()->request->baseUrl.'/uphoto/default.png', 'Sin Foto');
    if(is_numeric($user->foto)){
         $media = Cfmedia::model()->findByPk($user->foto);
         $imagen = Cfimagen::model()->find("id_media=".$media->idmedia." and en_perfil=1");
         if($imagen != null)
            $foto = CHtml::image(Yii::app()->request->baseUrl."/".$imagen->thumb_path."/".$imagen->nom_thumb, "Imagen de Perfil");
      }
    if($amistad == null){ 
   
    ?>       
    <div class="user-card" id="bx<?php echo $user->idPerfil;?>">
      <div class='bimg avatar'> 
          <?php
            echo $foto;
          ?>
      </div>
        <div class="unom details">
            <strong>
     <?php 
         echo CHtml::link($user->nombre." ".$user->apellidos,array("perfil/index",'id'=>$user->idPerfil))."</br>";
     ?>
            </strong>  
            <?php echo CHtml::link("AGREGAR","#",array('id'=>$user->idPerfil,'class'=>'btn btn-orange','onclick'=>'invuser(this); return false'));?>
        </div>      
      </div>
 <?php } 
    }
  }
 ?>
