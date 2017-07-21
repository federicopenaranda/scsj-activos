<?php

/**
 * This is the model class for table "activo_revision_02_02_05".
 *
 * The followings are the available columns in table 'activo_revision_02_02_05':
 * @property integer $id_activo_revision
 * @property integer $fk_id_revision
 * @property integer $fk_id_activo
 * @property integer $fk_id_usuario
 * @property string $condicion_activo_revision
 * @property string $fecha_activo_revision
 * @property string $fecha_creacion_activo_revision
 * @property string $observacion_activo_revision
 * @property string $estado_activo_revision
 *
 * The followings are the available model relations:
 * @property Activo020101 $fkIdActivo
 * @property Revision020204 $fkIdRevision
 * @property Usuario000101 $fkIdUsuario
 */
class ActivoRevision020205 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_revision_02_02_05';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_id_revision, fk_id_activo, fk_id_usuario, condicion_activo_revision, fecha_activo_revision', 'required'),
			array('fk_id_revision, fk_id_activo, fk_id_usuario', 'numerical', 'integerOnly'=>true),
			array('observacion_activo_revision, estado_activo_revision', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_activo_revision, fk_id_revision, fk_id_activo, fk_id_usuario, condicion_activo_revision, fecha_activo_revision, fecha_creacion_activo_revision, observacion_activo_revision, estado_activo_revision', 'safe', 'on'=>'search'),
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
			'fkIdRevision' => array(self::BELONGS_TO, 'Revision020204', 'fk_id_revision'),
			'fkIdUsuario' => array(self::BELONGS_TO, 'Usuario000101', 'fk_id_usuario'),
			//add
			'activoUbicacions'=>array(self::HAS_ONE, 'ActivoUbicacion020103', array('id_activo'=>'fk_id_activo'), 'through'=>'fkIdActivo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_activo_revision' => 'revision;activo',
			'fk_id_revision' => 'Fk Id Revision',
			'fk_id_activo' => 'Fk Id Activo',
			'fk_id_usuario' => 'Fk Id Usuario',
			'condicion_activo_revision' => 'Condicion Activo Revision',
			'fecha_activo_revision' => 'Fecha Activo Revision',
			'fecha_creacion_activo_revision' => 'Fecha Creacion Activo Revision',
			'observacion_activo_revision' => 'Observacion Activo Revision',
			'estado_activo_revision' => 'Estado Activo Revision',
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

		$criteria->compare('id_activo_revision',$this->id_activo_revision);
		$criteria->compare('fk_id_revision',$this->fk_id_revision);
		$criteria->compare('fk_id_activo',$this->fk_id_activo);
		$criteria->compare('fk_id_usuario',$this->fk_id_usuario);
		$criteria->compare('condicion_activo_revision',$this->condicion_activo_revision,true);
		$criteria->compare('fecha_activo_revision',$this->fecha_activo_revision,true);
		$criteria->compare('fecha_creacion_activo_revision',$this->fecha_creacion_activo_revision,true);
		$criteria->compare('observacion_activo_revision',$this->observacion_activo_revision,true);
		$criteria->compare('estado_activo_revision',$this->estado_activo_revision,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoRevision020205 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getNameKey() {
		return 'id_activo_revision';
    }
    
    public function getNameFKey() {
    	return array(
				'fk_id_activo'=>array('activo_02_01_01','id_activo'),
				'fk_id_revision'=>array('revision_02_02_04','id_revision'),
				'fk_id_usuario'=>array('usuario_00_01_01','id_usuario'),
		);
    }
    
    public function getHasOne(){
		return array(
		);
	}
    
    public function getBelonsTo(){
		return array(
				'Activo020101',
				'Revision020204',
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
