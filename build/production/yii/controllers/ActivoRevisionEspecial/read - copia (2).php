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
					$condition.="estado_activo_ubicacion = 1 ";
					$condition1=$condition." AND id_activo IN (SELECT ar.fk_id_activo FROM activo_revision_02_02_05 AS ar INNER JOIN revision_02_02_04 AS r ON ar.fk_id_revision = r.id_revision WHERE r.estado_revision = 1)";
					$condition2=$condition." AND id_activo NOT IN (SELECT ar.fk_id_activo FROM activo_revision_02_02_05 AS ar INNER JOIN revision_02_02_04 AS r ON ar.fk_id_revision = r.id_revision WHERE r.estado_revision = 1)";
					
					#$modelo = $model::model()->with(array('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor','activoUbicacions','activoRevision020205s'))->together()->findAll(array("condition"=>$condition,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
					#$objSub =new ActivoRevision020205();
					#$subMod=$objSub::model()->with('fkIdRevision')->findAll(array('condition'=>'estado_revision = 1'));
					$query1 = $model::model()->with(array('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor','activoUbicacions','activoRevision020205s'))->together()->findAll(array("condition"=>$condition1,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
					$query2 = $model::model()->with(array('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor','activoUbicacions','activoRevision020205s'))->together()->findAll(array("condition"=>$condition2,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
					
					#$query1 = $model::model()->with(array('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor','activoUbicacions','activoRevision020205s'))->together()->findAll(array("condition"=>'id_activo IN (SELECT ar.fk_id_activo FROM activo_revision_02_02_05 AS ar INNER JOIN revision_02_02_04 AS r ON ar.fk_id_revision = r.id_revision WHERE r.estado_revision = 1)'));
					
					#$query2 = $model::model()->with(array('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor','activoUbicacions','activoRevision020205s'))->together()->findAll(array("condition"=>'id_activo NOT IN (SELECT ar.fk_id_activo FROM activo_revision_02_02_05 AS ar INNER JOIN revision_02_02_04 AS r ON ar.fk_id_revision = r.id_revision WHERE r.estado_revision = 1)'));
					
					#$total = sizeof($modelo);
					
					$arreglo=array();
					$total=sizeof($query1)+sizeof($query2);
					
					foreach($query1 as $staff) {
						/*$sw=0;
						foreach($subMod as $substaff):
							if ($staff->id_activo == $substaff->fk_id_activo){
								$sw=1;
								break;
							}
						endforeach;*/
						
							$aux=array();
							$aux['id_activo']					=$staff->id_activo;
							//$aux['fk_id_proveedor']				=$staff->fk_id_proveedor;
							//$aux['fk_id_activo_clasificacion']	=$staff->fk_id_activo_clasificacion;
							//$aux['fk_id_activo_utilitario']		=$staff->fk_id_activo_utilitario;
							$aux['codigo_activo']				=$staff->codigo_activo;
							$aux['descripcion_activo']			=$staff->descripcion_activo;
							//$aux['piezas_activo']				=$staff->piezas_activo;
							//$aux['fecha_adquisicion_activo']	=$staff->fecha_adquisicion_activo;
							//$aux['fecha_baja_activo']			=$staff->fecha_baja_activo;
							//$aux['precio_adquisicion_activo']	=$staff->precio_adquisicion_activo;
							//$aux['garantia_meses_activo']		=$staff->garantia_meses_activo;
							//$aux['archivo_foto_activo']			=$staff->archivo_foto_activo;
							//$aux['fecha_creacion_activo']		=$staff->fecha_creacion_activo;
							
							/*$aux2=array();
							foreach($staff->activoUbicacions as $va) {
								$aux2['estado_activo_ubicacion']=$va->estado_activo_ubicacion;
								#$aux2['fk_id_ubicacion']=$va->fk_id_ubicacion;
							}
							$aux['activo_ubicacion_02_01_01']=$aux2;*/
							$aux2=array();
							foreach($staff->activoRevision020205s as $va) {
								$aux2['id_activo_revision']=$va->id_activo_revision;
								$aux2['fk_id_revision']=$va->fk_id_revision;
								$aux2['fk_id_activo_estado']=$va->fk_id_activo_estado;
								$aux2['fk_id_usuario']=$va->fk_id_usuario;
								$aux2['observacion_activo_revision']=$va->observacion_activo_revision;
								$aux2['estado_activo_revision']=$va->estado_activo_revision;
							}
							$aux['activo_revision_02_02_05']=$aux2;
						
							$arreglo[]=$aux;
					}
					foreach($query2 as $staff) {
						
							$aux=array();
							$aux['id_activo']					=$staff->id_activo;
							//$aux['fk_id_proveedor']				=$staff->fk_id_proveedor;
							//$aux['fk_id_activo_clasificacion']	=$staff->fk_id_activo_clasificacion;
							//$aux['fk_id_activo_utilitario']		=$staff->fk_id_activo_utilitario;
							$aux['codigo_activo']				=$staff->codigo_activo;
							$aux['descripcion_activo']			=$staff->descripcion_activo;
							//$aux['piezas_activo']				=$staff->piezas_activo;
							//$aux['fecha_adquisicion_activo']	=$staff->fecha_adquisicion_activo;
							//$aux['fecha_baja_activo']			=$staff->fecha_baja_activo;
							//$aux['precio_adquisicion_activo']	=$staff->precio_adquisicion_activo;
							//$aux['garantia_meses_activo']		=$staff->garantia_meses_activo;
							//$aux['archivo_foto_activo']			=$staff->archivo_foto_activo;
							//$aux['fecha_creacion_activo']		=$staff->fecha_creacion_activo;
							
							/*$aux2=array();
							$aux2['fecha_activo_revision']="";
							$aux2['fecha_creacion_activo_revision']="";
							$aux2['observacion_activo_revision']="";
							$aux2['estado_activo_revision']="permanente";*/
							#$aux2['fk_id_ubicacion']=$va->fk_id_ubicacion;
							
							//$aux['activo_revision_02_02_05']=$aux2;
							$aux2=array();
							foreach($staff->activoRevision020205s as $va) {
								$aux2['id_activo_revision']="";
								$aux2['fk_id_revision']="";
								$aux2['fk_id_activo_estado']="";
								$aux2['fk_id_usuario']="";
								$aux2['observacion_activo_revision']="";
								$aux2['estado_activo_revision']="pendiente";
							}
							$aux['activo_revision_02_02_05']=$aux2;
						
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
