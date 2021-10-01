<?php

/**
 * This is the model class for table "cfccomentario".
 *
 * The followings are the available columns in table 'cfccomentario':
 * @property integer $idCcomentario
 * @property integer $id_Comentarios
 *
 * The followings are the available model relations:
 * @property Cfcomentario $idCcomentario0
 * @property Cfcomentario $idComentarios
 */
class Cfccomentario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfccomentario the static model class
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
		return 'cfccomentario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCcomentario, id_Comentarios', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idCcomentario, id_Comentarios', 'safe', 'on'=>'search'),
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
			'idCcomentario0' => array(self::BELONGS_TO, 'Cfcomentario', 'idCcomentario'),
			'idComentarios' => array(self::BELONGS_TO, 'Cfcomentario', 'id_Comentarios'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCcomentario' => 'Id Ccomentario',
			'id_Comentarios' => 'Id Comentarios',
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

		$criteria->compare('idCcomentario',$this->idCcomentario);
		$criteria->compare('id_Comentarios',$this->id_Comentarios);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}