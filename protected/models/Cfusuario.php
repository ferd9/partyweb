<?php

/**
 * This is the model class for table "cfusuario".
 *
 * The followings are the available columns in table 'cfusuario':
 * @property integer $iduser
 * @property string $identify
 * @property string $login
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $verificado
 *
 * The followings are the available model relations:
 * @property Cfperfil $cfperfil
 */
class Cfusuario extends CActiveRecordUser
{
    	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cfusuario the static model class
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
		return 'cfusuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('login, email','unique'),
                        array('email','email'),
			array('password, salt, email, verifyPass', 'required'),
			array('identify', 'length', 'max'=>15),
			array('login, email', 'length', 'max'=>200),
			array('password, salt', 'length', 'max'=>128),
			array('verificado', 'length', 'max'=>1),
                        array("verifyPass", "compare", "compareAttribute" => "password"),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('identify, login, email', 'safe', 'on'=>'search'),
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
			'cfperfil' => array(self::HAS_ONE, 'Cfperfil', 'idPerfil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iduser' => 'Iduser',
			'identify' => 'Identify',
			'login' => 'Login',
			'password' => 'Password',
                        'verifyPass'=>'Repita el password',
                        'salt'=>'codigo generado',
			'email' => 'Email',
			'verificado' => 'Verificado',                        
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

		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('identify',$this->identify,true);                
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('verificado',$this->verificado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
       
        
        public function encryptPassword()
        {
            if($this->password === $this->verifyPass)
            {
                $this->salt = uniqid(strrev($this->login));
                $pscode = md5($this->salt.$this->password);
                $this->password = $pscode;
                $this->verifyPass = $pscode;
            }
           
        }
        
        public function verifyPassword($pass)
        {
            return md5($this->salt.$pass)==$this->password;
        }
}