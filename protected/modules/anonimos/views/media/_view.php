<?php 
Yii::app()->clientScript->registerCss('aimages',"
  .items{
    display:block !important;
    float:right;
 }  
"
 );
?>
<div class="span-3">
 <div class="imagebox"> 
     <?php 
        // print_r($data->cfaimgcoments);   
        $tmpimg = Yii::app()->request->baseUrl.'/'.$data->thumb_path.'/'.$data->nom_thumb; 
        $img= CHtml::image($tmpimg);        
        echo CHtml::link($img,array('comentar','id'=>$data->idaimagen),array('class'=>'view-aimagen1','rel'=>$data->nombre,'alto'=>$data->imgHeight,'target'=>'_blank'));          
    ?>
 </div>    
</div>
