<?php

/**
 * This is the model class for table "usuario_00_01_01".
 *
 * The followings are the available columns in table 'usuario_00_01_01':
 * @property integer $id_usuario
 * @property integer $fk_id_area
 * @property integer $fk_id_departamento
 * @property integer $fk_id_cargo
 * @property string $primer_nombre_usuario
 * @property string $segundo_nombre_usuario
 * @property string $apellido_paterno_usuario
 * @property string $apellido_materno_usuario
 * @property string $login_usuario
 * @property string $contrasena_usuario
 * @property string $sexo_usuario
 * @property string $telefono_usuario
 * @property string $celular_usuario
 * @property string $correo_usuario
 * @property string $direccion_usuario
 * @property string $imagen_usuario
 * @property string $observaciones_usuario
 * @property string $fecha_creacion_usuario
 *
 * The followings are the available model relations:
 * @property ActivoEntrega020103[] $activoEntrega020103s
 * @property ActivoEntrega020103[] $activoEntrega020103s1
 * @property ActivoRevision020205[] $activoRevision020205s
 * @property LogSistema030003[] $logSistema030003s
 * @property Area010004 $fkIdArea
 * @property Cargo010004 $fkIdCargo
 * @property Departamento010004 $fkIdDepartamento
 * @property UsuarioTipo000201[] $usuarioTipo000201s
 * @property UsuarioUnidad000102[] $usuarioUnidad000102s
 */
class Usuario000101 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_00_01_01';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('primer_nombre_usuario, apellido_paterno_usuario, login_usuario, contrasena_usuario, sexo_usuario', 'required'),
			array('fk_id_area, fk_id_departamento, fk_id_cargo', 'numerical', 'integerOnly'=>true),
			array('primer_nombre_usuario, segundo_nombre_usuario, apellido_paterno_usuario, apellido_materno_usuario, login_usuario, contrasena_usuario, telefono_usuario, celular_usuario, correo_usuario, direccion_usuario, observaciones_usuario', 'length', 'max'=>45),
			array('imagen_usuario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, fk_id_area, fk_id_departamento, fk_id_cargo, primer_nombre_usuario, segundo_nombre_usuario, apellido_paterno_usuario, apellido_materno_usuario, login_usuario, contrasena_usuario, sexo_usuario, telefono_usuario, celular_usuario, correo_usuario, direccion_usuario, imagen_usuario, observaciones_usuario, fecha_creacion_usuario', 'safe', 'on'=>'search'),
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
			'activoEntrega020103s' => array(self::HAS_MANY, 'ActivoEntrega020103', 'fk_id_usuario_entrego'),
			'activoEntrega020103s1' => array(self::HAS_MANY, 'ActivoEntrega020103', 'fk_id_usuario_recibio'),
			'activoRevision020205s' => array(self::HAS_MANY, 'ActivoRevision020205', 'fk_id_usuario'),
			'logSistema030003s' => array(self::HAS_MANY, 'LogSistema030003', 'fk_id_usuario'),
			'fkIdArea' => array(self::BELONGS_TO, 'Area010004', 'fk_id_area'),
			'fkIdCargo' => array(self::BELONGS_TO, 'Cargo010004', 'fk_id_cargo'),
			'fkIdDepartamento' => array(self::BELONGS_TO, 'Departamento010004', 'fk_id_departamento'),
			'usuarioTipo000201s' => array(self::MANY_MANY, 'UsuarioTipo000201', 'usuario_tipo_usuario_00_01_02(fk_id_usuario, fk_id_usuario_tipo)'),
			'usuarioUnidad000102s' => array(self::HAS_MANY, 'UsuarioUnidad000102', 'fk_id_usuario'),
			#read
			'usuarioTipoUsuarios' => array(self::HAS_MANY, 'UsuarioTipoUsuario000102', 'fk_id_usuario'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'usuario',
			'fk_id_area' => 'Fk Id Area',
			'fk_id_departamento' => 'Fk Id Departamento',
			'fk_id_cargo' => 'Fk Id Cargo',
			'primer_nombre_usuario' => 'Primer Nombre Usuario',
			'segundo_nombre_usuario' => 'Segundo Nombre Usuario',
			'apellido_paterno_usuario' => 'Apellido Paterno Usuario',
			'apellido_materno_usuario' => 'Apellido Materno Usuario',
			'login_usuario' => 'Login Usuario',
			'contrasena_usuario' => 'Contrasena Usuario',
			'sexo_usuario' => 'Sexo Usuario',
			'telefono_usuario' => 'Telefono Usuario',
			'celular_usuario' => 'Celular Usuario',
			'correo_usuario' => 'Correo Usuario',
			'direccion_usuario' => 'Direccion Usuario',
			'imagen_usuario' => 'Imagen Usuario',
			'observaciones_usuario' => 'Observaciones Usuario',
			'fecha_creacion_usuario' => 'Fecha Creacion Usuario',
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

		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('fk_id_area',$this->fk_id_area);
		$criteria->compare('fk_id_departamento',$this->fk_id_departamento);
		$criteria->compare('fk_id_cargo',$this->fk_id_cargo);
		$criteria->compare('primer_nombre_usuario',$this->primer_nombre_usuario,true);
		$criteria->compare('segundo_nombre_usuario',$this->segundo_nombre_usuario,true);
		$criteria->compare('apellido_paterno_usuario',$this->apellido_paterno_usuario,true);
		$criteria->compare('apellido_materno_usuario',$this->apellido_materno_usuario,true);
		$criteria->compare('login_usuario',$this->login_usuario,true);
		$criteria->compare('contrasena_usuario',$this->contrasena_usuario,true);
		$criteria->compare('sexo_usuario',$this->sexo_usuario,true);
		$criteria->compare('telefono_usuario',$this->telefono_usuario,true);
		$criteria->compare('celular_usuario',$this->celular_usuario,true);
		$criteria->compare('correo_usuario',$this->correo_usuario,true);
		$criteria->compare('direccion_usuario',$this->direccion_usuario,true);
		$criteria->compare('imagen_usuario',$this->imagen_usuario,true);
		$criteria->compare('observaciones_usuario',$this->observaciones_usuario,true);
		$criteria->compare('fecha_creacion_usuario',$this->fecha_creacion_usuario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario000101 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function validatePassword($password)
	{
    	if (sha1($password)!==$this->contrasena_usuario)
    		return false;
    	else
    		return true;
   
    	//return CPasswordHelper::verifyPassword($password,$this->password_usuario);
    }

	public function getNameKey() {
		return 'id_usuario';
	}

	public function getHasOne(){
		return array(
		);
	}

	public function getBelonsTo(){
		return array(
				'Area010004',
				'Cargo010004',
				'Departamento010004',
		);
	}

	public function getHasMany(){
		return array(
				'ActivoEntrega020103',
				'ActivoEntrega020103',
				'ActivoRevision020205',
				'LogSistema030003',
				'UsuarioUnidad000102',
		);
	}

	public function getManyMany(){
		return array(
				'UsuarioTipo000201',
		);
	}
    
    public function getTipo($id) {
		 $sql="SELECT
usuario_00_01_01.login_usuario,
usuario_tipo_00_02_01.nombre_usuario_tipo
FROM
usuario_00_01_01
INNER JOIN usuario_tipo_usuario_00_01_02 ON usuario_tipo_usuario_00_01_02.fk_id_usuario = usuario_00_01_01.id_usuario
INNER JOIN usuario_tipo_00_02_01 ON usuario_tipo_usuario_00_01_02.fk_id_usuario_tipo = usuario_tipo_00_02_01.id_usuario_tipo
WHERE
usuario_00_01_01.id_usuario = ".$id;
		$beneficiarios=Yii::app()->db->createCommand($sql)
			 ->queryAll();
		return $beneficiarios;
	}
}
