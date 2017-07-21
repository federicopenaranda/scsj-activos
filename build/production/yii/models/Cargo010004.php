<?php

/**
 * This is the model class for table "cargo_01_00_04".
 *
 * The followings are the available columns in table 'cargo_01_00_04':
 * @property integer $id_cargo
 * @property string $nombre_cargo
 * @property string $descripcion_cargo
 *
 * The followings are the available model relations:
 
 * @property Usuario000101[] $usuario000101s
 */
class Cargo010004 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cargo_01_00_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_cargo', 'required'),
			array('nombre_cargo', 'length', 'max'=>145),
			array('descripcion_cargo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cargo, nombre_cargo, descripcion_cargo', 'safe', 'on'=>'search'),
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
			'usuario000101s' => array(self::HAS_MANY, 'Usuario000101', 'fk_id_cargo'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cargo' => 'cargo',
			'nombre_cargo' => 'displayField',
			'descripcion_cargo' => 'Descripcion Cargo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_cargo',$this->id_cargo);
		$criteria->compare('nombre_cargo',$this->nombre_cargo,true);
		$criteria->compare('descripcion_cargo',$this->descripcion_cargo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cargo010004 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_cargo';
	}

	public function getHasOne(){
		return array(
		);
	}

	public function getBelonsTo(){
		return array(
		);
	}

	public function getHasMany(){
		return array(
				'Usuario000101',
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
