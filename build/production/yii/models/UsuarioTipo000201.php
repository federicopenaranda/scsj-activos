<?php

/**
 * This is the model class for table "usuario_tipo_00_02_01".
 *
 * The followings are the available columns in table 'usuario_tipo_00_02_01':
 * @property integer $id_usuario_tipo
 * @property string $nombre_usuario_tipo
 * @property string $descripcion_usuario_tipo
 *
 * The followings are the available model relations:
 
 * @property UsuarioPrivilegio000004[] $usuarioPrivilegio000004s
 * @property Usuario000101[] $usuario000101s
 */
class UsuarioTipo000201 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_tipo_00_02_01';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_usuario_tipo', 'required'),
			array('nombre_usuario_tipo', 'length', 'max'=>145),
			array('descripcion_usuario_tipo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario_tipo, nombre_usuario_tipo, descripcion_usuario_tipo', 'safe', 'on'=>'search'),
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
			'usuarioPrivilegio000004s' => array(self::MANY_MANY, 'UsuarioPrivilegio000004', 'usuario_tipo_privilegio_00_02_02(fk_id_usuario_tipo, fk_id_usuario_privilegio)'),
			'usuario000101s' => array(self::MANY_MANY, 'Usuario000101', 'usuario_tipo_usuario_00_01_02(fk_id_usuario_tipo, fk_id_usuario)'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario_tipo' => 'usuario',
			'nombre_usuario_tipo' => 'displayField',
			'descripcion_usuario_tipo' => 'Descripcion Usuario Tipo',
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

		$criteria->compare('id_usuario_tipo',$this->id_usuario_tipo);
		$criteria->compare('nombre_usuario_tipo',$this->nombre_usuario_tipo,true);
		$criteria->compare('descripcion_usuario_tipo',$this->descripcion_usuario_tipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioTipo000201 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_usuario_tipo';
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
				'UsuarioPrivilegio000004',
				'Usuario000101',
		);
	}
}
