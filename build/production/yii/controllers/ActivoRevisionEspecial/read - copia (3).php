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

					$condition.="estado_revision = 1 ";
					$modelo =$model::model()->with('fkIdActivo','fkIdActivoEstado','fkIdRevision','fkIdUsuario')->findAll(array("condition"=>$condition));
					$model2 = new Activo020101();
					$modelo2=$model2::model()->findAll();
					
					$arreglo=array();
					$total=sizeof($modelo);
					
					foreach($modelo as $staff) {
						$sw=0;
						foreach($modelo2 as $staff2):
							if($staff2->id_activo == $staff->fkIdActivo->id_activo){
								$sw = 1;
								break;
							}
						endforeach;
						if ($sw == 1){
							$aux=array();
							$aux['id_activo_revision']				= $staff->id_activo_revision;
							$aux['fk_id_revision']					= $staff->fk_id_revision;
							#$aux['fk_id_activo']					= $staff->fk_id_activo;
							$aux['fk_id_activo_estado']				= $staff->fk_id_activo_estado;
							$aux['fk_id_usuario']					= $staff->fk_id_usuario;
							#$aux['fecha_activo_revision']			= $staff->fecha_activo_revision;
							#$aux['fecha_creacion_activo_revision']	= $staff->fecha_creacion_activo_revision;
							$aux['observacion_activo_revision']		= $staff->observacion_activo_revision;
							$aux['estado_activo_revision']			= $staff->estado_activo_revision;
						
							$aux['id_activo']						=$staff->fkIdActivo->id_activo;
							$aux['codigo_activo']					=$staff->fkIdActivo->codigo_activo;
							$aux['descripcion_activo']				=$staff->fkIdActivo->descripcion_activo;
						
							$arreglo[]=$aux;
						} else {

							$aux=array();
							$aux['id_activo_revision']				= "";
							$aux['fk_id_revision']					= "";
							#$aux['fk_id_activo']					= $staff->fk_id_activo;
							$aux['fk_id_activo_estado']				= "";
							$aux['fk_id_usuario']					= "";
							#$aux['fecha_activo_revision']			= $staff->fecha_activo_revision;
							#$aux['fecha_creacion_activo_revision']	= $staff->fecha_creacion_activo_revision;
							$aux['observacion_activo_revision']		= "";
							$aux['estado_activo_revision']			= "PERMANENTE";
						
							$aux['id_activo']						=$staff2->id_activo;
							$aux['codigo_activo']					=$staff2->codigo_activo;
							$aux['descripcion_activo']				=$staff2->descripcion_activo;
						
							$arreglo[]=$aux;
						}
						
						
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
