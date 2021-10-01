<?php

/**
 * Description of Upfoto
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class Upfoto extends CFormModel{
    public $foto;
    
    public function rules()
    {
        return array(
           array('foto','file','types'=>'jpg, jpeg, png, gif')
            );
    }
    
}

?>
