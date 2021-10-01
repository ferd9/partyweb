<?php $this->beginContent('//layouts/perfil'); ?>
<div class="span-4">
    
	<div id="sidebar">
	<?php
           
            $this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
           	
	?>
	</div><!-- sidebar -->
</div>
<div class="span-19">
        <?php  echo $this->uploadButtom;?>
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>

<?php $this->endContent(); ?>