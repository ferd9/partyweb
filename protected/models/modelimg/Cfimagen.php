<?php

/**
 * This is the model class for table "cfimagen".
 *
 * The followings are the available columns in table 'cfimagen':
 * @property integer $idimagen
 * @property integer $id_media
 * @property integer $imgWidth
 * @property integer $imgHeight
 * @property string $nom_thumb
 * @property string $thumb_path
 * @property integer $thumbWidth
 * @property integer $thumbHeight
 * @property string $en_perfil
 *
 * The followings are the available model relations:
 * @property Cfmedia $idMedia
 */
class Cfimagen extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfimagen the static model class
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
		return 'cfimagen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_media', 'required'),
			array('id_media, imgWidth, imgHeight, thumbWidth, thumbHeight', 'numerical', 'integerOnly'=>true),
			array('nom_thumb', 'length', 'max'=>200),
                        array('en_perfil','length','max'=>1),
			array('thumb_path', 'length', 'max'=>125),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idimagen, id_media, imgWidth, imgHeight, nom_thumb, thumb_path, thumbWidth, thumbHeight', 'safe', 'on'=>'search'),
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
			'idMedia' => array(self::BELONGS_TO, 'Cfmedia', 'id_media'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idimagen' => 'Idimagen',
			'id_media' => 'Id Media',
			'imgWidth' => 'Img Width',
			'imgHeight' => 'Img Height',
			'nom_thumb' => 'Nom Thumb',
			'thumb_path' => 'Thumb Path',
			'thumbWidth' => 'Thumb Width',
			'thumbHeight' => 'Thumb Height',
                        'en_perfil'=>'Foto de perfil',
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

		$criteria->compare('idimagen',$this->idimagen);
		$criteria->compare('id_media',$this->id_media);
		$criteria->compare('imgWidth',$this->imgWidth);
		$criteria->compare('imgHeight',$this->imgHeight);
		$criteria->compare('nom_thumb',$this->nom_thumb,true);
		$criteria->compare('thumb_path',$this->thumb_path,true);
		$criteria->compare('thumbWidth',$this->thumbWidth);
		$criteria->compare('thumbHeight',$this->thumbHeight);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}