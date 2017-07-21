<?php

/**
 * This is the model class for table "log_sistema_03_00_03".
 *
 * The followings are the available columns in table 'log_sistema_03_00_03':
 * @property integer $id_log_sistema
 * @property integer $fk_id_usuario
 * @property string $fecha_hora_log_sistema
 * @property string $accion_log_sistema
 * @property string $tabla_log_sistema
 * @property integer $id_registro_log_sistema
 *
 * The followings are the available model relations:
 
 * @property Usuario000101 $fkIdUsuario
 */
class LogSistema030003 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_sistema_03_00_03';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_hora_log_sistema, accion_log_sistema, tabla_log_sistema, id_registro_log_sistema', 'required'),
			array('fk_id_usuario, id_registro_log_sistema', 'numerical', 'integerOnly'=>true),
			array('accion_log_sistema, tabla_log_sistema', 'length', 'max'=>145),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_log_sistema, fk_id_usuario, fecha_hora_log_sistema, accion_log_sistema, tabla_log_sistema, id_registro_log_sistema', 'safe', 'on'=>'search'),
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
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario000101', 'fk_id_usuario'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_log_sistema' => 'Id Log Sistema',
			'fk_id_usuario' => 'Fk Id Usuario',
			'fecha_hora_log_sistema' => 'Fecha Hora Log Sistema',
			'accion_log_sistema' => 'Accion Log Sistema',
			'tabla_log_sistema' => 'Tabla Log Sistema',
			'id_registro_log_sistema' => 'Id Registro Log Sistema',
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

		$criteria->compare('id_log_sistema',$this->id_log_sistema);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('fecha_hora_log_sistema',$this->fecha_hora_log_sistema,true);
		$criteria->compare('accion_log_sistema',$this->accion_log_sistema,true);
		$criteria->compare('tabla_log_sistema',$this->tabla_log_sistema,true);
		$criteria->compare('id_registro_log_sistema',$this->id_registro_log_sistema);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogSistema030003 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_log_sistema';
	}

	public function getHasOne(){
		return array(
		);
	}

	public function getBelonsTo(){
		return array(
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
