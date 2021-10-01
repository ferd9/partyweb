<?php

/**
 * This is the model class for table "cfubitacora".
 *
 * The followings are the available columns in table 'cfubitacora':
 * @property string $idBitacora
 * @property integer $iduser
 * @property string $fecha
 * @property string $hora
 * @property string $browser
 * @property string $sistema
 * @property string $ip
 * @property string $last_login
 *
 * The followings are the available model relations:
 * @property Cfusuario $iduser0
 */
class Cfubitacora extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cfubitacora the static model class
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
		return 'cfubitacora';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iduser', 'numerical', 'integerOnly'=>true),
			array('browser, sistema', 'length', 'max'=>50),
			array('ip', 'length', 'max'=>15),
			array('fecha, hora, last_login', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idBitacora, iduser, fecha, hora, browser, sistema, ip, last_login', 'safe', 'on'=>'search'),
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
			'iduser0' => array(self::BELONGS_TO, 'Cfusuario', 'iduser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idBitacora' => 'Id Bitacora',
			'iduser' => 'Iduser',
			'fecha' => 'Fecha',
			'hora' => 'Hora',
			'browser' => 'Browser',
			'sistema' => 'Sistema',
			'ip' => 'Ip',
			'last_login' => 'Last Login',
		);
	}
        
         public function initValues($idUsuario)
        {
             $browser_os = new UserAgent();
             $zonah = timezone_open('America/Lima');
             $timepais = date_create(date('h:i:s',time()),$zonah);             
             $this->iduser = $idUsuario;
             $this->fecha = date('Y-m-d',$timepais->getTimestamp());
             $this->hora = date('h:i:s',$timepais->getTimestamp());
             $this->browser = $browser_os->browser().' '.$browser_os->version();
             $this->sistema = $browser_os->os();
             $this->ip=$_SERVER['REMOTE_ADDR'];
             if(Cfubitacora::model()->exists("iduser = '".$idUsuario."'"))
             {
                 $lastLogin = Cfubitacora::model()->find("iduser = '".$idUsuario."' and last_login = (SELECT MAX(last_login) FROM cfubitacora where iduser ='".$idUsuario."')");
                 
                 $this->last_login = $lastLogin->fecha.' '.$lastLogin->hora;
                 //throw new exception('Fecha: '.$lastLogin->fecha.' '.$lastLogin->hora);
             }else
             {
                 $this->last_login = '0000-00-00 00:00:00';
                 //throw new exception();
             }
                  
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

		$criteria->compare('idBitacora',$this->idBitacora,true);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('browser',$this->browser,true);
		$criteria->compare('sistema',$this->sistema,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('last_login',$this->last_login,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}