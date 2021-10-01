<?php $this->pageTitle=Yii::app()->name; 

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/fileuploader.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/fileuploader.css');
Yii::app()->clientScript->registerScript('fuploader','
    
    function htmlspecialChars(ctn)
    {
	var especiachars = [/&quot;/gi,/&lt;/gi,/&gt;/gi]
	var htmlchar = ["","<",">"]
	for(var i=0;i<especiachars.length;i++)
	{
		ctn = ctn.replace(especiachars[i],htmlchar[i])	
	}
	
	return ctn;
    }

    function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById("file-uploader-demo1"),
                action: "'.Yii::app()->getController()->createUrl('site/uploadImage').'",
                onComplete: function(id, fileName, responseJSON){
                    if(responseJSON.idimg!=-1)
                    {
                        imgs = document.getElementById("cimg");//$("#cimg").children(".imagebox");
                        cld = imgs.getElementsByClassName("imagebox");
                        last = cld.length - 1;
                        imgs.removeChild(cld[0]);
                        //elt = document.createElement(responseJSON.idimg);
                        
                            g = $("#cimg").append(htmlspecialChars(responseJSON.idimg));
                        
                        //alert(htmlspecialChars(responseJSON.idimg));                        
                    }                        
                },
                multiple: false,
                //listElement: null,
                debug: false
            });           
        }
        
        // in your app create uploader as soon as the DOM is ready
        // dont wait for the window to load  
        window.onload = createUploader;  
    ',CClientScript::POS_HEAD);

$newaimagen=isset($newaimagen)?(int)$newaimagen:0;
//$hora = getdate();
//print_r(timezone_abbreviations_list());
//echo date_default_timezone_set('America/Lima');
//$zonah = timezone_open('America/Lima');

//print_r(timezone_location_get($zonah));
//$timepais = date_create(date('h:i:s',time()),$zonah);

// echo $timepais->getTimestamp();

//echo date('h:i:s',$timepais->getTimestamp()).'<br/>';

//echo $hora['hours'].':'.$hora['minutes'].':'.$hora['seconds'];
//echo $_SERVER['REMOTE_ADDR'];
//$ua = new UserAgent();
//echo $ua->browser().' '.$ua->version().' '.$ua->os();

?>
<div class="span-25 last">    
      
<div class="portlet x4">    
    <div id="header">
	<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>        
    </div><!-- header -->
    <div class="portlet-content">
        <div id="file-uploader-demo1">		
		<noscript>			
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
		</noscript>         
	</div>
        <?php 
        /*
        echo CHtml::beginForm(Yii::app()->getController()->createUrl('site/uploadImage'),'post',array('enctype'=>'multipart/form-data'));
        echo CHtml::fileField('aimagen');
        echo CHtml::submitButton('Subir Imagen');
        echo CHtml::endForm(); */   
            ?>
    </div>
</div>
<div class="portlet x8">    
    <div class="portlet-header">
        <h4><?php if(Yii::app()->user->isGuest) {
        echo CHtml::link('Registrarse',array('site/registro'));
     }?>
     </h4></div> 
    <div class="portlet-content">
    </div>
</div>
</div>
  

<!-- <div class="portlet x12">
    TEXT MODE TWITTER
    <div class="portlet-content">
        <div class="clearfix" id="big_stats"> 
        </div> 
    </div>
</div> -->
<div class="portlet x12">
    <div class="portlet-header"><h4>IMAGENES DE USUARIOS ANONIMOS</h4></div> 
 <div class="portlet-content content-img">
      
  <div id="cimg">       
 <?php  $inicio = 0;
    
    switch($newaimagen)
    {
        case 9:
            $inicio = 1;
            break;
        case 10:
            $inicio = 2;
            break;
        case 11:
            $inicio = 3;
            break;
        case 12:
            $inicio = 4;
            break;
        case 13:
            $inicio = 5;
            break;
        case 14:
            $inicio = 6;
            break;
        case 15:
            $inicio = 7;
            break;
    }
    if($newaimagen>16){  
        $inicio = $newaimagen-8;
    }
    //echo $inicio."  ".$newaimagen."<br>";
     $aimages = Aimagen::model()->findAllBySql("SELECT idaimagen,nombre,imgWidth,imgHeight,thumb_path,nom_thumb  FROM aimagen LIMIT ".$inicio.", ".$newaimagen.";");
    // echo get_class($aimages[0]);
     //echo CHtml::beginForm();
     foreach($aimages as $tmpimages)
     {?> 
    <div class="imagebox">
    <?php 
            
        $tmpimg = Yii::app()->request->baseUrl.'/'.$tmpimages->thumb_path.'/'.$tmpimages->nom_thumb; 
        $img= CHtml::image($tmpimg);        
        echo CHtml::link($img,array('aimage','id'=>$tmpimages->idaimagen),array('class'=>'view-aimagen','rel'=>$tmpimages->nombre,'alto'=>$tmpimages->imgHeight));          
    ?></div>
         
   <?php  }
   //echo CHtml::endForm();
    ?>  
    </div>  
      <div class="clearfix">  </div> 
</div>
</div>
<div class="portlet x3 spaceleft">
 <div class="portlet-header"><h4>Publicaciones Anónimos</h4></div> 
 <div class="portlet-content">
	<ul id="invoice_actions">
                 <?php $posts = Yii::app()->db->createCommand("select idapost, titulo from cfapost order by fecha desc limit 7")->queryAll();
            ?>
            <?php foreach($posts as $post){?>
                <li class="send">
                <?php 
                    $tt = $post['titulo'];
                    if(strlen($post['titulo'])>34)
                    {
                       $tmp = str_split($post['titulo'], 31);
                       $tt=$tmp[0]."...";
                    }                        
                                       
                echo CHtml::link($tt,array('anonimos/default/comentspost','id'=>$post['idapost']));
                ?>
                </li>               
             <?php }?>   
        </ul>
</div>
</div>


<div class="portlet x3">
<div class="portlet-header"><h4>Imagenes Recientes</h4></div> 
 <div class="portlet-content">
	
        <ul id="invoice_actions">
            <?php $images = Yii::app()->db->createCommand("select * from aimagen order by fecha desc limit 7")->queryAll();
            ?>
            <?php foreach($images as $imagen){?>
                <li class="send">
                <?php $img= Yii::app()->request->baseUrl."/".$imagen['thumb_path']."/".$imagen['nom_thumb']; 
                        $im = Chtml::image($img, $imagen['nombre'],array('width'=>'45','height'=>'30'));
                        echo CHtml::link($im,array('anonimos/media/comentar','id'=>$imagen['idaimagen']));
                        ?>
                </li>               
            <?php }?>
        </ul>
</div>
</div>




<div class="portlet x3">
<div class="portlet-header"><h4>Publicaciones Registrados</h4></div> 
 <div class="portlet-content">

        <ul id="invoice_actions">
            <?php $notas = Yii::app()->db->createCommand("select idnotas, titulo, usuario from cfnotas where publicado='si' and publico = 1 and estado=1 order by fechamodificado desc limit 7")->queryAll();
            ?>
            <?php foreach($notas as $nota){?>
                <li class="send">
                <?php 
                    $tt = $nota['titulo'];
                    if(strlen($nota['titulo'])>34)
                    {
                       $tmp = str_split($nota['titulo'], 31);
                       $tt=$tmp[0]."...";
                    }                        
                                       
                echo CHtml::link($tt,array('notas/nt','ui'=>$nota['usuario'],'nota'=>$nota['idnotas'],'n'=>$nota['titulo']));
                ?>
                </li>               
             <?php }?>   
        </ul>
</div>
</div>

<div class="portlet x3">
<div class="portlet-header"><h4>column1 panel 4</h4></div> 
 <div class="portlet-content">
				
        <div id="invoice_total">$4100.00</div>

        <ul id="invoice_actions">
                <li class="send"><a href="javascript:;">Send Invoice</a></li>
                <li class="edit"><a href="javascript:;">Edit Invoice</a></li>
                <li class="print"><a href="javascript:;">Print Invoice</a></li>
                <li class="duplicate"><a href="javascript:;">Duplicate Invoice</a></li>
                <li class="delete"><a href="javascript:;">Delete Invoice</a></li>
                <li class="change"><a href="javascript:;">Change Status</a></li>
        </ul>
</div>
</div>
