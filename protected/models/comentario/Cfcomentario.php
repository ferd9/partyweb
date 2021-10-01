<?php

/**
 * This is the model class for table "cfcomentario".
 *
 * The followings are the available columns in table 'cfcomentario':
 * @property integer $idcomentario
 * @property integer $idUser
 * @property integer $idcmendia
 * @property string $idnota
 * @property integer $idprivcm
 * @property string $contenido
 * @property integer $fecha
 * @property string $tipo
 *
 * The followings are the available model relations:
 * @property Cfccomentario[] $cfccomentarios
 * @property Cfccomentario[] $cfccomentarios1
 * @property Cfmedia $idcmendia0
 * @property Cfprivcm $idprivcm0
 * @property Cfusuario $idUser0 
 * @property Cfestado[] $cfestados
 */
class Cfcomentario extends CActiveRecord
{
    public $imagen;
    //private $rse;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfcomentario the static model class
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
		return 'cfcomentario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUser, idcmendia, idprivcm, fecha', 'numerical', 'integerOnly'=>true),
			array('contenido', 'safe'),
                        array('tipo', 'length', 'max'=>15),
                        array('idnota', 'length', 'max'=>20),
                       
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcomentario, idUser, idcmendia, idprivcm, contenido, fecha', 'safe', 'on'=>'search'),
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
			'cfccomentarios' => array(self::HAS_MANY, 'Cfccomentario', 'idCcomentario'),
			'cfccomentarios1' => array(self::HAS_MANY, 'Cfccomentario', 'id_Comentarios'),
			'idcmendia0' => array(self::BELONGS_TO, 'Cfmedia', 'idcmendia'),
			'idprivcm0' => array(self::BELONGS_TO, 'Cfprivcm', 'idprivcm'),
			'idUser0' => array(self::BELONGS_TO, 'Cfusuario', 'idUser'),			
			'cfestados' => array(self::HAS_MANY, 'Cfestado', 'id_ecomentario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcomentario' => 'Idcomentario',
			'idUser' => 'Id User',
			'idcmendia' => 'Idcmendia',
			'idprivcm' => 'Idprivcm',
			'contenido' => 'Comentar',
			'fecha' => 'Fecha',
                        'imagen'=>'Adjuntar una imagen al comentario',
                        'tipo'=>'tipo de comentario'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($uid)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                
		$criteria=new CDbCriteria;
                $criteria->order= 'fecha DESC';
		$criteria->compare('idUser',Yii::app()->user->id==$uid?Yii::app()->user->id:$uid);	
                $criteria->compare('tipo','status');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function comentsImagen($uid)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                
		$criteria=new CDbCriteria;
                $criteria->order= 'fecha DESC';
		$criteria->compare('idcmendia',$uid);	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function comentsPost($uid)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                
		$criteria=new CDbCriteria;
                $criteria->order= 'fecha DESC';
		$criteria->compare('idnota',$uid);	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}