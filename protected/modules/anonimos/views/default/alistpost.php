<div class="viewpost2"> 
<?php
        $npost = Cfapost::model()->count();        
        $rpost =Cfapost::model()->findAllBySql("SELECT idapost,anombre, email, titulo, contenido, fecha FROM cfapost ORDER BY idapost DESC limit ".$inicio.",".$final);
         $actual = $inicio;
     if($inicio>=1)
        $inicio = 0;
     $npag = 15;
    $counter = 1;
    $clase ="";
    ?>
 <div>   
   <ul> 
    <?php for($i=0;$i<$npost;$i+=$npag){
    echo "<li>";
    if($counter==1)
    echo CHtml::link($counter,array('allpost','inicio'=>$inicio,'final'=>$npag));
    else
    {   
        
        $inicio=($counter-1) *$npag; 
        if($actual == $i)
            $clase= "selected";
        else
            $clase = "noselect";
        echo CHtml::link($counter,array('allpost','inicio'=>$inicio,'final'=>$npag),array('class'=>$clase));        
    }
    echo "</li>";
    $counter++;
    }
    
    ?> 
 </ul> 
     </div> 
    <div style="clear: both;"></div>
<?php    
        foreach($rpost as $apost){
        ?> 
        <div class="rowapost portlet x12">
            <?php if(Apostimg::model()->exists("idapost = '".$apost->idapost."'")){
                $imgTmpPost = Apostimg::model()->find("idapost = '".$apost->idapost."'");
                $imgPost =Aimagen::model()->find("idaimagen='".$imgTmpPost->idaimagen."'");
                ?>
            <div class="imagebox">
                <?php 
                $img= CHtml::image(Yii::app()->request->baseUrl.'/'.$imgPost->thumb_path.'/'.$imgPost->nom_thumb);      
                echo CHtml::link($img,Yii::app()->createAbsoluteUrl('site/aimage',array('id'=>$imgPost->idaimagen)),array('class'=>'view-aimagen','rel'=>$imgPost->nombre,'alto'=>$imgPost->imgHeight,'target'=>'_blank'));          
                ?>
            </div>            
            <?php 
                  echo '<div class="adetalle-list">';
                  echo "<h5>".$apost->titulo."</h5>";
                  echo "<div class='content-apost'>".$apost->contenido."</div>"; 
                  echo '<ul>';
                  echo "<li>Comentarios: ".Cfacoment::model()->count("idapost='".$apost->idapost."'")."</li>";
                  echo "<li>".CHtml::link("Ver Post completo y comentar", array('comentspost','id'=>$apost->idapost))."</li>";
                  echo "<li>Fecha: ".date("d/m/Y",$apost->fecha)."</li>";
                  echo "<li>Hora: ".date("h:i:s",$apost->fecha)."</li>";
                  echo '</ul>
                      </div>';
                  
                  }else{ ?>
            <div class="imagebox">
               <?php
                echo CHtml::image(Yii::app()->request->baseUrl.'/images/default.png'); 
               ?>
             </div>
            <?php 
                  echo '<div class="adetalle-list">';
                  echo "<h5>".$apost->titulo."</h5>";
                  echo "<div class='content-apost'>".$apost->contenido."</div>"; 
                  echo '<ul>';
                  echo "<li>Comentarios: ".Cfacoment::model()->count("idapost='".$apost->idapost."'")."</li>";
                  echo "<li>".CHtml::link("Ver Post completo y comentar", array('comentspost','id'=>$apost->idapost))."</li>";
                  echo "<li>Fecha: ".date("d/m/Y",$apost->fecha)."</li>";
                  echo "<li>Hora: ".date("h:i:s",$apost->fecha)."</li>";
                  echo '</ul>
                      </div>';
                  
                  }?>
            <div style="clear: both;"></div>
        </div> 
        <div style="clear: both;"></div>
    
    <?php } 
?>
<div>        
 <ul> 
    <?php 
    
     $npag = 15;
     //$actual = $inicio;
     if($inicio>1)
        $inicio = 0;
    $counter = 1;
    $clase ="";
    
    for($i=0;$i<$npost;$i+=$npag){
    echo "<li>";
    if($counter==1)
    echo CHtml::link($counter,array('allpost','inicio'=>$inicio,'final'=>$npag));
    else
    {   
        
        $inicio=($counter-1) *$npag; 
        if($actual == $i)
            $clase= "selected";
        else
            $clase = "noselect";
        echo CHtml::link($counter,array('allpost','inicio'=>$inicio,'final'=>$npag),array('class'=>$clase));        
    }
    echo "</li>";
    $counter++;
    }
    ?> 
 </ul>
  </div>  
 </div> 
