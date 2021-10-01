<?php

/**
 * This is the model class for table "cfaimgcoment".
 *
 * The followings are the available columns in table 'cfaimgcoment':
 * @property string $idimgcoment
 * @property string $idaimagen
 * @property string $contenido
 * @property integer $fecha
 *
 * The followings are the available model relations:
 * @property Aimagen $idaimagen0
 */
class Cfaimgcoment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfaimgcoment the static model class
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
		return 'cfaimgcoment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idaimagen, contenido, fecha', 'required'),
			array('fecha', 'numerical', 'integerOnly'=>true),
			array('idaimagen', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idimgcoment, idaimagen, contenido, fecha', 'safe', 'on'=>'search'),
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
			'idaimagen0' => array(self::BELONGS_TO, 'Aimagen', 'idaimagen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idimgcoment' => 'Idimgcoment',
			'idaimagen' => 'Idaimagen',
			'contenido' => 'Contenido',
			'fecha' => 'Fecha',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($idg)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria(array(
                    'condition'=>'idaimagen='.$idg
                ));
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}