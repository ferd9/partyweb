<?php

/**
 * This is the model class for table "cfmediacategoria".
 *
 * The followings are the available columns in table 'cfmediacategoria':
 * @property integer $idmcategoria
 * @property integer $id_perfil
 * @property string $nombre
 * @property integer $portada
 * @property integer $fecha
 * @property string $tipo
 *
 * The followings are the available model relations:
 * @property Cfmedia[] $cfmedias
 * @property Cfperfil $idPerfil
 */
class Cfmediacategoria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfmediacategoria the static model class
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
		return 'cfmediacategoria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_perfil, portada, fecha', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>50),
                        array('tipo', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idmcategoria, id_perfil, nombre, portada, fecha', 'safe', 'on'=>'search'),
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
			'cfmedias' => array(self::HAS_MANY, 'Cfmedia', 'id_mCategoria'),
			'idPerfil' => array(self::BELONGS_TO, 'Cfperfil', 'id_perfil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idmcategoria' => 'Idmcategoria',
			'id_perfil' => 'Id Perfil',
			'nombre' => 'Nombre',
			'portada' => 'Portada',
			'fecha' => 'Fecha',
                        'tipo' => 'Tipo de album',
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

		$criteria->compare('idmcategoria',$this->idmcategoria);
		$criteria->compare('id_perfil',$this->id_perfil);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('portada',$this->portada);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}