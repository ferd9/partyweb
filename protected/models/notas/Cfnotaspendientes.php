<?php

/**
 * This is the model class for table "cfnotaspendientes".
 *
 * The followings are the available columns in table 'cfnotaspendientes':
 * @property string $idpendientes
 * @property string $id_notas
 * @property integer $fecha
 */
class Cfnotaspendientes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfnotaspendientes the static model class
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
		return 'cfnotaspendientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_notas', 'required'),
			array('fecha', 'numerical', 'integerOnly'=>true),
			array('idpendientes, id_notas', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idpendientes, id_notas, fecha', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_notas' => 'Id Notas',
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
		$criteria->compare('idpendientes',$this->idpendientes,true);
		$criteria->compare('id_notas',$this->id_notas,true);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}