<?php
/**
 * Description of Cookie
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class Cookie {
    
    /**
     * obitene un cookie por su nombre
     * @param type $name
     * @return type 
     */
    public static function get($name){
        $cookie = Yii::app()->request->cookies[$name];
        if(!$cookie)
            return null;
        return $cookie->value;
    }
    
    /**
     * establece un cookie
     * @param type $name nombre del cookie
     * @param type $value valor del cookie
     * @param type $expiration tiempo de turacion de cookie
     */
    public static function set($name,$value,$expiration=0){
        $cookie = new CHttpCookie($name,$value);
        $cookie->expire = $expiration;
        Yii::app()->request->cookies[$name]=$cookie;
        
    }
}

?>
