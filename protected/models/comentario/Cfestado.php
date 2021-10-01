<?php

/**
 * This is the model class for table "cfestado".
 *
 * The followings are the available columns in table 'cfestado':
 * @property integer $idestado
 * @property integer $id_ecomentario
 * @property string $enlace
 *
 * The followings are the available model relations:
 * @property Cfcomentario $idEcomentario
 * @property Cfshout $cfshout
 */
class Cfestado extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfestado the static model class
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
		return 'cfestado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ecomentario', 'required'),
			array('id_ecomentario', 'numerical', 'integerOnly'=>true),
			array('enlace', 'length', 'max'=>125),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idestado, id_ecomentario, enlace', 'safe', 'on'=>'search'),
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
			'idEcomentario' => array(self::BELONGS_TO, 'Cfcomentario', 'id_ecomentario'),
			'cfshout' => array(self::HAS_ONE, 'Cfshout', 'idshout'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idestado' => 'Idestado',
			'id_ecomentario' => 'Id Ecomentario',
			'enlace' => 'Enlace',
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

		$criteria->compare('idestado',$this->idestado);
		$criteria->compare('id_ecomentario',$this->id_ecomentario);
		$criteria->compare('enlace',$this->enlace,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}