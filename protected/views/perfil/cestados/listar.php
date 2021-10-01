<div class="span-4 columns bottombox">
column1 panel 1

</div>
<div class="span-16  columns bottombox">
 <?php if($login and isset($estados)){ ?>
    <?php 
    foreach($estados as $estado){
        echo $this->renderPartial('cestados/listaestados',array('data'=>$estado),true);
    }
    /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$estados->search(),
	'itemView'=>'cestados/listaestados',
        //'template' => '{pager}{items}{pager}',
    ));*/
 ?> 
<?php }?>    
    
</div>
<div class="span-4 bottombox right last">
column1 panel 3
</div>

