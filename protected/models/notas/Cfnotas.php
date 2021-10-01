<?php

/**
 * This is the model class for table "cfnotas".
 *
 * The followings are the available columns in table 'cfnotas':
 * @property string $idnotas
 * @property integer $usuario
 * @property string $titulo
 * @property string $contenido
 * @property string $etiquetas
 * @property string $publicado
 * @property string $archivado
 * @property string $publico
 * @property integer $fechamodificado
 * @property integer $fechacreado
 * @property string $estado
 */
class Cfnotas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfnotas the static model class
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
		return 'cfnotas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, contenido, etiquetas, publico', 'required'),
			array('usuario, fechamodificado, fechacreado', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>120),
			array('etiquetas', 'length', 'max'=>250),
			array('publicado, archivado', 'length', 'max'=>2),
			array('publico', 'length', 'max'=>1),
			array('estado', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idnotas, usuario, titulo, contenido, etiquetas, publicado, archivado, publico, fechamodificado, fechacreado, estado', 'safe', 'on'=>'search'),
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
			'idnotas' => 'Idnotas',
			'usuario' => 'Usuario',
			'titulo' => 'Titulo',
			'contenido' => 'Contenido',
			'etiquetas' => 'Etiquetas',
			'publicado' => 'Publicado',
			'archivado' => 'Archivado',
			'publico' => 'Publico',
			'fechamodificado' => 'Fechamodificado',
			'fechacreado' => 'Fechacreado',
			'estado' => 'Estado',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($ui,$opcion='',$aliminado='')
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idnotas',$this->idnotas,true);
		$criteria->compare('usuario',$ui);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('etiquetas',$this->etiquetas,true);
                if($opcion == 'publish')
                    $criteria->compare('publicado','si',true);
                else if($opcion == 'pendiente')
                    $criteria->compare('publicado','no',true);
                else
                    $criteria->compare('publicado',$this->publicado,true);
		$criteria->compare('archivado',$this->archivado,true);
		$criteria->compare('publico',$this->publico,true);
		$criteria->compare('fechamodificado',$this->fechamodificado);
		$criteria->compare('fechacreado',$this->fechacreado);
                if($aliminado == '0')
                    $criteria->compare('estado',$aliminado,true);
                 else   
                    $criteria->compare('estado',1,true);
                 $criteria->order= 'fechamodificado DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function listPublicOptions()
        {
            return array(
                1=>'Publico(todo el mundo podra verla)',
                2=>'Privado(solo amigos podran verla)',
            );
        }
}