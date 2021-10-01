<?php
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
                element: document.getElementById("upfoto"),
                action: "'.$this->createUrl('fotos/uploadfoto').'",
                params: {album:"'.$album.'"},    
                onComplete: function(id, fileName, responseJSON){
                    if(responseJSON.success && responseJSON.foto != -1){
                        foto = htmlspecialChars(responseJSON.foto);
                        $("#pf").prepend(foto);                        
                    }                    
                },
                multiple: true,
                //listElement: null,
                debug: false
            });           
        }
        
        // in your app create uploader as soon as the DOM is ready
        // dont wait for the window to load  
        window.onload = createUploader;  
    ',CClientScript::POS_HEAD);

$this->uploadButtom = '<div id="upfoto">	
		<noscript>			
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
                        
		</noscript>         
	</div>';
$this->menu=array(
	array('label'=>'Ver Albums', 'url'=>array('fotos/index')),
	//array('label'=>'Subir Fotos', 'url'=>array('Subir Fotos'),array('id'=>'file-uploader-demo1')),
);
?>
<div class="pfotos" id="pf">
    <?php 
        $query = "select * from cfmedia where id_mCategoria=".$album." order by fecha desc";
        $fotos = Yii::app()->db->createCommand($query)->queryAll(); 
        foreach($fotos as $foto){        
      ?>
    <div class="box-album">
        <?php $portada = Cfimagen::model()->find("id_media=".$foto['idmedia']);
            $ft = CHtml::image(Yii::app()->request->baseUrl."/".$portada->thumb_path."/".$portada->nom_thumb, "Imagen de Perfil");
            echo CHtml::link($ft,array('fotos/comentarFoto','iu'=>Yii::app()->user->id,'album'=>$album,'foto'=>$foto['idmedia']));
        ?>
        <span><?php echo $foto['nombre'];?></span>
    </div> 
    <?php } ?>
<div class="clear"></div>    
</div>
