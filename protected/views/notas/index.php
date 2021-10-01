<?php
$baseUrl=Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/formee.js');
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/forms/formee-structure.css');
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/forms/formee-style.css');

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
			theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
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

<div class="content-notas portlet x12">
    <div class="">
      <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'cfnotas-index-form',
        'htmlOptions'=>array('class'=>'formee'),
        'enableAjaxValidation'=>false,
        )); ?>  
        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php echo $form->errorSummary($model); ?>
        <div class="grid-12-12">
            <?php echo $form->labelEx($model,'titulo'); ?>
            <?php echo $form->textField($model,'titulo'); ?>
            <?php echo $form->error($model,'titulo'); ?>               
           
        </div>
        <div class="textarea-notas grid-12-12 clear">            
            <?php echo $form->textArea($model,'contenido',array('class'=>'tinymce')); ?>
            <?php echo $form->error($model,'contenido'); ?>
        </div>
        <div class="grid-9-12 clear">
              <?php echo $form->labelEx($model,'etiquetas'); ?>
              <?php echo $form->textField($model,'etiquetas'); ?>
              <?php echo $form->error($model,'etiquetas'); ?>
              <?php echo $form->hiddenField($model,'usuario',array('value'=>Yii::app()->user->id)); ?>
              <?php echo $form->hiddenField($model,'fechamodificado',array('value'=>time())); ?> 
              <?php 
                if($model->isNewRecord)
                    echo $form->hiddenField($model,'fechacreado',array('value'=>time()));
              ?>
              <?php echo $form->hiddenField($model,'estado',array('value'=>1)); ?>
              <?php echo $form->hiddenField($model,'archivado',array('value'=>0)); ?>
        </div>
        <div class="opcion-notas grid-5-12 clear">            
            <?php echo $form->labelEx($model,'publico'); ?>
            <?php echo $form->dropDownList($model,'publico', Cfnotas::listPublicOptions(),
                    array(
                            'options'=>array($model->publico=>array('selected'=>true)),                    
                        )
                    ); ?>
            <?php echo $form->error($model,'publico'); ?>         
        </div>    
        <div class="buttons-notas grid-2-12">
            <?php 
                echo CHtml::label("Acciones", 'publicar');
                echo CHtml::submitButton($model->isNewRecord?'Publicar':'Actualizar',array('name'=>'publicar'));
                
            ?>
        </div>
        <div class="buttons-notas grid-2-12">
            <?php 
                                
                if($model->isNewRecord){
                    echo CHtml::label("Acciones", 'grabar');
                    echo CHtml::submitButton('Grabar',array('name'=>'grabar')); 
                }
            ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>




