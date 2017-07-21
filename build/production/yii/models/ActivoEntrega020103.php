<?php

/**
 * This is the model class for table "activo_entrega_02_01_03".
 *
 * The followings are the available columns in table 'activo_entrega_02_01_03':
 * @property integer $id_activo_entrega
 * @property integer $fk_id_activo
 * @property integer $fk_id_usuario_recibio
 * @property integer $fk_id_usuario_entrego
 * @property string $fecha_activo_entrega
 * @property integer $estado_activo_entrega
 *
 * The followings are the available model relations:
 
 * @property Activo020101 $fkIdActivo
 * @property Usuario000101 $fkIdUsuarioEntrego
 * @property Usuario000101 $fkIdUsuarioRecibio
 */
class ActivoEntrega020103 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_entrega_02_01_03';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_activo, fk_id_usuario_recibio, fk_id_usuario_entrego, fecha_activo_entrega, estado_activo_entrega', 'required'),
			array('fk_id_activo, fk_id_usuario_recibio, fk_id_usuario_entrego, estado_activo_entrega', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_activo_entrega, fk_id_activo, fk_id_usuario_recibio, fk_id_usuario_entrego, fecha_activo_entrega, estado_activo_entrega', 'safe', 'on'=>'search'),
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
			'fkIdUsuarioEntrego' => array(self::BELONGS_TO, 'Usuario000101', 'fk_id_usuario_entrego'),
			'fkIdUsuarioRecibio' => array(self::BELONGS_TO, 'Usuario000101', 'fk_id_usuario_recibio'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_activo_entrega' => 'Id Activo Entrega',
			'fk_id_activo' => 'Fk Id Activo',
			'fk_id_usuario_recibio' => 'ID del usuario que recibió el material.',
			'fk_id_usuario_entrego' => 'ID del usuario que entregó el material.',
			'fecha_activo_entrega' => 'Fecha Activo Entrega',
			'estado_activo_entrega' => 'Estado Activo Entrega',
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

		$criteria->compare('id_activo_entrega',$this->id_activo_entrega);
		$criteria->compare('fk_id_activo',$this->fk_id_activo);
		$criteria->compare('fk_id_usuario_recibio',$this->fk_id_usuario_recibio);
		$criteria->compare('fk_id_usuario_entrego',$this->fk_id_usuario_entrego);
		$criteria->compare('fecha_activo_entrega',$this->fecha_activo_entrega,true);
		$criteria->compare('estado_activo_entrega',$this->estado_activo_entrega);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoEntrega020103 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_activo_entrega';
	}

	public function getHasOne(){
		return array(
		);
	}

	public function getBelonsTo(){
		return array(
				'Activo020101',
				'Usuario000101',
				'Usuario000101',
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
