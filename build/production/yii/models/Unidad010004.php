<?php

/**
 * This is the model class for table "unidad_01_00_04".
 *
 * The followings are the available columns in table 'unidad_01_00_04':
 * @property integer $id_unidad
 * @property string $nombre_unidad
 * @property string $codigo_unidad
 * @property string $descripcion_unidad
 *
 * The followings are the available model relations:
 
 * @property Activo020101[] $activo020101s
 * @property Ubicacion020104[] $ubicacion020104s
 * @property UsuarioUnidad000102[] $usuarioUnidad000102s
 */
class Unidad010004 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'unidad_01_00_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_unidad, codigo_unidad', 'required'),
			array('nombre_unidad', 'length', 'max'=>145),
			array('codigo_unidad', 'length', 'max'=>2),
			array('descripcion_unidad', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_unidad, nombre_unidad, codigo_unidad, descripcion_unidad', 'safe', 'on'=>'search'),
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
			'activo020101s' => array(self::HAS_MANY, 'Activo020101', 'fk_id_unidad'),
			'ubicacion020104s' => array(self::HAS_MANY, 'Ubicacion020104', 'fk_id_unidad'),
			'usuarioUnidad000102s' => array(self::HAS_MANY, 'UsuarioUnidad000102', 'fk_id_unidad'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_unidad' => 'Id Unidad',
			'nombre_unidad' => 'displayField',
			'codigo_unidad' => 'Codigo Unidad',
			'descripcion_unidad' => 'Descripcion Unidad',
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

		$criteria->compare('id_unidad',$this->id_unidad);
		$criteria->compare('nombre_unidad',$this->nombre_unidad,true);
		$criteria->compare('codigo_unidad',$this->codigo_unidad,true);
		$criteria->compare('descripcion_unidad',$this->descripcion_unidad,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Unidad010004 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_unidad';
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
				'Ubicacion020104',
				'UsuarioUnidad000102',
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
