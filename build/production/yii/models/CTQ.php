<?php

/**
 * Esta es la clase modelo para la tabla "actividad_favorita".
 *
 * Lo siguiente son las columnas disponibles en la tabla 'actividad_favorita':
 * @property integer $id_actividad_favorita
 * @property string $nombre_actividad_favorita
 *
 * Lo siguiente son las relaciones del modelo disponible:
 * @property Beneficiario[] $beneficiarios
 */
class CTQ extends CActiveRecord
{
	/**
	* @param integer $limit parametro de cuentos registro se va a retornar
	* @param integer $start parametro de inicio desde que registro se va a empezar
	* @return retorna un conjunto de registros 
	*/
	public function pagina($limit, $start)
    {
        $this->getDbCriteria()->mergeWith(array(
             'limit'=>$limit,
             'offset'=>$start,
        ));
        return $this;
    }

    /**
    * metodo que que sirve para hallar registros que cumplan la condicion like
	* @param string $campo parametro de comparacion
	* @param string $n parametro de nombre de campo
	* @return retorna CActiveRecord 
	*/

    public function filterTexto($campo='',$n='')
    {
    	$v='%'.$n.'%';
		$sql=$campo.' like :v';
    	$this->getDbCriteria()->mergeWith(array(
    		'condition'=>$sql,
    			'params'=>array(':v'=>$v),
    		));
    	return $this;
    }
	
	public function filterTextoInt($campo='',$n='')
    {
		$sql=$campo." = :n";
    	$this->getDbCriteria()->mergeWith(array(
    		'condition'=>$sql,
    			'params'=>array(':n'=>$n),
    		));
    	return $this;
    }

    /**
    * Valida la llave foranea de una tabla.
    * @return boolean retorna false si no encuentra ningun registro en la tabla
    */
    public function validaFK($tabla,$campo,$id)
    {
        $sql='select * from '.$tabla.' where('.$campo.'='.$id.')';
    	$rows=Yii::app()->db->createCommand($sql)
		#->select()
		#->from($tabla)
		#->where($campo.'=:id',array(':id'=>$id))
		->queryRow();
		return $rows;
    }
    
    
    /**
    * Ordena los registros de la tabla.
    * @return retorna el objeto
    */
    public function ordenar($campo,$forma){
        $sql=$campo.' '.$forma;
        $this->getDbCriteria()->mergeWith(array(
            'order'=>$sql,
            ));

        return $this;
    }

    public function getTipoDato($nomtabla,$posicion=0)
    {
        mysql_connect('localhost','root','7009593');
        mysql_select_db("sisscsj");
        $sql='select * from '.$nomtabla;
        $result=mysql_query($sql);
        $fields=mysql_num_fields($result);
        $type=mysql_field_type($result,$posicion);
        return $type;
    }

    /**
    * Esta funcion valida si los atributos  del vector son correctos
    * @return boolean retorna verdad si todo es valido caso contrario retorna un mensaje del errror
    */
    public function validaAtrib($listaAtrib)
    {
        foreach ($listaAtrib as $key => $value) {
            $this->$key=$value;
        }
        
        if($this->validate())
            return true;
        else
            return $this->getErrors();
    }

    /**
    * Adiciona un nuevo registro en la tabla
    * @return retorna la llave primaris si se a guardado correctamente caso contraio reduelve un mensaje de error
    */

    public function insertar($listaAtrib)
    {
        foreach ($listaAtrib as $key => $value) {
            $this->$key=$value;
        }
        
        if($this->save())
            return $this->getPrimaryKey();
        else
            return $this->getErrors();
    }
/**
* Esta funcion sirve para la creacion de tabla principales de uno a muchos
* Esta funcion cuenta la cantidad de elemento de tipo vector en un records de la lista de records
*/	
	public function listCountArrayOfEachRecord($listaRecords) {
		$ListaTotalEleVec=array();
		foreach ($listaRecords as $value) { 
                 
			$TotalEleVectores=0; 
            $records=json_decode($value);
            foreach ($records as $propiedad => $valor) { 
                     
				if (is_array($valor)){      
					$TotalEleVectores+=sizeof($valor); 
				}  
			} 
            $ListaTotalEleVec[]=$TotalEleVectores; 
		}
		return $ListaTotalEleVec;
	}
	
    public function beneficiarioTipo($id){
        $sql='select nombre_beneficiario_tipo from (beneficiario_tipo bt inner join beneficiario_estado_beneficiario be  on bt.id_beneficiario_tipo=be.fk_id_beneficiario_tipo )inner join beneficiario b on b.id_beneficiario=be.fk_id_beneficiario  where b.id_beneficiario='.$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
     public function bTipo($id){
        $sql='select * from beneficiario_tipo where id_beneficiario_tipo='.$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	//para Reporte de Excel
	public function consulta1($fini,$ffin){
        $sql="select sexo_usuario_biblioteca,count(*) as cantidad from biblioteca  where fecha_consulta_biblioteca between ".$fini." and ".$ffin." group by sexo_usuario_biblioteca";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function consulta2($fini,$ffin){
        $sql="select e.nombre_escolaridad,e.turno_escolaridad,count(*) as cantidad from biblioteca b inner join escolaridad e on b.fk_id_escolaridad=e.id_escolaridad  where fecha_consulta_biblioteca between ".$fini." and ".$ffin." group by e.nombre_escolaridad,e.turno_escolaridad ";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
    /**
	* Consultas Bibliograficas(Por Género) OK!
	*/
    public function consulta1_1_de_rep1($fini,$ffin){
        $sql="select sexo_usuario_biblioteca,count(*) as cantidad from biblioteca  where fecha_consulta_biblioteca between ".$fini." and ".$ffin." group by sexo_usuario_biblioteca";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
   /**
	* Consultas Bibliograficas por(Nivel) OK!
	*/
    public function consulta2_1_de_rep1($fini,$ffin){
        $sql="SELECT 
CONCAT(n.nombre_nivel,' (',t.nombre_turno,')')as Nivel_Turno,count(*) as cantidad
FROM
biblioteca AS b
INNER JOIN nivel AS n ON b.fk_id_nivel = n.id_nivel
INNER JOIN turno AS t ON b.fk_id_turno = t.id_turno
WHERE
b.fecha_consulta_biblioteca BETWEEN ".$fini." AND ".$ffin."
GROUP BY
n.nombre_nivel,
t.id_turno";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
   /**
	* Consultas Bibliograficas (Por Tipo de Usuario) OK!
	*/
    public function consulta3_1_de_rep1($fini,$ffin){
        $sql="select tipo_usuario_biblioteca,count(*) as cantidad from biblioteca  where fecha_consulta_biblioteca between ".$fini." and ".$ffin." group by tipo_usuario_biblioteca";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	/**
	* Consultas Bibliograficas (Por Area) OK!
	*/
    public function consulta4_1_de_rep1($fini,$ffin){
        $sql="select acb.nombre_area_conocimiento_biblioteca, count(*) as cantidad from biblioteca b inner join area_conocimiento_biblioteca acb on b.fk_id_area_cononcimiento_biblioteca=acb.id_area_conocimiento_biblioteca  where fecha_consulta_biblioteca between ".$fini." and ".$ffin." group by acb.nombre_area_conocimiento_biblioteca";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }

	public function consulta1_1_de_rep2($id){
        $sql="SELECT
b.primer_nombre_beneficiario AS Primer_Nombre,
b.segundo_nombre_beneficiario AS Segundo_Nombre,
b.apellido_paterno_beneficiario AS Apellido_Paterno,
b.apellido_materno_beneficiario AS Apellido_Materno,
b.sexo_beneficiario AS Sexo,
b.fecha_nacimiento_beneficiario AS Fecha_de_Nacimiento,
round(datediff(sysdate(),b.fecha_nacimiento_beneficiario)/365) as Edad,
r.nombre_religion as Religion,
b.carnet_de_salud_beneficiario AS Carnet_de_Salud,
b.trabaja_beneficiario AS Trabaja,
b.libreta_escolar_beneficiario AS Libreta_Escolar
FROM
beneficiario AS b
LEFT JOIN religion AS r ON b.fk_id_religion = r.id_religion
WHERE
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta1_2_de_rep2($id){
        $sql="SELECT
fd.direccion_familia_direccion AS Direccion,
f.codigo_familia as Codigo_de_Familia
FROM
beneficiario AS b
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN familia AS f ON bf.fk_id_familia = f.id_familia
LEFT JOIN familia_direccion AS fd ON fd.fk_id_familia = f.id_familia
WHERE
bf.estado_beneficiario_familia = 1 AND
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta1_3_de_rep2($id){
        $sql="SELECT
bp.numero_caso_beneficiario_patrocinador AS Nro_de_Caso
FROM
beneficiario AS b
INNER JOIN beneficiario_patrocinador AS bp ON bp.fk_id_beneficiario = b.id_beneficiario
WHERE
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta1_4_de_rep2($id){
        $sql="SELECT
bt.descripcion_beneficiario_trabajo AS Lugar_de_Trabajo,
bt.monto_ingreso_beneficiario_trabajo AS Ingreso
FROM
beneficiario AS b
INNER JOIN beneficiario_trabajo AS bt ON bt.fk_id_beneficiario = b.id_beneficiario
WHERE
bt.estado_beneficiario_trabajo = 1 AND
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	/*
	* Ficha Socia Familiar Informacion de institucion (grado escolar, turno)
	*/
	public function consulta1_5_de_rep2($id) {
		 $sql="SELECT
n.nombre_nivel AS Grado_Escolar,
t.nombre_turno AS Turno
FROM
beneficiario AS b
INNER JOIN nivel AS n ON b.fk_id_nivel = n.id_nivel
INNER JOIN turno AS t ON b.fk_id_turno = t.id_turno
WHERE
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta1_6_de_rep2($id){
        $sql="SELECT
bt.numero_beneficiario_telefono as Telefono,bt.emergencia_beneficiario_telefono as Estado_urgencia
FROM
beneficiario AS b
INNER JOIN beneficiario_telefono as bt ON bt.fk_id_beneficiario = b.id_beneficiario
WHERE
b.id_beneficiario =".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta1_7_de_rep2($id){
        $sql="SELECT
i.nombre_idioma as Idiomas
FROM
beneficiario AS b
INNER JOIN beneficiario_idioma AS bi ON bi.fk_id_beneficiario = b.id_beneficiario
INNER JOIN idioma AS i ON bi.fk_id_idioma = i.id_idioma
WHERE
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta1_8_de_rep2($id){
		$sql="SELECT
ti.nombre_tipo_identificacion AS Nombre_identificacion,
bti.numero_tipo_identificacion AS Numero_identificacion
FROM
beneficiario AS b
INNER JOIN beneficiario_tipo_identificacion AS bti ON bti.fk_id_beneficiario = b.id_beneficiario
INNER JOIN tipo_identificacion AS ti ON bti.fk_id_tipo_identificacion = ti.id_tipo_identificacion
WHERE
bti.primario_tipo_identificacion = 1 AND
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	/*
	* Consulta para hallar el sector de la documentacion (certificado de nacimieto numero)
	*/
	public function consulta1_9_de_rep2($id){
        $sql="SELECT
ti.nombre_tipo_identificacion AS Nombre_identificacion,
bti.numero_tipo_identificacion AS Numero_identificacion
FROM
beneficiario AS b
INNER JOIN beneficiario_tipo_identificacion AS bti ON bti.fk_id_beneficiario = b.id_beneficiario
INNER JOIN tipo_identificacion AS ti ON bti.fk_id_tipo_identificacion = ti.id_tipo_identificacion
WHERE
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	/**
	* Ficha Social Familiar Informacion de instruccion (unidad Educativa)
	*/
	public function consulta1_10_de_rep2($id){
        $sql="SELECT
ue.nombre_unidad_educativa as Unidad_Educativa
FROM
beneficiario AS b
INNER JOIN beneficiario_unidad_educativa AS bue ON bue.fk_id_beneficiario = b.id_beneficiario
INNER JOIN unidad_educativa AS ue ON bue.fk_id_unidad_educativa = ue.id_unidad_educativa
WHERE
bue.estado_beneficiario_unidad_educativa = 1 AND
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
   
    public function consulta2_de_rep2($id){
        $sql="SELECT
b.primer_nombre_beneficiario as Nombre,
b.apellido_paterno_beneficiario as Apellido,
tp.nombre_tipo_parentesco as Parentesco,
round(datediff(sysdate(),b.fecha_nacimiento_beneficiario)/365) as Edad,
p.responsable_beneficiario as Responsable,
b.sexo_beneficiario as Sexo,
o.nombre_ocupacion as Tipo_ocupacion,
o.descripcion_ocupacion as Ocupacion,
bt.monto_ingreso_beneficiario_trabajo as Ingreso
FROM
beneficiario AS b
INNER JOIN parentesco AS p ON p.fk_id_beneficiario1 = b.id_beneficiario and p.fk_id_beneficiario1 = b.id_beneficiario
INNER JOIN tipo_parentesco AS tp ON p.fk_id_tipo_parentesco = tp.id_tipo_parentesco
INNER JOIN beneficiario_ocupacion AS bo ON bo.fk_id_beneficiario = p.fk_id_beneficiario1
INNER JOIN ocupacion AS o ON bo.fk_id_ocupacion = o.id_ocupacion
INNER JOIN beneficiario_trabajo AS bt ON bt.fk_id_beneficiario = b.id_beneficiario
where p.fk_id_beneficiario=".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
    /**
	* Ficha Social Familiar - Situacion Socio Economica (Informacion de Casa)
	*/
    public function consulta3_de_rep2($id){
        $sql="SELECT
fc.nombre_tipo_casa AS Tipo_de_Vivienda,
ftc.ambientes_familia_tipo_casa AS Numero_de_Habitaciones,
fco.nombre_tipo_cocina AS Tipo_de_Cocina,
b.observacion_beneficiario AS Observaciones,
b.informacion_relevante_beneficiario AS Informacion_relevante
FROM
beneficiario AS b
LEFT JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
LEFT JOIN familia AS f ON bf.fk_id_familia = f.id_familia
LEFT JOIN familia_tipo_casa AS ftc ON ftc.fk_id_familia = f.id_familia
LEFT JOIN tipo_casa AS fc ON ftc.fk_id_tipo_casa = fc.id_tipo_casa
LEFT JOIN tipo_cocina AS fco ON ftc.fk_id_tipo_cocina = fco.id_tipo_cocina
WHERE
ftc.estado_familia_tipo_casa = 1 AND
bf.estado_beneficiario_familia = 1 AND
b.id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    /**
	* Ficha Social Familiar - Situacion Socio Economica (servicios Basicos)
	*/
    public function subconsulta1_de_rep3($id){
        $sql="SELECT
sb.nombre_servicio_basico AS Servicio
FROM
beneficiario AS b
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN familia AS f ON bf.fk_id_familia = f.id_familia
INNER JOIN familia_servicio_basico AS fsb ON fsb.fk_id_familia = f.id_familia
INNER JOIN servicio_basico AS sb ON fsb.fk_id_servicio_basico = sb.id_servicio_basico
WHERE
bf.estado_beneficiario_familia = 1 AND
fsb.estado_familia_servicio_basico = 1 AND
b.id_beneficiario =".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta2_1_de_rep2($id){
		$sql="SELECT
CONCAT(b.primer_nombre_beneficiario,' ',b.apellido_paterno_beneficiario) AS Nombre,
tp.nombre_tipo_parentesco AS Parentesco,
round(datediff(sysdate(),b.fecha_nacimiento_beneficiario)/365) AS Edad,
bf.responsable_beneficiario AS Responsable,
b.sexo_beneficiario AS Sexo,
n.nombre_nivel AS Grado,
o.nombre_ocupacion AS Tipo_de_Ocupacion,
o.descripcion_ocupacion AS Ocupacion,
bt.monto_ingreso_beneficiario_trabajo AS Ingreso
FROM
beneficiario AS b
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
LEFT JOIN tipo_parentesco AS tp ON bf.fk_id_tipo_parentesco = tp.id_tipo_parentesco
LEFT JOIN nivel AS n ON b.fk_id_nivel = n.id_nivel
LEFT JOIN beneficiario_ocupacion AS bo ON bo.fk_id_beneficiario = b.id_beneficiario
LEFT JOIN familia AS f ON bf.fk_id_familia = f.id_familia
LEFT JOIN ocupacion AS o ON bo.fk_id_ocupacion = o.id_ocupacion AND bo.estado_beneficiario_ocupacion = 1
LEFT JOIN beneficiario_trabajo AS bt ON bt.fk_id_beneficiario = b.id_beneficiario AND bt.estado_beneficiario_trabajo = 1
WHERE
f.codigo_familia = (SELECT
f.codigo_familia
FROM
beneficiario AS b
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN familia AS f ON bf.fk_id_familia = f.id_familia
WHERE
f.estado_familia = 1 AND
bf.estado_beneficiario_familia = 1 AND
f.estado_familia = 1 AND
b.id_beneficiario = $id
) AND
b.id_beneficiario <> ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta2_2_de_rep2($id){
        $sql="SELECT
o.nombre_ocupacion AS Tipo_de_Ocupacion,
o.descripcion_ocupacion AS Ocupacion
FROM
beneficiario AS b
INNER JOIN parentesco AS p ON p.fk_id_beneficiario1 = b.id_beneficiario AND p.fk_id_beneficiario1 = b.id_beneficiario
INNER JOIN beneficiario_ocupacion AS bo ON bo.fk_id_beneficiario = b.id_beneficiario
INNER JOIN ocupacion AS o ON bo.fk_id_ocupacion = o.id_ocupacion
WHERE
bo.estado_beneficiario_ocupacion = 1 AND
p.fk_id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta2_3_de_rep2($id){
        $sql="SELECT
bt.monto_ingreso_beneficiario_trabajo AS Ingreso
FROM
beneficiario AS b
INNER JOIN parentesco AS p ON p.fk_id_beneficiario1 = b.id_beneficiario AND p.fk_id_beneficiario1 = b.id_beneficiario
INNER JOIN beneficiario_trabajo AS bt ON bt.fk_id_beneficiario = b.id_beneficiario

WHERE
bt.estado_beneficiario_trabajo = 1 AND
p.fk_id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
    public function listaAccion($nom,$con){
        $sql="select pu.accion_privilegio_usuario as accion from privilegios_usuario as pu inner join privilegios_tipo_usuario as ptu on pu.id_privilegios_usuario=ptu.fk_id_privilegios_usuario inner join tipo_usuario as tu on ptu.fk_id_tipo_usuario=tu.id_tipo_usuario inner join usuario as u on tu.id_tipo_usuario=u.fk_id_tipo_usuario where u.login_usuario='".$nom."' and pu.opciones_privilegio_usuario='".$con."' order by accion_privilegio_usuario asc";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    public function listaAcciones($nom,$con){
        //$objusu=new Usuario();
        //$nombre=Yii::app()->user->name;
        $res=$this->listaAccion($nom,$con);
        $aux=array();
        for($i=0;$i<sizeof($res);$i++) {
            $aux[]=$res[$i]['accion'];
        }
        return $aux;

    }
	/**
	* Esta funcion lista todos los parientes de un beneficiario para la accion create de Actividad
	* Devuelve los id's de los parientes
	*/
	 public function lista_de_parientes($id){
        $sql="SELECT
b.id_beneficiario
FROM
beneficiario AS b
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN familia AS f ON bf.fk_id_familia = f.id_familia
WHERE
bf.estado_beneficiario_familia = 1 AND
f.estado_familia = 1 AND
b.id_beneficiario <> $id AND
f.codigo_familia = (SELECT
f.codigo_familia
FROM
beneficiario AS b
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN familia AS f ON bf.fk_id_familia = f.id_familia
WHERE
bf.estado_beneficiario_familia = 1 AND
f.estado_familia = 1 AND
b.id_beneficiario = $id)";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	/**
	* Esta funcion valida los nombres de los atributos del objetos en cuestion
	* retorna un valor booleano
	*/
	 public function validaCampo($campo) {
        $ListaActributos=$this->attributeLabels();
        $sw=false;
        foreach ($ListaActributos as $key => $value) {
            if($key==$campo)
                $sw=true;
        }
        return $sw;
    }
	
	/**
    * Esta funcion devuelve el nombre de la columna de la llave primaria de una tabla
    */
    public function nombreLlavePrimaria($tabla){
        //$tabla=$this->tableName();
        $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='sisscsj' AND TABLE_NAME ='".$tabla."' and COLUMN_KEY ='PRI'";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    /**
    * Esta funcion devuelve el nombre de la columna de la llave foranea de una tabla
    */
    public function nombreLlaveForanea($tabla){
        $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='sisscsj' AND TABLE_NAME ='".$tabla."' and COLUMN_KEY ='MUL'";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function divideRecords($url) {
		$params=array();
		foreach ($url as $value) {
			if (strpos($value,"records")!==FAlSE){
				$str=str_replace('"[', '[',trim(urldecode($value),"recods="));
				$str=str_replace(']"', ']',$str);
				$str=str_replace('\"', '"', $str);
				$params[]=$str;
			} 
		}
		return $params;
	}
	public function insertAudi($accion,$nomTab,$id){
		$this->fk_id_usuario 			= Yii::app()->user->id;
		$this->fecha_hora_log_sistema	= date('Y-m-d H:i:s');
		$this->accion_log_sistema 		= $accion;
		$this->tabla_log_sistema 		= $nomTab;
		$this->id_registro_log_sistema 	= $id;
		if($this->validate())
			$this->save();
	}
	public function consulta2_1_de_pdf5($id){
        $sql="SELECT
b.id_beneficiario as id,
b.primer_nombre_beneficiario AS Nombre,
b.apellido_paterno_beneficiario AS Apellido,
tp.nombre_tipo_parentesco AS Parentesco,
round(datediff(sysdate(),b.fecha_nacimiento_beneficiario)/365) as Edad,
p.responsable_beneficiario AS Responsable,
b.sexo_beneficiario AS Sexo,
e.nombre_escolaridad AS Grado
FROM
beneficiario AS b
INNER JOIN parentesco AS p ON p.fk_id_beneficiario1 = b.id_beneficiario AND p.fk_id_beneficiario1 = b.id_beneficiario
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN tipo_parentesco AS tp ON bf.fk_id_tipo_parentesco = tp.id_tipo_parentesco
INNER JOIN escolaridad AS e ON b.fk_id_escolaridad = e.id_escolaridad
WHERE
p.fk_id_beneficiario = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	public function fecha($id){
        $sql=" SELECT fecha_nacimiento_beneficiario as fecha FROM beneficiario WHERE id_beneficiario= ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }


    /*public function ordenar(){
        $rows=Yii::app()->db->createCommand()
        ->select()
        ->from('actividad_favorita')
        ->order('id_actividad_favorita ASC')
        ->queryRow();
        return $rows;
    }*/
	public function eliFkId($campo){
        $listCampo=explode($campo,"_");
		return $list[2];
        
    }
	/*
	* REPORTES DE ACTIVOS SCSJ
	*/
	/**
    * Reporte en PDF 1 de un activo y todos sus datos e historia que se divide en 3 tablas donde el id es el id activo
    * PARTE 1
    */
	public function queryPdf_1_de_rep1($id) {
        $sql="SELECT
a.codigo_activo,
a.descripcion_activo,
a.piezas_activo,
a.fecha_adquisicion_activo,
a.precio_adquisicion_activo,
a.garantia_meses_activo,
a.archivo_foto_activo,
ap.nombre_activo_proveedor,
ac.nombre_activo_clasificacion,
u.nombre_unidad,
ar.nombre_area,
d.nombre_departamento
FROM
activo_02_01_01 AS a
LEFT JOIN activo_proveedor_02_01_04 AS ap ON a.fk_id_proveedor = ap.id_activo_proveedor
LEFT JOIN activo_clasificacion_02_01_04 AS ac ON a.fk_id_activo_clasificacion = ac.id_activo_clasificacion
LEFT JOIN unidad_01_00_04 AS u ON a.fk_id_unidad = u.id_unidad
LEFT JOIN area_01_00_04 AS ar ON a.fk_id_area = ar.id_area
LEFT JOIN departamento_01_00_04 AS d ON a.fk_id_departamento = d.id_departamento
WHERE
a.id_activo = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	/**
	* PARTE 2
	*/
	public function queryPdf_2r_de_rep1($id) {
		$sql="SELECT x.*,activo_entrega_02_01_03.* from usuario_00_01_01 x INNER JOIN activo_entrega_02_01_03 ON activo_entrega_02_01_03.fk_id_usuario_recibio = x.id_usuario  
WHERE id_usuario IN (SELECT fk_id_usuario_recibio FROM activo_entrega_02_01_03 where activo_entrega_02_01_03.fk_id_usuario_recibio = x.id_usuario) AND activo_entrega_02_01_03.fk_id_activo = $id ORDER BY activo_entrega_02_01_03.fecha_activo_entrega DESC
";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
	}

    /**
    * PARTE 3
    */
    public function queryPdf_2e_de_rep1($id) {
        $sql="SELECT x.*,activo_entrega_02_01_03.* from usuario_00_01_01 x INNER JOIN activo_entrega_02_01_03 ON activo_entrega_02_01_03.fk_id_usuario_entrego = x.id_usuario  
WHERE id_usuario IN (SELECT fk_id_usuario_entrego FROM activo_entrega_02_01_03 where activo_entrega_02_01_03.fk_id_usuario_entrego = x.id_usuario) AND activo_entrega_02_01_03.fk_id_activo = $id ORDER BY activo_entrega_02_01_03.fecha_activo_entrega DESC";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
    /**
    * PARTE 3
    */

    public function queryPdf_3_de_rep1($id) {
        $sql="SELECT
av.valor_activo_valor,
ar.fecha_activo_revision,
ar.observacion_activo_revision,
u.nombre_ubicacion,
r.fecha_inicio_revision,
r.fecha_fin_revision
FROM
activo_revision_02_02_05 AS ar
INNER JOIN revision_02_02_04 AS r ON ar.fk_id_revision = r.id_revision
LEFT JOIN activo_02_01_01 AS a ON ar.fk_id_activo = a.id_activo
LEFT JOIN activo_valor_02_01_03 AS av ON av.fk_id_activo = a.id_activo
LEFT JOIN activo_ubicacion_02_01_03 AS au ON au.fk_id_activo = a.id_activo
LEFT JOIN ubicacion_02_01_04 AS u ON au.fk_id_ubicacion = u.id_ubicacion
WHERE
ar.fk_id_activo = $id
ORDER BY
r.estado_revision DESC
";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	/*
	* •	Reporte en PDF 2 de Proveedor con todos sus datos:
	*/
	public function queryPdf_1_de_rep2($id) {
		$sql="SELECT
ap.nombre_activo_proveedor,
ap.nit_activo_proveedor,
ap.direccion_activo_proveedor,
ap.observaciones_activo_proveedor,
ap.telefono1_activo_proveedor,
ap.telefono2_activo_proveedor
FROM
activo_02_01_01 AS a
INNER JOIN activo_proveedor_02_01_04 AS ap ON a.fk_id_proveedor = ap.id_activo_proveedor
WHERE
a.id_activo = ".$id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
	}

    /**
    * Reporte en PDF 3 de reoirtes entregados a un determinado usuario. Se seleccionan todos los activos asignados
    * al usuario del cual se desea el reporte 
    */
	
	public function consulta11_de_rep1($fk_id) {
		$sql="SELECT
a.codigo_activo,
a.descripcion_activo,
a.piezas_activo,
a.fecha_adquisicion_activo,
ac.nombre_activo_clasificacion,
ac.descripcion_activo_clasificacion,
ac.coeficiente_depreciacion_activo_clasificacion,
ac.anos_vida_util_activo_clasificacion,
r.fecha_inicio_revision
FROM
activo_entrega_02_01_03 AS ae
INNER JOIN activo_02_01_01 AS a ON ae.fk_id_activo = a.id_activo
INNER JOIN activo_clasificacion_02_01_04 AS ac ON a.fk_id_activo_clasificacion = ac.id_activo_clasificacion
INNER JOIN activo_revision_02_02_05 AS ar ON ar.fk_id_activo = a.id_activo
INNER JOIN revision_02_02_04 AS r ON ar.fk_id_revision = r.id_revision
WHERE
a.id_activo IN ((SELECT
ar.fk_id_activo
FROM
revision_02_02_04 AS r
INNER JOIN activo_revision_02_02_05 AS ar ON ar.fk_id_revision = r.id_revision
WHERE
r.estado_revision = 1)) AND
ae.fk_id_usuario_recibio = ".$fk_id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
	}
	
	public function consulta12_de_rep1($fk_id) {
        $sql = "SELECT DISTINCT
u.primer_nombre_usuario,
u.apellido_paterno_usuario,
u.apellido_materno_usuario,
un.nombre_unidad
FROM
usuario_00_01_01 AS u
LEFT JOIN usuario_unidad_00_01_02 AS uu ON uu.fk_id_usuario = u.id_usuario
LEFT JOIN unidad_01_00_04 AS un ON uu.fk_id_unidad = un.id_unidad
LEFT JOIN activo_entrega_02_01_03 AS ae ON ae.fk_id_usuario_recibio = u.id_usuario
WHERE
u.id_usuario = ".$fk_id;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consulta12e_de_rep1($fk_id,$id_a_e) {
        $sql = "SELECT
u.primer_nombre_usuario,
u.apellido_paterno_usuario,
u.apellido_materno_usuario,
un.nombre_unidad
FROM
usuario_00_01_01 AS u
INNER JOIN activo_entrega_02_01_03 AS ae ON ae.fk_id_usuario_entrego = u.id_usuario
LEFT JOIN unidad_01_00_04 AS un ON u.fk_id_unidad = un.id_unidad
WHERE
ae.fk_id_usuario_recibio = $fk_id and ae.id_activo_entrega = ".$id_a_e;
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	/**
	* REPORTE PDF LISTA DE ACTIVOS EN UN RANDO DE FECHA BAJA
	*/
	public function consulta11_de_rep3($fecha_min,$fecha_max) {
        $sql = "SELECT
a.codigo_activo,
a.descripcion_activo,
a.piezas_activo,
a.fecha_adquisicion_activo,
ac.nombre_activo_clasificacion,
u.nombre_ubicacion
FROM
activo_02_01_01 AS a
LEFT JOIN activo_clasificacion_02_01_04 AS ac ON a.fk_id_activo_clasificacion = ac.id_activo_clasificacion
LEFT JOIN activo_ubicacion_02_01_03 AS au ON au.fk_id_activo = a.id_activo
LEFT JOIN ubicacion_02_01_04 AS u ON au.fk_id_ubicacion = u.id_ubicacion
LEFT JOIN activo_revision_02_02_05 AS ar ON ar.fk_id_activo = a.id_activo
WHERE
ar.condicion_activo_revision = 'baja' AND ar.fecha_activo_revision>=$fecha_min AND ar.fecha_activo_revision<=$fecha_max";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consultaEx1_de_rep1($id,$fini,$ffin) {
        $sql = "SELECT
a.codigo_activo,
a.descripcion_activo
FROM
activo_02_01_01 AS a
INNER JOIN activo_revision_02_02_05 AS ar ON ar.fk_id_activo = a.id_activo
INNER JOIN activo_estado_02_02_04 AS ae ON ar.fk_id_activo_estado = ae.id_activo_estado
INNER JOIN revision_02_02_04 AS r ON ar.fk_id_revision = r.id_revision
WHERE
r.id_revision = $id AND
fecha_baja_activo BETWEEN '".$fini."' and '".$ffin."'";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function consultaEx2_de_rep1($id,$fini,$ffin) {
        $sql = "SELECT
a.codigo_activo,
a.descripcion_activo
FROM
activo_02_01_01 AS a
INNER JOIN activo_revision_02_02_05 AS ar ON ar.fk_id_activo = a.id_activo
INNER JOIN activo_estado_02_02_04 AS ae ON ar.fk_id_activo_estado = ae.id_activo_estado
INNER JOIN revision_02_02_04 AS r ON ar.fk_id_revision = r.id_revision
WHERE
r.id_revision = $id AND
fecha_adquisicion_activo BETWEEN '".$fini."' and '".$ffin."'";
        $rows=Yii::app()->db->createCommand($sql)
        ->queryAll();
        return $rows;
    }
	
	public function calculaMes($fech_ini,$fech_fin){
		$fIni_yr=substr($fech_ini,0,4);
		$fIni_mon=substr($fech_ini,5,2);
		$fIni_day=substr($fech_ini,8,2);
		$fFin_yr=substr($fech_fin,0,4);
		$fFin_mon=substr($fech_fin,5,2);
		$fFin_day=substr($fech_fin,8,2);
	
		$yr_dif=$fFin_yr - $fIni_yr;
	  
		if ($yr_dif == 1) {
			$fIni_mon = 12 - $fIni_mon;
			$meses = $fFin_mon + $fIni_mon;
			#$meses++;
			return $meses;
		} else {
			if($yr_dif == 0) {
				$meses=$fFin_mon - $fIni_mon;
				#$meses++;
				return $meses;
			} else {
				if($yr_dif > 1){
					$fIni_mon = 12 - $fIni_mon;
					$meses = $fFin_mon + $fIni_mon + (($yr_dif - 1) * 12);
					#if($fFin_mon != $fIni_mon)
						#$meses++;
					return $meses;
				} else
				   echo "ERROR -> la fecha inicial es mayor a la fecha final <br>";
				   exit();	
			}
		}		
	}
	

}
