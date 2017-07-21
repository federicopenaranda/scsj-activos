<?php

/**
 * This is the model class for table "activo_clasificacion_02_01_04".
 *
 * The followings are the available columns in table 'activo_clasificacion_02_01_04':
 * @property integer $id_activo_clasificacion
 * @property string $nombre_activo_clasificacion
 * @property string $descripcion_activo_clasificacion
 * @property double $coeficiente_depreciacion_activo_clasificacion
 * @property integer $anos_vida_util_activo_clasificacion
 * @property string $codigo_activo_clasificacion
 *
 * The followings are the available model relations:
 
 * @property Activo020101[] $activo020101s
 * @property ActivoUtilitario020104[] $activoUtilitario020104s
 */
class ActivoClasificacion020104 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_clasificacion_02_01_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_activo_clasificacion, coeficiente_depreciacion_activo_clasificacion, anos_vida_util_activo_clasificacion, codigo_activo_clasificacion', 'required'),
			array('anos_vida_util_activo_clasificacion', 'numerical', 'integerOnly'=>true),
			array('coeficiente_depreciacion_activo_clasificacion', 'numerical'),
			array('nombre_activo_clasificacion', 'length', 'max'=>145),
			array('codigo_activo_clasificacion', 'length', 'max'=>2),
			array('descripcion_activo_clasificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_activo_clasificacion, nombre_activo_clasificacion, descripcion_activo_clasificacion, coeficiente_depreciacion_activo_clasificacion, anos_vida_util_activo_clasificacion, codigo_activo_clasificacion', 'safe', 'on'=>'search'),
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
			'activo020101s' => array(self::HAS_MANY, 'Activo020101', 'fk_id_activo_clasificacion'),
			'activoUtilitario020104s' => array(self::HAS_MANY, 'ActivoUtilitario020104', 'fk_id_activo_clasificacion'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_activo_clasificacion' => 'Id Activo Clasificacion',
			'nombre_activo_clasificacion' => 'displayField',
			'descripcion_activo_clasificacion' => 'Descripcion Activo Clasificacion',
			'coeficiente_depreciacion_activo_clasificacion' => 'Coeficiente Depreciacion Activo Clasificacion',
			'anos_vida_util_activo_clasificacion' => 'Anos Vida Util Activo Clasificacion',
			'codigo_activo_clasificacion' => 'Codigo Activo Clasificacion',
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

		$criteria->compare('id_activo_clasificacion',$this->id_activo_clasificacion);
		$criteria->compare('nombre_activo_clasificacion',$this->nombre_activo_clasificacion,true);
		$criteria->compare('descripcion_activo_clasificacion',$this->descripcion_activo_clasificacion,true);
		$criteria->compare('coeficiente_depreciacion_activo_clasificacion',$this->coeficiente_depreciacion_activo_clasificacion);
		$criteria->compare('anos_vida_util_activo_clasificacion',$this->anos_vida_util_activo_clasificacion);
		$criteria->compare('codigo_activo_clasificacion',$this->codigo_activo_clasificacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoClasificacion020104 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_activo_clasificacion';
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
				'ActivoUtilitario020104',
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
