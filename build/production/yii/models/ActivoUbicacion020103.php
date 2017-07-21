<?php

/**
 * This is the model class for table "activo_ubicacion_02_01_03".
 *
 * The followings are the available columns in table 'activo_ubicacion_02_01_03':
 * @property integer $id_activo_ubicacion
 * @property integer $fk_id_ubicacion
 * @property integer $fk_id_activo
 * @property integer $estado_activo_ubicacion
 *
 * The followings are the available model relations:
 
 * @property Activo020101 $fkIdActivo
 * @property Ubicacion020104 $fkIdUbicacion
 */
class ActivoUbicacion020103 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_ubicacion_02_01_03';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_ubicacion, fk_id_activo, estado_activo_ubicacion', 'required'),
			array('fk_id_ubicacion, fk_id_activo, estado_activo_ubicacion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_activo_ubicacion, fk_id_ubicacion, fk_id_activo, estado_activo_ubicacion', 'safe', 'on'=>'search'),
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
			'fkIdActivo' => array(self::BELONGS_TO, 'Activo020101', 'fk_id_activo'),
			'fkIdUbicacion' => array(self::BELONGS_TO, 'Ubicacion020104', 'fk_id_ubicacion'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_activo_ubicacion' => 'Id Activo Ubicacion',
			'fk_id_ubicacion' => 'Fk Id Ubicacion',
			'fk_id_activo' => 'Fk Id Activo',
			'estado_activo_ubicacion' => 'Estado Activo Ubicacion',
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

		$criteria->compare('id_activo_ubicacion',$this->id_activo_ubicacion);
		$criteria->compare('fk_id_ubicacion',$this->fk_id_ubicacion);
		$criteria->compare('fk_id_activo',$this->fk_id_activo);
		$criteria->compare('estado_activo_ubicacion',$this->estado_activo_ubicacion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoUbicacion020103 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_activo_ubicacion';
	}

	public function getHasOne(){
		return array(
		);
	}

	public function getBelonsTo(){
		return array(
				'Activo020101',
				'Ubicacion020104',
		);
	}

	public function getHasMany(){
		return array(
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
