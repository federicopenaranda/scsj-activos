<?php
error_reporting(0);
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class read extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de listar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/

	public function run()
    {
		$controller=$this->getController();
        $respuesta=new stdClass();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			$filters=CJSON::decode($_GET['filter']);
			if (json_last_error() === JSON_ERROR_NONE) {
				$model=new ActivoRevision020205();
				 try {
					$condition="";
					foreach ($filters as $parametro) :
                        
						$condicion 	= $parametro['property'];
                        $valor 		= $parametro['value'];
						
						if($valor != "")
							if($condicion == "codigo_activo")	
								$condition.=$condicion." LIKE '%".$valor."%' AND ";
							else
								$condition.=$condicion." = ".$valor." AND ";
					endforeach;
					$condition1=$condition."estado_revision = 1";
					$condition2=substr($condition,0,-4);
					#$condition.="estado_revision = 1 ";
					$modelo =$model::model()->with('fkIdActivo','fkIdRevision','activoUbicacions')->together()->findAll(array("condition"=>$condition1));
					$model2 = new Activo020101();
					$modelo2=$model2::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor','activoUbicacions','activoRevisions')->together()->findAll(array("condition"=>$condition2));
					
					$arreglo = array();
					$total = sizeof($modelo2);
					
					foreach ($modelo2 as $staff2):
						$va = current($modelo);
						if ( $staff2->id_activo == $va->fk_id_activo) {
							
							$aux=array();
							$aux['id_activo_revision']				= $va->id_activo_revision;
							$aux['fk_id_revision']					= $va->fk_id_revision;
							$aux['fk_id_activo']					= $va->fk_id_activo;
							$aux['fk_id_activo_estado']				= $va->fk_id_activo_estado;
							$aux['fk_id_usuario']					= $va->fk_id_usuario;
							$aux['fecha_activo_revision']			= $va->fecha_activo_revision;
							#$aux['fecha_creacion_activo_revision']	= $staff->fecha_creacion_activo_revision;
							$aux['observacion_activo_revision']		= $va->observacion_activo_revision;
							$aux['estado_activo_revision']			= $va->estado_activo_revision;
							
							$aux['id_activo']						=$staff2->id_activo;
							$aux['codigo_activo']					=$staff2->codigo_activo;
							$aux['descripcion_activo']				=$staff2->descripcion_activo;
					
							#$aux2=array();
							#foreach($va->activoUbicacions as $va2) {
								#$aux2['estado_activo_ubicacion'] = $va2['estado_activo_ubicacion'];
								#$aux2['fk_id_ubicacion']=$va->fk_id_ubicacion;
							#}
							#$aux['activo_ubicacion_02_01_01']=$aux2;
						
							$arreglo[]=$aux;
						} else {
							
							$aux=array();
							$aux['id_activo_revision']				= "";
							$aux['fk_id_revision']					= "";
							$aux['fk_id_activo']					= $staff2->id_activo;
							$aux['fk_id_activo_estado']				= "";
							$aux['fk_id_usuario']					= "";
							$aux['fecha_activo_revision']			= "";
							#$aux['fecha_creacion_activo_revision']	= $staff->fecha_creacion_activo_revision;
							$aux['observacion_activo_revision']		= "";
							$aux['estado_activo_revision']			= "pendiente";
							$aux['nombre_activo_estado']			= "";
						
							$aux['id_activo']						=$staff2->id_activo;
							$aux['codigo_activo']					=$staff2->codigo_activo;
							$aux['descripcion_activo']				=$staff2->descripcion_activo;
							
							#$aux2=array();
							#foreach($modelo->activoUbicacions as $va2) {
								#$aux2['estado_activo_ubicacion'] = $va2->estado_activo_ubicacion;
								#$aux2['fk_id_ubicacion']=$va->fk_id_ubicacion;
							#}
							#$aux['activo_ubicacion_02_01_01']=$aux2;

							$arreglo[]=$aux;
						}

						next($modelo);

					endforeach;
					
				} catch(Exception $e) {
					$error=$e->getMessage();
				}
				if($error==""){
					$respuesta->registros=$arreglo;	
					$respuesta->total=$total;
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de sintaxis Json");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
