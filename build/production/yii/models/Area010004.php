<?php

/**
 * This is the model class for table "area_01_00_04".
 *
 * The followings are the available columns in table 'area_01_00_04':
 * @property integer $id_area
 * @property string $nombre_area
 * @property string $codigo_area
 * @property string $descripcion_area
 *
 * The followings are the available model relations:
 
 * @property Activo020101[] $activo020101s
 * @property Usuario000101[] $usuario000101s
 */
class Area010004 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'area_01_00_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_area, codigo_area', 'required'),
			array('nombre_area', 'length', 'max'=>145),
			array('codigo_area', 'length', 'max'=>2),
			array('descripcion_area', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_area, nombre_area, codigo_area, descripcion_area', 'safe', 'on'=>'search'),
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
			'activo020101s' => array(self::HAS_MANY, 'Activo020101', 'fk_id_area'),
			'usuario000101s' => array(self::HAS_MANY, 'Usuario000101', 'fk_id_area'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_area' => 'Id Area',
			'nombre_area' => 'displayField',
			'codigo_area' => 'Codigo Area',
			'descripcion_area' => 'Descripcion Area',
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

		$criteria->compare('id_area',$this->id_area);
		$criteria->compare('nombre_area',$this->nombre_area,true);
		$criteria->compare('codigo_area',$this->codigo_area,true);
		$criteria->compare('descripcion_area',$this->descripcion_area,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Area010004 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_area';
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
				'Activo020101',
				'Usuario000101',
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
