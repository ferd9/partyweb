<?php

/**
 * This is the model class for table "cfperfil".
 *
 * The followings are the available columns in table 'cfperfil':
 * @property integer $idPerfil
 * @property string $nombre
 * @property string $apellidos
 * @property integer $foto
 * @property integer $edad
 * @property string $fecha_nac
 * @property string $sexo
 * @property string $descripcion
 * @property string $nextel
 * @property string $movil
 * @property string $fijo
 * @property string $estado_senti
 * @property string $paso_uno
 * @property string $paso_dos
 * @property string $paso_tres
 *
 * The followings are the available model relations:
 * @property Cfusuario $idPerfil0
 */
class Cfperfil extends CActiveRecordUser
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cfperfil the static model class
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
		return 'cfperfil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, sexo, fecha_nac, dia, mes, anio', 'required'),
			array('foto, edad', 'numerical', 'integerOnly'=>true),
			array('nombre, apellidos', 'length', 'max'=>200),			
			array('sexo, estado_senti, paso_uno, paso_dos, paso_tres', 'length', 'max'=>1),
			array('nextel, movil, fijo', 'length', 'max'=>15),
			array('descripcion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPerfil, nombre, apellidos, foto, edad, fecha_nac, sexo, descripcion, nextel, movil, fijo, estado_senti', 'safe', 'on'=>'search'),
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
			'idPerfil0' => array(self::BELONGS_TO, 'Cfusuario', 'idPerfil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idPerfil' => 'Id Perfil',
			'nombre' => 'Nombre',
			'apellidos' => 'Apellidos',
			'foto' => 'Foto',
			'edad' => 'Edad:',
			'fecha_nac' => 'Fecha Nacimiento',
			'sexo' => 'Sexo',
			'descripcion' => 'Descripcion',
			'nextel' => 'Nextel',
			'movil' => 'Movil',
			'fijo' => 'Fijo',
			'estado_senti' => 'Situacion sentimental',
		);
	}
        
        public static function getEstados()
        {
            return array(
                's'=>'Soltero(a)',
                'c'=>'Casado(a)',
                'a'=>'Abandonado(a)',
                'n'=>'Comprometido(a)',
                'd'=>'Dificil',
                'l'=>'Abierta'
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

		$criteria->compare('idPerfil',$this->idPerfil);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('foto',$this->foto);
		$criteria->compare('edad',$this->edad);
		$criteria->compare('fecha_nac',$this->fecha_nac,true);
		$criteria->compare('sexo',$this->sexo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('nextel',$this->nextel,true);
		$criteria->compare('movil',$this->movil,true);
		$criteria->compare('fijo',$this->fijo,true);
		$criteria->compare('estado_senti',$this->estado_senti,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}