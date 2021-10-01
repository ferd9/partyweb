<?php

/**
 * This is the model class for table "cfseguridad".
 *
 * The followings are the available columns in table 'cfseguridad':
 * @property string $idseguridad
 * @property string $iduser
 * @property string $setlogin
 * @property string $setemail
 * @property string $setnombre
 * @property string $setedad
 * @property string $setdescripcion
 * @property string $setnextel
 * @property string $setmovil
 * @property string $setfijo
 * @property integer $fecha
 */
class Cfseguridad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfseguridad the static model class
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
		return 'cfseguridad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha', 'numerical', 'integerOnly'=>true),
			array('iduser', 'length', 'max'=>20),
			array('setlogin, setemail, setnombre, setedad, setdescripcion, setnextel, setmovil, setfijo', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idseguridad, iduser, setlogin, setemail, setnombre, setedad, setdescripcion, setnextel, setmovil, setfijo, fecha', 'safe', 'on'=>'search'),
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
			'idseguridad' => 'Idseguridad',
			'iduser' => 'Iduser',
			'setlogin' => 'Mostrar Nombre de usuario',
			'setemail' => 'Mostrar Email',
			'setnombre' => 'Mostrar Nombre',
			'setedad' => 'Mostrar Edad',
			'setdescripcion' => 'Mostrar descripcion',
			'setnextel' => 'Mostrar Numero de nextel',
			'setmovil' => 'Mostrar Numero de celular',
			'setfijo' => 'Mostrar Numero de Telf. fijo',
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

		$criteria->compare('idseguridad',$this->idseguridad,true);
		$criteria->compare('iduser',$this->iduser,true);
		$criteria->compare('setlogin',$this->setlogin,true);
		$criteria->compare('setemail',$this->setemail,true);
		$criteria->compare('setnombre',$this->setnombre,true);
		$criteria->compare('setedad',$this->setedad,true);
		$criteria->compare('setdescripcion',$this->setdescripcion,true);
		$criteria->compare('setnextel',$this->setnextel,true);
		$criteria->compare('setmovil',$this->setmovil,true);
		$criteria->compare('setfijo',$this->setfijo,true);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}