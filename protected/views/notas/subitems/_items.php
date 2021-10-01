
<div class="data-item">
    <div class="item-date">
        <ul>
            <li>Creado:<?php echo date('d/m/Y - H:i:s', $data->fechacreado)?></li>
            <li>Actualizado:<?php echo date('d/m/Y - H:i:s', $data->fechamodificado)?></li>
        </ul>
    </div>
    <div class="item-title"><?php echo $data->estado?CHtml::link($data->titulo,array('notas/nt','ui'=>$data->usuario,'nota'=>$data->idnotas,'n'=>$data->titulo)):$data->titulo;?></div>
    <div class="items-labels">Etiquetas: <?php echo $data->etiquetas;?></div>
    <div class="item-info">
        <ul>
            <?php if($data->estado){ ?>
                <?php if($_GET['ui'] == Yii::app()->user->id){ ?>
            <li><?php echo CHtml::link('Actualizar', array('notas/actualizar','ui'=>Yii::app()->user->id,'in'=>$data->idnotas))?></li>
            <li><?php echo $data->publicado=='no'?CHtml::link('Publicar',array('notas/publicar','ui'=>$data->usuario,'nota'=>$data->idnotas)):$data->archivado==1?CHtml::link('Archivado'):CHtml::link('Archivar',array(),array('id'=>'a-'.$data->usuario.'-'.$data->idnotas,'onClick'=>'archivar(this); return false;'));?></li>
                <?php }?>
            <?php }?>
            
            <li><?php echo $data->estado?CHtml::link('Ver',array('notas/nt','ui'=>$data->usuario,'nota'=>$data->idnotas,'n'=>$data->titulo)):CHtml::link('Restaurar',array('notas/restaurar','ui'=>$data->usuario,'nota'=>$data->idnotas));?></li> 
            <?php if($_GET['ui'] == Yii::app()->user->id){ ?>
            <li><?php echo $data->estado?CHtml::link('Eliminar',array('notas/dlt','ui'=>$data->usuario,'nota'=>$data->idnotas)):Chtml::link('Eliminar Definitivamente',array('notas/finaldlt','ui'=>$data->usuario,'nota'=>$data->idnotas));?></li> 
            <li>Disponible Para: <?php echo $data->publico==1?'Todos | '.CHtml::link('Mostrar solo a mis amigos',array(),array('id'=>$data->usuario.'-'.$data->idnotas,'onClick'=>'visibilidadTodos(this); return false;')):'Amigos | '.CHtml::link('Mostrar a todos',array(),array('id'=>$data->usuario.'-'.$data->idnotas,'onClick'=>'visibilidadAmigos(this); return false;'));?></li>
             <?php }?>          
        </ul>
    </div>
</div>