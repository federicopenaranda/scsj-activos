<?php

/**
 * This is the model class for table "ubicacion_02_01_04".
 *
 * The followings are the available columns in table 'ubicacion_02_01_04':
 * @property integer $id_ubicacion
 * @property integer $fk_id_unidad
 * @property string $nombre_ubicacion
 *
 * The followings are the available model relations:
 
 * @property ActivoUbicacion020103[] $activoUbicacion020103s
 * @property Unidad010004 $fkIdUnidad
 */
class Ubicacion020104 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ubicacion_02_01_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_unidad, nombre_ubicacion', 'required'),
			array('fk_id_unidad', 'numerical', 'integerOnly'=>true),
			array('nombre_ubicacion', 'length', 'max'=>145),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ubicacion, fk_id_unidad, nombre_ubicacion', 'safe', 'on'=>'search'),
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
			'activoUbicacion020103s' => array(self::HAS_MANY, 'ActivoUbicacion020103', 'fk_id_ubicacion'),
			'fkIdUnidad' => array(self::BELONGS_TO, 'Unidad010004', 'fk_id_unidad'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ubicacion' => 'Id Ubicacion',
			'fk_id_unidad' => 'Fk Id Unidad',
			'nombre_ubicacion' => 'displayField',
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

		$criteria->compare('id_ubicacion',$this->id_ubicacion);
		$criteria->compare('fk_id_unidad',$this->fk_id_unidad);
		$criteria->compare('nombre_ubicacion',$this->nombre_ubicacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ubicacion020104 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_ubicacion';
	}

	public function getHasOne(){
		return array(
		);
	}

	public function getBelonsTo(){
		return array(
				'Unidad010004',
		);
	}

	public function getHasMany(){
		return array(
				'ActivoUbicacion020103',
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
