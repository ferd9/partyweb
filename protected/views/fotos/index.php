<?php 
 Yii::app()->clientScript->registerScript('cam',"
  var foto = 'undefined';
  var iframe; //= document.getElementById('hi');
  var iflle;
  /*im = document.getElementById('Cfmediacategoria_portada');
  if('multiple' in im &&
        typeof File != 'undefined' &&
        typeof (new XMLHttpRequest()).upload != 'undefined' )
    alert('soportado');
    else
        alert('no soportado');*/
    
  
 function saludo()
 {  
    if (iframe.contentDocument &&
                iframe.contentDocument.body &&
                iframe.contentDocument.body.innerHTML == 'false'){
                // In Opera event is fired second time
                // when body.innerHTML changed from false
                // to server response approx. after 1 sec
                // when we upload file with iframe
                
               
               return;
            }else
            {
                var doc = iframe.contentDocument ? iframe.contentDocument: iframe.contentWindow.document;
                var cnt = doc.body.innerHTML;
                if(typeof dv != 'undefined'){
                    dv.style.left= '0px';
                    dv.style.width='0px';
                }
                setTimeout(function(){
                        iframe.parentNode.removeChild(iframe);
                    }, 1);                
                //alert(cnt);
                nombre.val('');
                $('.pfotos').prepend(cnt);
                $('#btncreate').show();
            }
       
        
        
    //alert('holaaa');
 };     
function createIframe(){
    
    iframe = '<iframe src=\"javascript:false;\" name=\"hi\" />';    
    var div = document.createElement('div');
    div.innerHTML = iframe;
    var element = div.firstChild;
    iframe = element;
    iframe.setAttribute('id', 'hi');
    iframe.style.display = 'none';
    if (iframe.addEventListener)
       {
            iframe.addEventListener('load', saludo, false);
       }else if (iframe.attachEvent){
            iframe.attachEvent('onload', saludo);
        }
    div.removeChild(element);
    //alert(iframe);
}


function sendForajax(){

$.ajax({
        type:'POST',
        url:'".$this->createUrl('fotos/crearAlbum')."'+url,        
        beforeSend:function(xhr){
            if(foto != 'undefined'){
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('X-File-Name', encodeURIComponent(nombre.val()));
            }
            
        },
        contentType:foto!= 'undefined'?'application/octet-stream':'application/x-www-form-urlencoded',
        processData:foto!= 'undefined'?false:true,
        data:foto!= 'undefined'?foto:'name='+nombre.val()+'&foto='+encodeURIComponent(ftnom),
        success:function(msj){
            switch(msj)
            {
                case -1:
                    alert('No se pudo crear el album');
                    break;
                case -2:
                    alert('No se pudo crear thumbnail');
                break;
                case -3:
                    alert('Media no se pudo validar');
                break;
                case -4:
                    alert('Media no se pudo guardar');
                break;
                case -5:
                    alert('Imagen no se pudo guardar');
                break;
                case -6:
                    alert('album no se pudo actualizar');
                break;
                default:
                    //foto = 'undefined'
                    nombre.val('');
                    if(foto != 'undefined')
                        $('#Cfmediacategoria_portada').val('');                    
                    $('.pfotos').prepend(msj);
                    $('#btncreate').show();
                    
            }
        }
    })
}

$('#Cfmediacategoria_portada').mouseover(function(){
    if ($.browser.msie || $.browser.opera)
    {
       var input = document.createElement('input'); 
       input.setAttribute('type', 'file');
       input.setAttribute('name', 'mcportada');     
       
       dv = document.getElementById('dvinput');       
       dv.style.opacity = 1;
       dv.style.left= '257px';
       dv.style.width='245px';
       dv.appendChild(input);
       iflle = input;
        return false;
    }        
     else 
        return true;   
})



 img = $('#Cfmediacategoria_portada').change(function(input){
           im = document.getElementById('Cfmediacategoria_portada'); 
           if('multiple' in im &&
        typeof File != 'undefined' &&
        typeof (new XMLHttpRequest()).upload != 'undefined' )
           foto = im.files[0];
          // alert(foto);
       }) 

$('#btncreate').click(function(){
        
       ftnom = -1; 
       nombre = $('#Cfmediacategoria_nombre');
       url = '';
       if(nombre.val() == null || nombre.val().length == 0 || /^\s+$/.test(nombre.val()))
        {
            alert('Ingrese un nombre');
            return false;
        }else
        {
            $('#btncreate').hide();
        }
      
         
         if ($.browser.msie || $.browser.opera){                
                
                   createIframe();

                    var formu = '<form method=\"post\" enctype=\"multipart/form-data\"></form>';                
                    var div = document.createElement('div');                
                    div.innerHTML = formu;                
                    fr = div.firstChild;
                    fr.setAttribute('action', '".$this->createUrl('fotos/crearAlbum')."');
                    fr.setAttribute('target', iframe.name);                
                    var nm = document.getElementById('Cfmediacategoria_nombre');
                    var nomb = document.createElement('input');

                    nomb.type = 'text';
                    nomb.name = 'name';
                    nomb.value = nm.value;

                    fr.appendChild(nomb);
                    if(typeof iflle != 'undefined')
                        fr.appendChild(iflle);                   
                    iframe.appendChild(fr);             
                    document.body.appendChild(iframe); 
                   fr.submit();
                   
               
               
            }else{
                 if(foto != 'undefined'){
                     ftnom = $('#Cfmediacategoria_portada').val();
                     url='?name='+nombre.val()+'&foto='+encodeURIComponent(ftnom);
                     //alert(foto+' fotoooooo');
                 }
                    sendForajax();
            }

    return false;
})


 ",CClientScript::POS_END);    
 ?>



<?php
$this->menu=array(
	array('label'=>'Crear Album', 'url'=>array('#'),'linkOptions'=>array('onclick'=>'alert("hola"); return false;')),
	array('label'=>'Subir Fotos', 'url'=>array('Subir Fotos')),
);
?>
<div class="form-create-album">
       
<div id="form-album">    
    <?php 
        $categoria = new Cfmediacategoria();
        $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Cfmediacategoria-form',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),    
	'enableAjaxValidation'=>false,
)); 
    ?>
    
    	<?php echo $form->errorSummary($categoria); ?>

	<div class="row" id="cfile">
            <div id="dvinput" style="z-index: 10; background: #aaffbb; position: absolute; height: 23px;"></div>
                <?php echo $form->labelEx($categoria,'nombre'); ?>
		<?php echo $form->textField($categoria,'nombre'); ?>
		<?php echo $form->error($categoria,'nombre'); ?>
            
		<?php echo $form->labelEx($categoria,'portada'); ?>
		<?php echo $form->fileField($categoria,'portada'); ?>
		<?php echo $form->error($categoria,'portada'); ?>
            
                <?php echo CHtml::submitButton('Crear Album',array('id'=>'btncreate')); ?>
	</div>
	    
    <?php $this->endWidget(); ?>
 </div>
</div>
<div class="pfotos">
    <?php 
        $query = "select * from cfmediacategoria where id_perfil=".Yii::app()->user->id." order by fecha desc";
        $albums = Yii::app()->db->createCommand($query)->queryAll(); 
        foreach($albums as $album){        
      ?>
    <div class="box-album">
        <?php 
            $portada= null;
            if(is_numeric($album['portada']))
                $portada = Cfimagen::model()->find("id_media=".$album['portada']);
            
            $ft = CHtml::image(Yii::app()->request->baseUrl."/uphoto/default_album.png", "Imagen de Perfil");
            if($portada != null)
                $ft = CHtml::image(Yii::app()->request->baseUrl."/".$portada->thumb_path."/".$portada->nom_thumb, "Imagen de Perfil");
            echo CHtml::link($ft,array("fotos/misfotos","album"=>$album['idmcategoria']));
        ?>
        <span><?php echo $album['nombre']." (".Cfmedia::model()->count("id_mCategoria=".$album['idmcategoria']).")";?></span>
    </div> 
    <?php } ?>
<div class="clear"></div> 

</div>