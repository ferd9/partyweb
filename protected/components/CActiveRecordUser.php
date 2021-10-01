<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CActiveRecordUser
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class CActiveRecordUser extends CActiveRecord{    
    public $dia;
    public $mes;
    public $anio;
    public $verifyPass;
    
     public static function usexo()
     {
            $dsexo = array('H'=>'Hombre','M'=>'Mujer');
            return $dsexo;
     }
     
      public static function dias()
        {
            $ndias = array();
            for($i=1;$i<=31;$i++)
            {
                if($i<10)
                    $i = '0'.$i;
                $ndias[$i]=$i;
            }
            
            return $ndias;
        }
        
        public static function meses()
        {
            $nmeses = array(
               '01'=>'Enero',
               '02'=>'Febrero',
               '03'=>'Marzo',
               '04'=>'Abril',
               '05'=>'Mayo',
               '06'=>'Junio',
               '07'=>'Julio',
               '08'=>'Agosto',
               '09'=>'Setiembre',
               '10'=>'Octubre',
               '11'=>'Noviembre',
               '12'=>'Diciembre'
            );
            
            return $nmeses;
        }
        
        public static function anios()
        {
            
            $nanios =array();
            for($i=date('Y');$i>=1905;$i--){
                $nanios[$i]=$i;                
            }
            return  $nanios;
        }
        
       
}

?>
