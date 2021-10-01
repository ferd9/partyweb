<?php 
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

?>
<div class="container-nt portlet x9">
    <div class="titulo-nt portlet-header"><h1><?php echo $model->titulo ?></h1></div>
    <div class="content-nt portlet-content"><?php echo $model->contenido ?></div>
</div>
<div class="form-coments">
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cfcomentario-form',
        'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'formee'),        
        'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
)); ?>
<div class="row">
        <?php echo $form->hiddenField($model2,'idnota',array('value'=>$model->idnotas)); ?>
        <?php echo $form->labelEx($model2,'contenido'); ?>
        <?php if($_GET['ui'] == Yii::app()->user->id)
            echo CHtml::hiddenField("user",Yii::app()->user->id);
            else
                echo CHtml::hiddenField("user",$_GET['ui']);
        ?>
        <?php echo $form->textArea($model2,'contenido',array('class'=>'tinymce','cols'=>'30','rows'=>'4')); ?>
        <?php echo $form->error($model2,'contenido'); ?>
  </div>
 <div class="prow buttons">
            <?php echo CHtml::ajaxSubmitButton("Publicar Comentario", array('comentario/comentarNota'), array(
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
	'dataProvider'=>$model2->comentsPost($model->idnotas),
	'itemView'=>'//comentario/_itemnota',
        'template' => '{items}{pager}',
    ));
?>    
    
</div>
