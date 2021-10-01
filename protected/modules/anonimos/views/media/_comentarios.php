<div class="post">
	<div class="title">
		<?php //echo CHtml::encode($data->titulo) ?>
	</div>	
	<div class="content">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->contenido;
			$this->endWidget();
		?>
	</div>
	<div class="nav">
		Fecha: <?php echo date('d/m/y',$data->fecha); ?>
                Hora: <?php echo date('H:i:s',$data->fecha); ?>
	</div>
</div>
