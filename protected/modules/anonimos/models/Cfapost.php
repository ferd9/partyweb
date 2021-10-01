<?php

/**
 * This is the model class for table "cfapost".
 *
 * The followings are the available columns in table 'cfapost':
 * @property string $idapost
 * @property string $anombre
 * @property string $email
 * @property string $titulo
 * @property string $contenido
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property Aimagen[] $aimagens
 * @property Cfacoment[] $cfacoments
 */
class Cfapost extends CActiveRecord
{
    public $img;
    public $codeVerify;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfapost the static model class
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
		return 'cfapost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, contenido', 'required'),
			array('anombre', 'length', 'max'=>50),
			array('email, titulo', 'length', 'max'=>125),
                    
			array('fecha', 'safe'),
                        array('codeVerify', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idapost, anombre, email, titulo, contenido, fecha', 'safe', 'on'=>'search'),
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
			'aimagens' => array(self::MANY_MANY, 'Aimagen', 'apostimg(idapost, idaimagen)'),
			'cfacoments' => array(self::HAS_MANY, 'Cfacoment', 'idapost'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idapost' => 'Idapost',
			'anombre' => 'Anombre',
			'email' => 'Email',
			'titulo' => 'Titulo',
			'contenido' => 'Contenido',
			'fecha' => 'Fecha',
                        'img'=>'Seleccionar imagen',
                        'codeVerify'=>'Codigo de verificacion'
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

		$criteria->compare('idapost',$this->idapost,true);
		$criteria->compare('anombre',$this->anombre,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('fecha',$this->fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}