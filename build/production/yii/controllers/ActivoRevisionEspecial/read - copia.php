<?php
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
				$model=new Activo020101();
				 try {
					 $condition="";
					foreach ($filters as $parametro) :
                        $condicion=$parametro['property'];
                        $valor=$parametro['value'];
						if($valor!="")
							if($condicion == "codigo_activo")	
								$condition.=$condicion." LIKE '%".$valor."%' AND ";
							else
								$condition.=$condicion." = ".$valor." AND ";
						#$condition.=$condicion." = ".$valor." AND ";
					endforeach;
					$condition.="estado_activo_ubicacion = 1";
					#$condition=substr($condition,0,-4);
					#$condition="fk_id_unidad =".$filters['fk_id_unidad']." AND fk_id_area = ".$filters['fk_id_area']." AND fk_id_departamento = ".$filters['fk_id_departamento']." AND fk_id_ubicacion= ".$filters['fk_id_ubicacion']." AND estado_activo_ubicacion = 1";
					$modelo = $model::model()->with(array('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor','activoUbicacions','activoRevision020205s'))->together()->findAll(array("condition"=>$condition,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
					$total = sizeof($modelo);
					
					$arreglo=array();
					foreach($modelo as $staff) {
						$aux=array();
						$aux['id_activo']					=$staff->id_activo;
						$aux['fk_id_proveedor']				=$staff->fk_id_proveedor;
						$aux['fk_id_activo_clasificacion']	=$staff->fk_id_activo_clasificacion;
						$aux['fk_id_activo_utilitario']		=$staff->fk_id_activo_utilitario;
						#$aux['fk_id_unidad']=$staff->fk_id_unidad;
						#$aux['fk_id_area']=$staff->fk_id_area;
						#$aux['fk_id_departamento']=$staff->fk_id_departamento;
						$aux['codigo_activo']				=$staff->codigo_activo;
						$aux['descripcion_activo']			=$staff->descripcion_activo;
						$aux['piezas_activo']				=$staff->piezas_activo;
						$aux['fecha_adquisicion_activo']	=$staff->fecha_adquisicion_activo;
						$aux['fecha_baja_activo']			=$staff->fecha_baja_activo;
						$aux['precio_adquisicion_activo']	=$staff->precio_adquisicion_activo;
						$aux['garantia_meses_activo']		=$staff->garantia_meses_activo;
						$aux['archivo_foto_activo']			=$staff->archivo_foto_activo;
						$aux['fecha_creacion_activo']		=$staff->fecha_creacion_activo;
						
						$aux2=array();
						foreach($staff->activoUbicacions as $va) {
							$aux2['estado_activo_ubicacion']=$va->estado_activo_ubicacion;
							#$aux2['fk_id_ubicacion']=$va->fk_id_ubicacion;
						}
						$aux['activo_ubicacion_02_01_01']=$aux2;
						
						$arreglo[]=$aux;				
					}
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
