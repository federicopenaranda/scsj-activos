<?php

/**
 * This is the model class for table "activo_proveedor_02_01_04".
 *
 * The followings are the available columns in table 'activo_proveedor_02_01_04':
 * @property integer $id_activo_proveedor
 * @property string $nombre_activo_proveedor
 * @property string $nit_activo_proveedor
 * @property string $direccion_activo_proveedor
 * @property string $observaciones_activo_proveedor
 * @property string $telefono1_activo_proveedor
 * @property string $telefono2_activo_proveedor
 *
 * The followings are the available model relations:
 
 * @property Activo020101[] $activo020101s
 */
class ActivoProveedor020104 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_proveedor_02_01_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_activo_proveedor', 'required'),
			array('nombre_activo_proveedor', 'length', 'max'=>145),
			array('nit_activo_proveedor, telefono1_activo_proveedor, telefono2_activo_proveedor', 'length', 'max'=>45),
			array('direccion_activo_proveedor, observaciones_activo_proveedor', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_activo_proveedor, nombre_activo_proveedor, nit_activo_proveedor, direccion_activo_proveedor, observaciones_activo_proveedor, telefono1_activo_proveedor, telefono2_activo_proveedor', 'safe', 'on'=>'search'),
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
			'activo020101s' => array(self::HAS_MANY, 'Activo020101', 'fk_id_proveedor'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_activo_proveedor' => 'Id Activo Proveedor',
			'nombre_activo_proveedor' => 'displayField',
			'nit_activo_proveedor' => 'Nit Activo Proveedor',
			'direccion_activo_proveedor' => 'Direccion Activo Proveedor',
			'observaciones_activo_proveedor' => 'Observaciones Activo Proveedor',
			'telefono1_activo_proveedor' => 'Telefono1 Activo Proveedor',
			'telefono2_activo_proveedor' => 'Telefono2 Activo Proveedor',
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

		$criteria->compare('id_activo_proveedor',$this->id_activo_proveedor);
		$criteria->compare('nombre_activo_proveedor',$this->nombre_activo_proveedor,true);
		$criteria->compare('nit_activo_proveedor',$this->nit_activo_proveedor,true);
		$criteria->compare('direccion_activo_proveedor',$this->direccion_activo_proveedor,true);
		$criteria->compare('observaciones_activo_proveedor',$this->observaciones_activo_proveedor,true);
		$criteria->compare('telefono1_activo_proveedor',$this->telefono1_activo_proveedor,true);
		$criteria->compare('telefono2_activo_proveedor',$this->telefono2_activo_proveedor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoProveedor020104 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_activo_proveedor';
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
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
