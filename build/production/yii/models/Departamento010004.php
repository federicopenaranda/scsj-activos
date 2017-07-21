<?php

/**
 * This is the model class for table "departamento_01_00_04".
 *
 * The followings are the available columns in table 'departamento_01_00_04':
 * @property integer $id_departamento
 * @property string $nombre_departamento
 * @property string $codigo_departamento
 * @property string $descripcion_departamento
 *
 * The followings are the available model relations:
 
 * @property Activo020101[] $activo020101s
 * @property Usuario000101[] $usuario000101s
 */
class Departamento010004 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'departamento_01_00_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_departamento, codigo_departamento', 'required'),
			array('nombre_departamento', 'length', 'max'=>145),
			array('codigo_departamento', 'length', 'max'=>2),
			array('descripcion_departamento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_departamento, nombre_departamento, codigo_departamento, descripcion_departamento', 'safe', 'on'=>'search'),
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
			'activo020101s' => array(self::HAS_MANY, 'Activo020101', 'fk_id_departamento'),
			'usuario000101s' => array(self::HAS_MANY, 'Usuario000101', 'fk_id_departamento'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_departamento' => 'Id Departamento',
			'nombre_departamento' => 'displayField',
			'codigo_departamento' => 'Codigo Departamento',
			'descripcion_departamento' => 'Descripcion Departamento',
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

		$criteria->compare('id_departamento',$this->id_departamento);
		$criteria->compare('nombre_departamento',$this->nombre_departamento,true);
		$criteria->compare('codigo_departamento',$this->codigo_departamento,true);
		$criteria->compare('descripcion_departamento',$this->descripcion_departamento,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Departamento010004 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_departamento';
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
