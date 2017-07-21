<?php

/**
 * This is the model class for table "activo_estado_02_02_04".
 *
 * The followings are the available columns in table 'activo_estado_02_02_04':
 * @property integer $id_activo_estado
 * @property string $nombre_activo_estado
 * @property string $descripcion_activo_estado
 *
 * The followings are the available model relations:
 
 * @property ActivoRevision020205[] $activoRevision020205s
 */
class ActivoEstado020204 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_estado_02_02_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_activo_estado', 'required'),
			array('nombre_activo_estado', 'length', 'max'=>145),
			array('descripcion_activo_estado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_activo_estado, nombre_activo_estado, descripcion_activo_estado', 'safe', 'on'=>'search'),
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
			'activoRevision020205s' => array(self::HAS_MANY, 'ActivoRevision020205', 'fk_id_activo_estado'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_activo_estado' => 'Id Activo Estado',
			'nombre_activo_estado' => 'displayField',
			'descripcion_activo_estado' => 'Descripcion Activo Estado',
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

		$criteria->compare('id_activo_estado',$this->id_activo_estado);
		$criteria->compare('nombre_activo_estado',$this->nombre_activo_estado,true);
		$criteria->compare('descripcion_activo_estado',$this->descripcion_activo_estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoEstado020204 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_activo_estado';
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
				'ActivoRevision020205',
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
