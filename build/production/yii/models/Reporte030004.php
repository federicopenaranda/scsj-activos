<?php

/**
 * This is the model class for table "reporte_03_00_04".
 *
 * The followings are the available columns in table 'reporte_03_00_04':
 * @property integer $id_reporte
 * @property string $codigo_reporte
 * @property string $nombre_reporte
 * @property string $descripcion_reporte
 * @property integer $estado_reporte
 * @property string $ruta_reporte
 * @property string $tipo_reporte
 */
class Reporte030004 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reporte_03_00_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo_reporte, nombre_reporte, estado_reporte, ruta_reporte, tipo_reporte', 'required'),
			array('estado_reporte', 'numerical', 'integerOnly'=>true),
			array('codigo_reporte', 'length', 'max'=>45),
			array('nombre_reporte, ruta_reporte', 'length', 'max'=>145),
			array('descripcion_reporte', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_reporte, codigo_reporte, nombre_reporte, descripcion_reporte, estado_reporte, ruta_reporte, tipo_reporte', 'safe', 'on'=>'search'),
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
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_reporte' => 'Id Reporte',
			'codigo_reporte' => 'Codigo Reporte',
			'nombre_reporte' => 'Nombre Reporte',
			'descripcion_reporte' => 'Descripcion Reporte',
			'estado_reporte' => 'Estado Reporte',
			'ruta_reporte' => 'Ruta Reporte',
			'tipo_reporte' => 'Tipo Reporte',
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

		$criteria->compare('id_reporte',$this->id_reporte);
		$criteria->compare('codigo_reporte',$this->codigo_reporte,true);
		$criteria->compare('nombre_reporte',$this->nombre_reporte,true);
		$criteria->compare('descripcion_reporte',$this->descripcion_reporte,true);
		$criteria->compare('estado_reporte',$this->estado_reporte);
		$criteria->compare('ruta_reporte',$this->ruta_reporte,true);
		$criteria->compare('tipo_reporte',$this->tipo_reporte,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reporte030004 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_reporte';
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
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
