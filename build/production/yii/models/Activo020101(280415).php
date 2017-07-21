<?php

/**
 * This is the model class for table "activo_02_01_01".
 *
 * The followings are the available columns in table 'activo_02_01_01':
 * @property integer $id_activo
 * @property integer $fk_id_proveedor
 * @property integer $fk_id_activo_clasificacion
 * @property integer $fk_id_activo_utilitario
 * @property integer $fk_id_unidad
 * @property integer $fk_id_area
 * @property integer $fk_id_departamento
 * @property string $codigo_activo
 * @property string $descripcion_activo
 * @property double $piezas_activo
 * @property string $fecha_adquisicion_activo
 * @property string $fecha_baja_activo
 * @property double $precio_adquisicion_activo
 * @property integer $garantia_meses_activo
 * @property string $archivo_foto_activo
 * @property string $fecha_creacion_activo
 *
 * The followings are the available model relations:
 
 * @property ActivoUtilitario020104 $fkIdActivoUtilitario
 * @property Area010004 $fkIdArea
 * @property Departamento010004 $fkIdDepartamento
 * @property Unidad010004 $fkIdUnidad
 * @property ActivoClasificacion020104 $fkIdActivoClasificacion
 * @property ActivoProveedor020104 $fkIdProveedor
 * @property ActivoEntrega020103[] $activoEntrega020103s
 * @property ActivoRevision020205[] $activoRevision020205s
 * @property ActivoUbicacion020103[] $activoUbicacion020103s
 * @property ActivoValor020103[] $activoValor020103s
 */
class Activo020101 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_02_01_01';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_proveedor, fk_id_activo_clasificacion, fk_id_activo_utilitario, fk_id_unidad, fk_id_area, fk_id_departamento, codigo_activo, descripcion_activo, fecha_adquisicion_activo, precio_adquisicion_activo', 'required'),
			array('fk_id_proveedor, fk_id_activo_clasificacion, fk_id_activo_utilitario, fk_id_unidad, fk_id_area, fk_id_departamento, garantia_meses_activo', 'numerical', 'integerOnly'=>true),
			array('piezas_activo, precio_adquisicion_activo', 'numerical'),
			array('codigo_activo', 'length', 'max'=>145),
			array('archivo_foto_activo', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_activo, fk_id_proveedor, fk_id_activo_clasificacion, fk_id_activo_utilitario, fk_id_unidad, fk_id_area, fk_id_departamento, codigo_activo, descripcion_activo, piezas_activo, fecha_adquisicion_activo, fecha_baja_activo, precio_adquisicion_activo, garantia_meses_activo, archivo_foto_activo, fecha_creacion_activo', 'safe', 'on'=>'search'),
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
			'fkIdActivoUtilitario' => array(self::BELONGS_TO, 'ActivoUtilitario020104', 'fk_id_activo_utilitario'),
			'fkIdArea' => array(self::BELONGS_TO, 'Area010004', 'fk_id_area'),
			'fkIdDepartamento' => array(self::BELONGS_TO, 'Departamento010004', 'fk_id_departamento'),
			'fkIdUnidad' => array(self::BELONGS_TO, 'Unidad010004', 'fk_id_unidad'),
			'fkIdActivoClasificacion' => array(self::BELONGS_TO, 'ActivoClasificacion020104', 'fk_id_activo_clasificacion'),
			'fkIdProveedor' => array(self::BELONGS_TO, 'ActivoProveedor020104', 'fk_id_proveedor'),
			'activoEntrega020103s' => array(self::HAS_MANY, 'ActivoEntrega020103', 'fk_id_activo'),
			'activoRevision020205s' => array(self::HAS_MANY, 'ActivoRevision020205', 'fk_id_activo'),
			'activoUbicacion020103s' => array(self::HAS_MANY, 'ActivoUbicacion020103', 'fk_id_activo'),
			'activoValor020103s' => array(self::HAS_MANY, 'ActivoValor020103', 'fk_id_activo'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
			'activoEstado'=>array(self::HAS_MANY, 'ActivoRevision020205', array('fk_id_activo_esatado'=>'id_activo_estado'), 'through'=>'activoRevision020205s'),
			'activoUbicacions'=> array(self::HAS_MANY, 'ActivoUbicacion020103', 'fk_id_activo'),
			
			'activoRevisions'=>array(self::HAS_MANY, 'Revision020204', array('fk_id_revision'=>'id_revision'), 'through'=>'activoRevision020205s'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_activo' => 'activo',
			'fk_id_proveedor' => 'Fk Id Proveedor',
			'fk_id_activo_clasificacion' => 'Fk Id Activo Clasificacion',
			'fk_id_activo_utilitario' => 'Fk Id Activo Utilitario',
			'fk_id_unidad' => 'Fk Id Unidad',
			'fk_id_area' => 'Fk Id Area',
			'fk_id_departamento' => 'Fk Id Departamento',
			'codigo_activo' => 'Codigo Activo',
			'descripcion_activo' => 'Descripcion Activo',
			'piezas_activo' => 'Piezas Activo',
			'fecha_adquisicion_activo' => 'Fecha Adquisicion Activo',
			'fecha_baja_activo' => 'Fecha Baja Activo',
			'precio_adquisicion_activo' => 'Precio Adquisicion Activo',
			'garantia_meses_activo' => 'Garantia Meses Activo',
			'archivo_foto_activo' => 'Archivo Foto Activo',
			'fecha_creacion_activo' => 'Fecha Creacion Activo',
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

		$criteria->compare('id_activo',$this->id_activo);
		$criteria->compare('fk_id_proveedor',$this->fk_id_proveedor);
		$criteria->compare('fk_id_activo_clasificacion',$this->fk_id_activo_clasificacion);
		$criteria->compare('fk_id_activo_utilitario',$this->fk_id_activo_utilitario);
		$criteria->compare('fk_id_unidad',$this->fk_id_unidad);
		$criteria->compare('fk_id_area',$this->fk_id_area);
		$criteria->compare('fk_id_departamento',$this->fk_id_departamento);
		$criteria->compare('codigo_activo',$this->codigo_activo,true);
		$criteria->compare('descripcion_activo',$this->descripcion_activo,true);
		$criteria->compare('piezas_activo',$this->piezas_activo);
		$criteria->compare('fecha_adquisicion_activo',$this->fecha_adquisicion_activo,true);
		$criteria->compare('fecha_baja_activo',$this->fecha_baja_activo,true);
		$criteria->compare('precio_adquisicion_activo',$this->precio_adquisicion_activo);
		$criteria->compare('garantia_meses_activo',$this->garantia_meses_activo);
		$criteria->compare('archivo_foto_activo',$this->archivo_foto_activo,true);
		$criteria->compare('fecha_creacion_activo',$this->fecha_creacion_activo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Activo020101 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_activo';
	}

	public function getHasOne(){
		return array(
		);
	}

	public function getBelonsTo(){
		return array(
				'ActivoUtilitario020104',
				'Area010004',
				'Departamento010004',
				'Unidad010004',
				'ActivoClasificacion020104',
				'ActivoProveedor020104',
		);
	}

	public function getHasMany(){
		return array(
				'ActivoEntrega020103',
				'ActivoRevision020205',
				'ActivoUbicacion020103',
				'ActivoValor020103',
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
