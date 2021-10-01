<?php

/**
 * This is the model class for table "cfamistad".
 *
 * The followings are the available columns in table 'cfamistad':
 * @property integer $idamistad
 * @property integer $id_User
 * @property integer $idamigo
 * @property string $confirmado
 * @property string $solicitante
 * @property string $rechazado
 * @property string $eliminado
 * @property string $blokeado
 * @property string $estado
 * @property integer $fecha
 *
 * The followings are the available model relations:
 * @property Cfusuario $idamigo0
 * @property Cfusuario $idUser
 * @property Cfprivacidad[] $cfprivacidads
 */
class Cfamistad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfamistad the static model class
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
		return 'cfamistad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_User', 'required'),
			array('fecha, id_User, idamigo', 'numerical', 'integerOnly'=>true),
			array('confirmado, blokeado', 'length', 'max'=>1),
			array('estado', 'length', 'max'=>125),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idamistad, id_User, idamigo, confirmado, blokeado, estado, fecha', 'safe', 'on'=>'search'),
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
			'idamigo0' => array(self::BELONGS_TO, 'Cfusuario', 'idamigo'),
			'idUser' => array(self::BELONGS_TO, 'Cfusuario', 'id_User'),
			'cfprivacidads' => array(self::HAS_MANY, 'Cfprivacidad', 'id_amistad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idamistad' => 'Idamistad',
			'id_User' => 'Id User',
			'idamigo' => 'Idamigo',
			'confirmado' => 'Confirmado',
			'blokeado' => 'Blokeado',
			'estado' => 'Estado',
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

		$criteria->compare('idamistad',$this->idamistad);
		$criteria->compare('id_User',$this->id_User);
		$criteria->compare('idamigo',$this->idamigo);
		$criteria->compare('confirmado',$this->confirmado,true);
		$criteria->compare('blokeado',$this->blokeado,true);
		$criteria->compare('estado',$this->estado,true);
                $criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
				$this->fecha=time();
			return true;
		}
		else
			return false;
	}
}