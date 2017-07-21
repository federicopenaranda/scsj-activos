<?php

/**
 * This is the model class for table "activo_valor_02_01_03".
 *
 * The followings are the available columns in table 'activo_valor_02_01_03':
 * @property integer $id_activo_valor
 * @property integer $fk_id_activo
 * @property double $valor_activo_valor
 * @property integer $estado_activo_valor
 * @property string $fecha_valoracion_activo_valor
 *
 * The followings are the available model relations:
 
 * @property Activo020101 $fkIdActivo
 */
class ActivoValor020103 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_valor_02_01_03';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_activo, valor_activo_valor, estado_activo_valor, fecha_valoracion_activo_valor', 'required'),
			array('fk_id_activo, estado_activo_valor', 'numerical', 'integerOnly'=>true),
			array('valor_activo_valor', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_activo_valor, fk_id_activo, valor_activo_valor, estado_activo_valor, fecha_valoracion_activo_valor', 'safe', 'on'=>'search'),
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
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_activo_valor' => 'Id Activo Valor',
			'fk_id_activo' => 'Fk Id Activo',
			'valor_activo_valor' => 'Valor Activo Valor',
			'estado_activo_valor' => 'Estado Activo Valor',
			'fecha_valoracion_activo_valor' => 'Fecha Valoracion Activo Valor',
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

		$criteria->compare('id_activo_valor',$this->id_activo_valor);
		$criteria->compare('fk_id_activo',$this->fk_id_activo);
		$criteria->compare('valor_activo_valor',$this->valor_activo_valor);
		$criteria->compare('estado_activo_valor',$this->estado_activo_valor);
		$criteria->compare('fecha_valoracion_activo_valor',$this->fecha_valoracion_activo_valor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoValor020103 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_activo_valor';
	}

	public function getHasOne(){
		return array(
		);
	}

	public function getBelonsTo(){
		return array(
				'Activo020101',
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
