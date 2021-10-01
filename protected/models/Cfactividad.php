<?php

/**
 * This is the model class for table "cfactividad".
 *
 * The followings are the available columns in table 'cfactividad':
 * @property string $idactividad
 * @property string $iduser
 * @property string $idestado
 * @property string $idnota
 * @property string $idalbum
 * @property string $idcomentario
 * @property string $idamigo
 * @property string $idamistad
 * @property string $aceptado
 * @property string $tipo
 * @property integer $fecha
 * @property string $mostrado
 */
class Cfactividad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfactividad the static model class
	 */
    
    public static $tipos = array(
                'Estado'=>'estado',
                'Nota'=>'nota',
                'Album'=>'album',
                'Comentario'=>'comentario',
                'Amigo'=>'amigo',                
                'Amistad'=>'amistad',
                'ComentPost'=>'comentpost'
        
            );
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cfactividad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iduser', 'required'),
			array('fecha', 'numerical', 'integerOnly'=>true),
			array('iduser, idestado, idnota, idalbum, idcomentario, idamigo, tipo', 'length', 'max'=>20),
			array('mostrado', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idactividad, iduser, idestado, idnota, idalbum, idcomentario, idamigo, tipo, fecha, mostrado', 'safe', 'on'=>'search'),
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
			'idactividad' => 'Idactividad',
			'iduser' => 'Iduser',
			'idestado' => 'Idestado',
			'idnota' => 'Idnota',
			'idalbum' => 'Idalbum',
			'idcomentario' => 'Idcomentario',
			'idamigo' => 'Idamigo',
			'tipo' => 'Tipo',
			'fecha' => 'Fecha',
			'mostrado' => 'Mostrado',
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

		$criteria->compare('idactividad',$this->idactividad,true);
		$criteria->compare('iduser',$this->iduser,true);
		$criteria->compare('idestado',$this->idestado,true);
		$criteria->compare('idnota',$this->idnota,true);
		$criteria->compare('idalbum',$this->idalbum,true);
		$criteria->compare('idcomentario',$this->idcomentario,true);
		$criteria->compare('idamigo',$this->idamigo,true);
                $criteria->compare('idamistad',$this->idamistad,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('fecha',$this->fecha);
		$criteria->compare('mostrado',$this->mostrado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
}