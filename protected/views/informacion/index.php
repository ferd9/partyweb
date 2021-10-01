<?php $id = $_GET['id']===Yii::app()->user->id?Yii::app()->user->id:$_GET['id'];
$seguridad = Cfseguridad::model()->find('iduser='.$id); ?>
<div class="span-24" >
<div class="sidemenu">
    <ul>
        <li>Invita a tus amigos</li>
    </ul>
</div>
<div class="portlet content-info">
    <div class="leftconten portlet">
        <div class="box-info">
            <h4>INFORMACION PERSONAL</h4>
            <div class="tleft portlet-content">
                <table>
                <colgroup>
                    <col class="tlabels">
                    <col class="tvalues">
                </colgroup>
                <tbody>
                      
                    <?php if(!$seguridad->setnombre){?>
                    <tr>
                        <td>Nombre de usuario: </td>
                        <td><?php echo $user->login?$user->login:'Sin definir';?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($seguridad->setnombre){?>
                    <tr>
                    <td>Nombre: </td>
                    <td><?php echo $perfil->nombre;?></td> 
                    </tr>                    
                    <tr>
                        <td>Apellidos: </td>
                        <td><?php echo $perfil->apellidos?$perfil->apellidos:'Sin definir';?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($seguridad->setedad){?>
                     <tr>
                        <td>Edad:</td>
                        <td><?php echo $perfil->edad;?></td>

                    </tr>
                    <tr>
                        <td>Fecha de nacimiento:</td>
                        <td><?php echo $perfil->fecha_nac;?></td>                        
                    </tr>
                    <?php } ?>  
                    
                     <tr>
                        <td>Sexo:</td>
                        <td><?php echo $perfil->sexo=='H'?"Hombre":"Mujer";?></td>                        
                    </tr>
                    <tr>
                        <td>Situacion sentimental:</td>
                        <td><?php 
                        if(!is_null($perfil->estado_senti))
                        {$est = Cfperfil::getEstados();
                            echo $est[$perfil->estado_senti];
                        }else
                            echo "Sin especificar";
                        ?></td>                        
                    </tr>  
                                                       
                </tbody>
            </table>
                
            </div>
            <div class="tright portlet-content">
                <table class="stable">
                    <colgroup>
                    <col class="tlabels">
                    <col class="tvalues">
                </colgroup>
                <tbody>
                    <?php if($seguridad->setemail){?>
                     <tr>
                         <td>Email:</td>
                         <td><?php echo $user->email;?></td>
                     </tr>
                     <?php } ?> 
                     
                     <?php if($seguridad->setfijo){?>
                     <tr>
                          <td>Telf. Fijo: </td>
                           <td><?php echo $perfil->fijo;?></td>
                     </tr>
                     <?php } ?>
                     
                     <?php if($seguridad->setmovil){?>
                     <tr>
                         <td>Telf. Movil: </td>
                        <td><?php echo $perfil->movil;?></td>
                     </tr>
                     <?php } ?>
                     
                     <?php if($seguridad->setnextel){?>
                     <tr>
                          <td>Nextel: </td>
                        <td><?php echo $perfil->nextel;?></td>
                     </tr> 
                     <?php } ?>
                  </tbody>
                </table>     
            </div> 
            <div style="clear:both;"></div>
        </div>
        <?php if($seguridad->setdescripcion){?>
        <div class="portlet-decoration">
            <h4>DESCRIPCION</h4>            
            
                <p><?php echo $perfil->descripcion?$perfil->descripcion:"Agrega una descripcion";?></p><br/>
            
        </div>
        <?php } ?>
        <div class="portlet-decoration">
            <h4>COSAS FAVORITAS</h4>
        </div>
    </div>
    <div class="rightconten portlet-content">
        <?php echo $foto;?>
    </div>
</div>
</div>    

