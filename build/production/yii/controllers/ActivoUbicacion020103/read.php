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
			$model=new ActivoUbicacion020103();
            
            if (isset($_GET['query']) && $_GET['query'] != "") {
                	
				$condiQuery = "";
				$filtro = CJSON::decode($_GET['query']);
                foreach ($filtro as $fvalues):
					foreach($fvalues as $fk=>$fv):
						$condiQuery.= $fk." LIKE '%".$fv."%' OR ";
					endforeach;
				endforeach;
				$condiQuery = substr ($condiQuery, 0, -3);
				$modelo = $model::model()->with('fkIdActivo','fkIdUbicacion')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
				$total = sizeof($modelo);
			} else {
            
                if(isset($_GET['filter']) && $_GET['filter']!=''){
                    $filtro=CJSON::decode($_GET['filter']);
                    if(isset($_GET['sort']) && $_GET['sort']!=''){		
                        $sort=CJSON::decode($_GET['sort']);
                        $condisort=$sort[0]['property'];
                        $valorsort=$sort[0]['direction'];
                        foreach ($filtro as $parametro) {
                            $condicion=$parametro['property'];
                            $valor=$parametro['value'];
							if ($condicion == "fk_id_ubicacion" ||
								$condicion == "fk_id_activo" 
								) {
								$modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->filterTextoInt($condicion,$valor)->ordenar($condisort,$valorsort)->findAll();
								$total="".sizeof($modelo);	
                            	$modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							} else {
								$modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->filterTexto($condicion,$valor)->ordenar($condisort,$valorsort)->findAll();
								$total="".sizeof($modelo);	
								$modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							}
                        }
                    } else {
                        foreach ($filtro as $parametro) {
                            $condicion=$parametro['property'];
                            $valor=$parametro['value'];
							if ($condicion == "fk_id_ubicacion" ||
								$condicion == "fk_id_activo" 
								) {
								$modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
								$total="".sizeof($modelo);	
								$modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							} else {
								$modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->filterTexto($condicion,$valor)->findAll();
								$total="".sizeof($modelo);
								$modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							}
                        }
                    }
                   
                } else {
                    if (isset($_GET['sort']) && $_GET['sort']!=''){
                        $sort=CJSON::decode($_GET['sort']);
                        $condisort=$sort[0]['property'];
                        $valorsort=$sort[0]['direction'];	
                        $modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
                    } else {
                        $modelo=$model::model()->with('fkIdActivo','fkIdUbicacion')->pagina($_GET['limit'],$_GET['start'])->findAll();
                    }
                    $total=$model->count();
                }
			}//if query
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_activo_ubicacion']=$staff->id_activo_ubicacion;
				$aux['fk_id_ubicacion']=$staff->fk_id_ubicacion;
				$aux['fk_id_activo']=$staff->fk_id_activo;
				$aux['estado_activo_ubicacion']=$staff->estado_activo_ubicacion;
					//***********************************************************
				$aux['id_activo']=$staff->fkIdActivo->id_activo;
				$aux['fk_id_proveedor']=$staff->fkIdActivo->fk_id_proveedor;
				$aux['fk_id_activo_clasificacion']=$staff->fkIdActivo->fk_id_activo_clasificacion;
				$aux['fk_id_activo_utilitario']=$staff->fkIdActivo->fk_id_activo_utilitario;
				$aux['fk_id_unidad']=$staff->fkIdActivo->fk_id_unidad;
				$aux['fk_id_area']=$staff->fkIdActivo->fk_id_area;
				$aux['fk_id_departamento']=$staff->fkIdActivo->fk_id_departamento;
				$aux['codigo_activo']=$staff->fkIdActivo->codigo_activo;
				$aux['descripcion_activo']=$staff->fkIdActivo->descripcion_activo;
				$aux['piezas_activo']=$staff->fkIdActivo->piezas_activo;
				$aux['fecha_adquisicion_activo']=$staff->fkIdActivo->fecha_adquisicion_activo;
				#$aux['fecha_baja_activo']=$staff->fkIdActivo->fecha_baja_activo;
				$aux['precio_adquisicion_activo']=$staff->fkIdActivo->precio_adquisicion_activo;
				$aux['garantia_meses_activo']=$staff->fkIdActivo->garantia_meses_activo;
				$aux['archivo_foto_activo']=$staff->fkIdActivo->archivo_foto_activo;
				$aux['fecha_creacion_activo']=$staff->fkIdActivo->fecha_creacion_activo;
					//**********************************************************
				$aux['id_ubicacion']=$staff->fkIdUbicacion->id_ubicacion;
				$aux['fk_id_unidad']=$staff->fkIdUbicacion->fk_id_unidad;
				$aux['nombre_ubicacion']=$staff->fkIdUbicacion->nombre_ubicacion;
				$arreglo[]=$aux;
			}
			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
