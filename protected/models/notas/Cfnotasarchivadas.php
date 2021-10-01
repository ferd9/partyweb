<?php

/**
 * This is the model class for table "cfnotasarchivadas".
 *
 * The followings are the available columns in table 'cfnotasarchivadas':
 * @property string $idarchivados
 * @property string $id_notas
 * @property integer $fecha
 */
class Cfnotasarchivadas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfnotasarchivadas the static model class
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
		return 'cfnotasarchivadas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idarchivados, id_notas', 'required'),
			array('fecha', 'numerical', 'integerOnly'=>true),
			array('idarchivados, id_notas', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idarchivados, id_notas, fecha', 'safe', 'on'=>'search'),
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
			'idarchivados' => 'Idarchivados',
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

		$criteria->compare('idarchivados',$this->idarchivados,true);
		$criteria->compare('id_notas',$this->id_notas,true);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}