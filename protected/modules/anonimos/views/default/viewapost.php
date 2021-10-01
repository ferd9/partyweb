<?php 

Yii::app()->clientScript->registerScript('showpost', " 
function msj() {
//$('.viewpost').load('".Yii::app()->createAbsoluteUrl('anonimos/default/mensaje')."');
//alert('gola mudno')

$.get('".Yii::app()->createAbsoluteUrl('anonimos/default/mensaje')."', function(data){
//alert('Data Loaded: ' + data);
var datos = eval('('+data+')');
   
   //primera fila
   $('#a1').attr('href',datos.fila1.url); //enlace img
   $('#img1').attr('src',datos.fila1.img);
   $('#h1').text(datos.fila1.titulo);   
   $('#l1').text('Comentarios: '+datos.fila1.comentarios)   
   $('#vc1').attr('href',datos.fila1.vcometarios)
   
//segunda fila
   $('#a2').attr('href',datos.fila2.url); //enlace img
   $('#img2').attr('src',datos.fila2.img);
   $('#h2').text(datos.fila2.titulo);  
   $('#l2').text('Comentarios: '+datos.fila2.comentarios)   
   $('#vc2').attr('href',datos.fila2.vcometarios)
   
//tercera fila
   $('#a3').attr('href',datos.fila3.url); //enlace img
   $('#img3').attr('src',datos.fila3.img);
   $('#h3').text(datos.fila3.titulo);   
   $('#l3').text('Comentarios: '+datos.fila3.comentarios)   
   $('#vc3').attr('href',datos.fila3.vcometarios)
   
   //cuarta fila
   $('#a4').attr('href',datos.fila4.url); //enlace img
   $('#img4').attr('src',datos.fila4.img);
   $('#h4').text(datos.fila4.titulo);   
   $('#l4').text('Comentarios: '+datos.fila4.comentarios)  
   $('#vc4').attr('href',datos.fila4.vcometarios)
   
   
});


}
setInterval(msj, 20000);




");

?>
<div class="viewpost"> 
    <div id="spost" style="display: none; z-index: 1000; top:3px; position: absolute; border: 1px blueviolet solid; background-color: #ffffff; width:395px; text-align: center;">
    <?php echo CHtml::link("VER TODOS LOS POST", array('allpost','inicio'=>0,'final'=>15))?>    
</div>  
    <?php 
        $idPost = Cookie::get('anonimopost');
        $post = null;
        $dataimg = null;
        if($idPost != null)
        {
            $post=Cfapost::model()->findByPk($idPost);
            $fimg = Apostimg::model()->find('idapost='.$idPost);
            if($fimg != null)
                $dataimg = Aimagen::model()->find("idaimagen=".$fimg->idaimagen); 
        }
    ?>
    <?php if(!is_null($post) and !is_null($dataimg)){ ?>
    <div class="rowapost portlet x5">
       <div class="imagebox">
           <?php
            $img= CHtml::image(Yii::app()->request->baseUrl.'/'.$dataimg->thumb_path.'/'.$dataimg->nom_thumb);      
            echo CHtml::link($img,Yii::app()->createAbsoluteUrl('site/aimage',array('id'=>$dataimg->idaimagen)),array('class'=>'view-aimagen','rel'=>$dataimg->nombre,'alto'=>$dataimg->imgHeight));          
           ?>
       </div> 
        <div class="adetalle">
      <?php echo "<h6>".$post->titulo."</h6>";            
            echo '<ul>';
            echo "<li id='l1'>Comentarios: ".Cfacoment::model()->count("idapost='".$post->idapost."'")."</li>";
            echo "<li>".CHtml::link("Ver y Comentar", array('comentspost','id'=>$post->idapost))."</li>";
            echo '</ul>';
            ?>
         </div>   
        <div style="clear: both;"></div>
     </div> 
    <?php } else if(!is_null($post) and is_null($dataimg)){  ?>
    <div class="rowapost portlet x5">
        <div class="imagebox">
           <?php
            echo "<a href='#'>".CHtml::image(Yii::app()->request->baseUrl.'/images/default.png')."</a>"; 
           ?>
       </div> 
        <div class="adetalle">
        <?php  echo "<h6>".$post->titulo."</h6>";              
               echo '<ul>';
               echo "<li id='l1'>Comentarios: ".Cfacoment::model()->count("idapost='".$post->idapost."'")."</li>";
               echo "<li>".CHtml::link("Ver y Comentar", array('comentspost','id'=>$post->idapost))."</li>";
               echo '</ul>';
               ?>
        </div>    
     <div style="clear: both;"></div>
     </div>    
    <?php }else{  
        $numf = 1;
        $rpost =Cfapost::model()->findAllBySql("SELECT idapost,anombre, email, titulo, contenido, fecha FROM cfapost ORDER BY idapost DESC LIMIT 0,4;");
        foreach($rpost as $apost){
        ?> 
        <div class="rowapost portlet x5" id="<?php echo $numf; ?>">
            <?php if(Apostimg::model()->exists("idapost = '".$apost->idapost."'")){
                $imgTmpPost = Apostimg::model()->find("idapost = '".$apost->idapost."'");
                $imgPost =Aimagen::model()->find("idaimagen='".$imgTmpPost->idaimagen."'");
                ?>
            <div class="imagebox">
                <?php 
                $img= CHtml::image(Yii::app()->request->baseUrl.'/'.$imgPost->thumb_path.'/'.$imgPost->nom_thumb,'',array('id'=>'img'.$numf));                   
                echo CHtml::link($img,Yii::app()->createAbsoluteUrl('site/aimage',array('id'=>$imgPost->idaimagen)),array('id'=>'a'.$numf,'class'=>'view-aimagen','rel'=>$imgPost->nombre,'alto'=>$imgPost->imgHeight));          
                ?>
            </div>             
            <?php 
                  echo '<div class="adetalle">';
                  echo "<h6 id='h".$numf."'>".$apost->titulo."</h6>";                  
                  echo '<ul>';
                  echo "<li id='l".$numf."'>Comentarios: ".Cfacoment::model()->count("idapost='".$apost->idapost."'")."</li>";
                  echo "<li>".CHtml::link("Ver y Comentar", array('comentspost','id'=>$apost->idapost),array('id'=>'vc'.$numf))."</li>";
                  echo '</ul>
                      </div>';
                  
                  }else{ ?>                
            <div class="imagebox">
               <?php
                echo "<a href='#' id='a".$numf."'>".CHtml::image(Yii::app()->request->baseUrl.'/images/default.png','',array('id'=>'img'.$numf))."</a>"; 
               ?>
             </div>
            
            <?php 
                  echo '<div class="adetalle">';
                  echo "<h6 id='h".$numf."'>".$apost->titulo."</h6>";                 
                  echo '<ul>';
                  echo "<li id='l".$numf."'>Comentarios: ".Cfacoment::model()->count("idapost='".$apost->idapost."'")."</li>";
                  echo "<li>".CHtml::link("Ver y Comentar", array('comentspost','id'=>$apost->idapost),array('id'=>'vc'.$numf))."</li>";
                  echo '</ul>
                      </div>';
                  
                  }?>
                
            <div style="clear: both;"></div>
        </div> 
        <div style="clear: both;"></div>
    
    <?php $numf++; }    
    }
    ?>
</div>    