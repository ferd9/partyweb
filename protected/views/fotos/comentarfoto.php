<?php
/*
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/fileuploader.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/fileuploader.css');
Yii::app()->clientScript->registerScript('fupcoment','
    function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById("file-uploader-demo1"),
                action: "'.$this->createUrl('comentario/upFileComent').'",
                onComplete: function(id, fileName, responseJSON){
                    if(responseJSON.idimg!=-1)
                    {
                        imgs = document.getElementById("cimg");//$("#cimg").children(".imagebox");
                        cld = imgs.getElementsByClassName("imagebox");
                        last = cld.length - 1;
                        imgs.removeChild(cld[0]);
                        //elt = document.createElement(responseJSON.idimg);
                        g = $("#cimg").append(responseJSON.idimg);
                        //alert(g);                        
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
    ',CClientScript::POS_HEAD);*/


Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/tiny_mce/jquery.tinymce.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('tynimce','
    $().ready(function() {
		$("textarea.tinymce").tinymce({
			// Location of TinyMCE script
			script_url : "'.Yii::app()->request->baseUrl.'/js/tiny_mce/tiny_mce.js",

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "link,unlink,emotions,media,image,help,code,|,preview",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "'.Yii::app()->request->baseUrl.'/css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
    ',CClientScript::POS_HEAD);

$url = array('fotos/showpic','iu'=>$_GET['iu'],'album'=>$_GET['album']);
if($_GET['iu'] == Yii::app()->user->id)
    $url = array('fotos/misfotos','album'=>$_GET['album']);
$this->menu=array(
    array('label'=>'Regresar al album', 'url'=>$url),	
);
?>

<div class="pfotos" id="pf">    
    <div class="box-foto">
        <?php 
            $ft = CHtml::image(Yii::app()->request->baseUrl."/".$md->directorio."/".$md->nombre, "Imagen de Perfil");
            echo CHtml::link($ft);
        ?>
        <span><?php echo $md->nombre;?></span>
    </div> 
    
<div class="clear"></div>
<div class="form-coments">
 <?php           
    $model = new Cfcomentario();
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfcomentario-form',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),        
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
)); ?>
  
  		<?php //echo $form->labelEx($model,'imagen'); ?>
		<?php //echo $form->fileField($model,'imagen'); ?>
		<?php //echo $form->error($model,'imagen'); ?>
  
  <div class="row">
        <?php echo $form->hiddenField($model,'idcmendia',array('value'=>$md->idmedia)); ?>
        <?php echo $form->labelEx($model,'contenido'); ?>
        <?php if($_GET['iu'] == Yii::app()->user->id)
            echo CHtml::hiddenField("user",Yii::app()->user->id);
            else
                echo CHtml::hiddenField("user",$_GET['iu']);
        ?>
        <?php echo $form->textArea($model,'contenido',array('class'=>'tinymce','cols'=>'30','rows'=>'4')); ?>
        <?php echo $form->error($model,'contenido'); ?>
  </div>
 <div class="prow buttons">
            <?php echo CHtml::ajaxSubmitButton("Publicar Comentario", array('comentario/comentarFoto'), array(
                'success'=>'js:function(data){
                    if(data == -2)
                    {
                       //$(".list-coments").text(data);
                        $("#Cfcomentario_contenido_em_").text("NO SE PUEDE PUBLICAR UN COMENTARIO VACIO!!");
                        $("#Cfcomentario_contenido_em_").toggle();                      
                    }
                    
                    if(data != -1 && data != -2)
                    {
                        $("#yw0").prepend(data);
                        $("#Cfcomentario_contenido").val("");
                    }
                }'
            ));             
            ?> 
  </div>
    
<?php $this->endWidget();?>     
</div>    
<div class="list-coments">
<?php 
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->comentsImagen($md->idmedia),
	'itemView'=>'//comentario/_item',
        'template' => '{items}{pager}',
    ));
?>    
    
</div>
</div>
