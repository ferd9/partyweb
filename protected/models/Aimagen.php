<?php

/**
 * This is the model class for table "aimagen".
 *
 * The followings are the available columns in table 'aimagen':
 * @property string $idaimagen
 * @property string $nombre
 * @property string $directory
 * @property string $path
 * @property string $size
 * @property string $type
 * @property integer $imgWidth
 * @property integer $imgHeight
 * @property string $nom_thumb
 * @property string $thumb_path
 * @property integer $thumbWith
 * @property integer $thumbHeight
 * @property string $fecha
 * 
 */
class Aimagen extends CActiveRecord
{
      public static $ancho=0;
      public static $alto=0;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Aimagen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aimagen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, directory, path, size, type,  nom_thumb, thumb_path', 'required'),
			array('nombre, path, nom_thumb, thumb_path', 'length', 'max'=>125),
                        array('imgWidth, imgHeight, thumbWith, thumbHeight,fecha','numerical','integerOnly'=>true),
			array('directory, type', 'length', 'max'=>50),
			array('size', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idaimagen, nombre, directory, path, size, type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'cfaimgcoments' => array(self::HAS_MANY, 'Cfaimgcoment', 'idaimagen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idaimagen' => 'Idaimagen',
			'nombre' => 'Name',
			'directory' => 'Directory',
			'path' => 'Path',
			'size' => 'Size',
			'type' => 'Type',
                        'imgWidth'=>'Ancho Original',
                        'imgHeight'=>'Alto Original',
                        'nom_thumb'=>'nombre Thumbnail',
                        'thumb_path'=>'directorio del thumbnail',
                        'thumbWith'=>'Ancho thumbnail',
                        'thumbHeight'=>'Alto thumbnail',
                        'fecha'=>'Fecha'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idaimagen',$this->idaimagen,true);
		$criteria->compare('nombre',$this->name,true);
		$criteria->compare('directory',$this->directory,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getTypeImage($typemage)
        {
            $typeImagen = array(
                         //'bmp'=>'image/bmp',                         
                         'jpeg'=>'image/jpeg',
                         'jpg'=>'image/jpeg',
                         'png'=>'image/png',
                         'gif'=>'image/gif',
                );
             $isTypeValid = false;        
            foreach($typeImagen as $type)
            {
                if($typemage==$type)
                {
                   $isTypeValid = true;
                   break;
                }  
                
            }
            return $isTypeValid;
            
        }
        
        /**
         *
         * En el config/main.php crear 'webRoot' => dirname(dirname(__FILE__).DIRECTORY_SEPARATOR.'..')<br/>
         * en params.<br/>
         * Defectos mejorar validacion de imagenes<br/>
         * Metodo que crea thumbnail
         * @param type $img nombre de imagen
         * @param type $typeImg tipo de imagen
         * @param type $src directorio donde sta la imagen original
         * @param type $dst directorio donde se guardara la imagen(el directorio debe exitir) 
         * @param type $height alto de la imagen no es obligatorio
         * @param type $width  ancho de la imagen no es obligatorio
         * @return string retorna el nombre de la imagen minimizada
         */
        public static function createThumbnail($img,$typeImg,$src,$dst,$height=90,$width=108)
        {           
            $largeImg = '';
            $sizethumbx = $width;
            $sizethumby = $height;
            $iu = !Yii::app()->user->isGuest?Yii::app()->user->id.'_':'a_';
            $namethumb = $iu.str_replace(".", "_", microtime(true));
            
           if($typeImg == 'image/jpeg')
           {
              
             $largeImg = imagecreatefromjpeg(Yii::getPathOfAlias('webroot').'/'.$src.'/'.$img);
             
           }else if($typeImg == 'image/png')
           {                         
                                                        
               $largeImg = imagecreatefrompng(Yii::getPathOfAlias('webroot').'/'.$src.'/'.$img);
                
           }else if($typeImg == 'image/gif')
           {
              
              $largeImg = imagecreatefromgif(Yii::getPathOfAlias('webroot').'/'.$src.'/'.$img); 
               
           }
                
           
            $largeSizeX = imagesx($largeImg);
            $largeSizsy = imagesy($largeImg);
            self::$alto = $largeSizsy;
            self::$ancho = $largeSizeX;
            if($largeSizeX == false)
                return false;
            $theThumbnail = imagecreatetruecolor($sizethumbx, $sizethumby);            
            imagecopyresampled($theThumbnail, $largeImg, 0, 0, 0, 0, $sizethumbx, $sizethumby, $largeSizeX, $largeSizsy);
            if($typeImg == 'image/jpeg')
            {                
              imagejpeg($theThumbnail,Yii::getPathOfAlias('webroot').'/'.$dst.'/'.$namethumb.'.jpg'); 
              $namethumb .='.jpg';
            }                               
            else if($typeImg == 'image/png')
            {
              imagejpeg($theThumbnail,Yii::getPathOfAlias('webroot').'/'.$dst.'/'.$namethumb.'.png');
              $namethumb .= '.png';
            }else if($typeImg == 'image/gif')
            {
                imagegif($theThumbnail, Yii::getPathOfAlias('webroot').'/'.$dst.'/'.$namethumb.'.gif');
                $namethumb .= '.gif';
            }               
            
            return array('namethumb'=>$namethumb,'width'=>$largeSizeX,'height'=>$largeSizsy);
            
        }
        
}