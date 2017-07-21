<?php

/**
 * This is the model class for table "usuario_privilegio_00_00_04".
 *
 * The followings are the available columns in table 'usuario_privilegio_00_00_04':
 * @property integer $id_usuario_privilegio
 * @property string $nombre_privilegio_usuario_privilegio
 * @property string $accion_usuario_privilegio
 * @property string $opciones_usuario_privilegio
 * @property string $funcion_usuario_privilegio
 * @property string $descripcion_usuario_privilegio
 *
 * The followings are the available model relations:
 
 * @property UsuarioTipo000201[] $usuarioTipo000201s
 */
class UsuarioPrivilegio000004 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_privilegio_00_00_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_privilegio_usuario_privilegio, accion_usuario_privilegio', 'required'),
			array('nombre_privilegio_usuario_privilegio, accion_usuario_privilegio, opciones_usuario_privilegio, funcion_usuario_privilegio, descripcion_usuario_privilegio', 'length', 'max'=>145),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario_privilegio, nombre_privilegio_usuario_privilegio, accion_usuario_privilegio, opciones_usuario_privilegio, funcion_usuario_privilegio, descripcion_usuario_privilegio', 'safe', 'on'=>'search'),
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
			'usuarioTipo000201s' => array(self::MANY_MANY, 'UsuarioTipo000201', 'usuario_tipo_privilegio_00_02_02(fk_id_usuario_privilegio, fk_id_usuario_tipo)'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario_privilegio' => 'Id Usuario Privilegio',
			'nombre_privilegio_usuario_privilegio' => 'displayField',
			'accion_usuario_privilegio' => 'Accion Usuario Privilegio',
			'opciones_usuario_privilegio' => 'Opciones Usuario Privilegio',
			'funcion_usuario_privilegio' => 'Funcion Usuario Privilegio',
			'descripcion_usuario_privilegio' => 'Descripcion Usuario Privilegio',
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

		$criteria->compare('id_usuario_privilegio',$this->id_usuario_privilegio);
		$criteria->compare('nombre_privilegio_usuario_privilegio',$this->nombre_privilegio_usuario_privilegio,true);
		$criteria->compare('accion_usuario_privilegio',$this->accion_usuario_privilegio,true);
		$criteria->compare('opciones_usuario_privilegio',$this->opciones_usuario_privilegio,true);
		$criteria->compare('funcion_usuario_privilegio',$this->funcion_usuario_privilegio,true);
		$criteria->compare('descripcion_usuario_privilegio',$this->descripcion_usuario_privilegio,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioPrivilegio000004 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_usuario_privilegio';
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
				'UsuarioTipo000201',
		);
	}
}
