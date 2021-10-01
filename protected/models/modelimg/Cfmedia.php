<?php

/**
 * This is the model class for table "cfmedia".
 *
 * The followings are the available columns in table 'cfmedia':
 * @property integer $idmedia
 * @property integer $id_mCategoria
 * @property integer $idPrivcm
 * @property string $nombre
 * @property string $directorio
 * @property string $ruta
 * @property integer $size
 * @property double $fecha
 *
 * The followings are the available model relations:
 * @property Cfcomentario[] $cfcomentarios
 * @property Cfimagen[] $cfimagens
 * @property Cfmediacategoria $idMCategoria
 * @property Cfprivcm $idPrivcm0
 * @property Cfpresentacion[] $cfpresentacions
 */
class Cfmedia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfmedia the static model class
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
		return 'cfmedia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_mCategoria, idPrivcm, size', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>200),
			array('directorio', 'length', 'max'=>50),
			array('ruta', 'length', 'max'=>125),
                        array('fecha','numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idmedia, id_mCategoria, idPrivcm, nombre, directorio, ruta, size, fecha', 'safe', 'on'=>'search'),
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
			'cfcomentarios' => array(self::HAS_MANY, 'Cfcomentario', 'idcmendia'),			
			'cfimagens' => array(self::HAS_MANY, 'Cfimagen', 'id_media'),
			'idMCategoria' => array(self::BELONGS_TO, 'Cfmediacategoria', 'id_mCategoria'),
			'idPrivcm0' => array(self::BELONGS_TO, 'Cfprivcm', 'idPrivcm'),
			'cfpresentacions' => array(self::HAS_MANY, 'Cfpresentacion', 'idImg'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idmedia' => 'Idmedia',
			'id_mCategoria' => 'Id M Categoria',
			'idPrivcm' => 'Id Privcm',
			'nombre' => 'Nombre',
			'directorio' => 'Directorio',
			'ruta' => 'Ruta',
			'size' => 'Size',
			'fecha' => 'Fecha',
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

		$criteria->compare('idmedia',$this->idmedia);
		$criteria->compare('id_mCategoria',$this->id_mCategoria);
		$criteria->compare('idPrivcm',$this->idPrivcm);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('directorio',$this->directorio,true);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}