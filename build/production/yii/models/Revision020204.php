<?php

/**
 * This is the model class for table "revision_02_02_04".
 *
 * The followings are the available columns in table 'revision_02_02_04':
 * @property integer $id_revision
 * @property string $fecha_inicio_revision
 * @property string $fecha_fin_revision
 * @property string $observaciones_revision
 * @property string $descripcion_revision
 * @property integer $estado_revision
 *
 * The followings are the available model relations:
 
 * @property ActivoRevision020205[] $activoRevision020205s
 */
class Revision020204 extends CTQ
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'revision_02_02_04';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_inicio_revision, descripcion_revision, estado_revision', 'required'),
			array('estado_revision', 'numerical', 'integerOnly'=>true),
			array('fecha_fin_revision, observaciones_revision', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_revision, fecha_inicio_revision, fecha_fin_revision, observaciones_revision, descripcion_revision, estado_revision', 'safe', 'on'=>'search'),
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
			'activoRevision020205s' => array(self::HAS_MANY, 'ActivoRevision020205', 'fk_id_revision'),
			#'VarName' => array(self::HAS_MANY, ''ClassName', 'ForeignKey'),
		);
        
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_revision' => 'Id Revision',
			'fecha_inicio_revision' => 'Fecha Inicio Revision',
			'fecha_fin_revision' => 'Fecha Fin Revision',
			'observaciones_revision' => 'Observaciones Revision',
			'descripcion_revision' => 'Descripcion Revision',
			'estado_revision' => 'Estado Revision',
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

		$criteria->compare('id_revision',$this->id_revision);
		$criteria->compare('fecha_inicio_revision',$this->fecha_inicio_revision,true);
		$criteria->compare('fecha_fin_revision',$this->fecha_fin_revision,true);
		$criteria->compare('observaciones_revision',$this->observaciones_revision,true);
		$criteria->compare('descripcion_revision',$this->descripcion_revision,true);
		$criteria->compare('estado_revision',$this->estado_revision);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Revision020204 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNameKey() {
		return 'id_revision';
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
				'ActivoRevision020205',
		);
	}

	public function getManyMany(){
		return array(
		);
	}
}
