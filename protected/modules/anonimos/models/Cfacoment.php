<?php

/**
 * This is the model class for table "cfacoment".
 *
 * The followings are the available columns in table 'cfacoment':
 * @property string $idacoment
 * @property string $idapost
 * @property string $contenido
 * @property integer $fecha
 *
 * The followings are the available model relations:
 * @property Cfapost $idapost0
 */
class Cfacoment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfacoment the static model class
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
		return 'cfacoment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idapost, contenido', 'required'),
			array('fecha', 'numerical', 'integerOnly'=>true),
			array('idapost', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idacoment, idapost, contenido, fecha', 'safe', 'on'=>'search'),
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
			'idapost0' => array(self::BELONGS_TO, 'Cfapost', 'idapost'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idacoment' => 'Idacoment',
			'idapost' => 'Idapost',
			'contenido' => 'Comentario:',
			'fecha' => 'Fecha',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($idPost)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria(array(
                    'condition'=>'idapost='.$idPost
                ));		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}