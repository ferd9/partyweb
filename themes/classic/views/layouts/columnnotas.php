<?php $this->beginContent('//layouts/perfil'); ?>

<div class="span-18">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-7 last">
	<div id="sidebar">
         <div class="portlet x3">   
        <?php
           
            $this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
           	
	?> 
           </div>  
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
