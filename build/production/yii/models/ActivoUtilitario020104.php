<?php

/**
 * This is the model class for table "activo_utilitario_02_01_04".
 *
 * The followings are the available columns in table 'activo_utilitario_02_01_04':
 * @property integer $id_activo_utilitario
 * @property integer $fk_id_activo_clasificacion
 * @property string $nombre_activo_utilitario
 * @property string $codigo_activo_utilitario
 *
 * The followings are the available model relations:
 
 * @property Activo020101[] $activo020101s
 * @property ActivoClasificacion020104 $fkIdActivoClasificacion
 */
class ActivoUtilitario020104 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_utilitario_02_01_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_activo_clasificacion, nombre_activo_utilitario, codigo_activo_utilitario', 'required'),
			array('fk_id_activo_clasificacion', 'numerical', 'integerOnly'=>true),
			array('nombre_activo_utilitario', 'length', 'max'=>145),
			array('codigo_activo_utilitario', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_activo_utilitario, fk_id_activo_clasificacion, nombre_activo_utilitario, codigo_activo_utilitario', 'safe', 'on'=>'search'),
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
			'activo020101s' => array(self::HAS_MANY, 'Activo020101', 'fk_id_activo_utilitario'),
			'fkIdActivoClasificacion' => array(self::BELONGS_TO, 'ActivoClasificacion020104', 'fk_id_activo_clasificacion'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_activo_utilitario' => 'Id Activo Utilitario',
			'fk_id_activo_clasificacion' => 'Fk Id Activo Clasificacion',
			'nombre_activo_utilitario' => 'displayField',
			'codigo_activo_utilitario' => 'Codigo Activo Utilitario',
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

		$criteria->compare('id_activo_utilitario',$this->id_activo_utilitario);
		$criteria->compare('fk_id_activo_clasificacion',$this->fk_id_activo_clasificacion);
		$criteria->compare('nombre_activo_utilitario',$this->nombre_activo_utilitario,true);
		$criteria->compare('codigo_activo_utilitario',$this->codigo_activo_utilitario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoUtilitario020104 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_activo_utilitario';
	}

	public function getHasOne(){
		return array(
		);
	}

	public function getBelonsTo(){
		return array(
				'ActivoClasificacion020104',
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
