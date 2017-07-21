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
			$model=new Activo020101();
			if (isset($_GET['query']) && $_GET['query'] != "") {
                	
				$condiQuery = "";
				$filtro = CJSON::decode($_GET['query']);
                foreach ($filtro as $fvalues):
					foreach($fvalues as $fk=>$fv):
						$condiQuery.= $fk." LIKE '%".$fv."%' OR ";
					endforeach;
				endforeach;
				$condiQuery = substr ($condiQuery, 0, -3);
				$modelo = $model::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
				$total = sizeof($modelo);
			} else {
                if (isset($_GET['filter']) && $_GET['filter']!=''){
                    
					$filtro=CJSON::decode($_GET['filter']);
                    if(isset($_GET['sort']) && $_GET['sort']!=''){		
                        $sort=CJSON::decode($_GET['sort']);
                        $condisort=$sort[0]['property'];
                        $valorsort=$sort[0]['direction'];
                        foreach ($filtro as $parametro) {
                            $condicion=$parametro['property'];
                            $valor=$parametro['value'];
							if ($condicion == "fk_id_proveedor" || 
								$condicion == "fk_id_activo_clasificacion" || 
								$condicion == "fk_id_activo_utilitario" || 
								$condicion == "fk_id_unidad" ||
								$condicion == "fk_id_area" || 
								$condicion == "fk_id_departamento")
								
                            	$modelo=$model::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor')->filterTextoInt("t.".$condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
							else
								$modelo=$model::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
                        }
                    } else {
                        foreach ($filtro as $parametro) {
                            $condicion=$parametro['property'];
                            $valor=$parametro['value'];
							if ($condicion == "fk_id_proveedor" || 
								$condicion == "fk_id_activo_clasificacion" || 
								$condicion == "fk_id_activo_utilitario" || 
								$condicion == "fk_id_unidad" ||
								$condicion == "fk_id_area" || 
								$condicion == "fk_id_departamento"
							) {
								$modelo=$model::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor')->filterTextoInt("t.".$condicion,$valor)->findAll();
								$total = "".sizeof($modelo);
								$modelo=$model::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor')->filterTextoInt("t.".$condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();								
							} else{
								$modelo=$model::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor')->filterTexto($condicion,$valor)->findAll();	
								$total="".sizeof($modelo);
                            	$modelo=$model::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();								
							}
                        }
                    }
                    
                } else {
                    if(isset($_GET['sort']) && $_GET['sort']!=''){
                        $sort=CJSON::decode($_GET['sort']);
                        $condisort=$sort[0]['property'];
                        $valorsort=$sort[0]['direction'];	
                        $modelo=$model::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
                    } else {
                        $modelo=$model::model()->with('fkIdActivoUtilitario','fkIdArea','fkIdDepartamento','fkIdUnidad','fkIdActivoClasificacion','fkIdProveedor')->pagina($_GET['limit'],$_GET['start'])->findAll();
                    }
                    $total=$model->count();
                }
            }//if query
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_activo']=$staff->id_activo;
				$aux['fk_id_proveedor']=$staff->fk_id_proveedor;
				$aux['fk_id_activo_clasificacion']=$staff->fk_id_activo_clasificacion;
				$aux['fk_id_activo_utilitario']=$staff->fk_id_activo_utilitario;
				$aux['fk_id_unidad']=$staff->fk_id_unidad;
				$aux['fk_id_area']=$staff->fk_id_area;
				$aux['fk_id_departamento']=$staff->fk_id_departamento;
				$aux['codigo_activo']=$staff->codigo_activo;
				$aux['descripcion_activo']=$staff->descripcion_activo;
				$aux['piezas_activo']=$staff->piezas_activo;
				$aux['fecha_adquisicion_activo']=$staff->fecha_adquisicion_activo;
				#$aux['fecha_baja_activo']=$staff->fecha_baja_activo;
				$aux['precio_adquisicion_activo']=$staff->precio_adquisicion_activo;
				$aux['garantia_meses_activo']=$staff->garantia_meses_activo;
				$aux['archivo_foto_activo']=$staff->archivo_foto_activo;
				$aux['fecha_creacion_activo']=$staff->fecha_creacion_activo;
				//***********************************************************
				$aux['id_activo_utilitario']=$staff->fkIdActivoUtilitario->id_activo_utilitario;
				$aux['fk_id_activo_clasificacion']=$staff->fkIdActivoUtilitario->fk_id_activo_clasificacion;
				$aux['nombre_activo_utilitario']=$staff->fkIdActivoUtilitario->nombre_activo_utilitario;
				$aux['codigo_activo_utilitario']=$staff->fkIdActivoUtilitario->codigo_activo_utilitario;
				//**********************************************************
				$aux['id_area']=$staff->fkIdArea->id_area;
				$aux['nombre_area']=$staff->fkIdArea->nombre_area;
				$aux['codigo_area']=$staff->fkIdArea->codigo_area;
				$aux['descripcion_area']=$staff->fkIdArea->descripcion_area;
				//**********************************************************
				$aux['id_departamento']=$staff->fkIdDepartamento->id_departamento;
				$aux['nombre_departamento']=$staff->fkIdDepartamento->nombre_departamento;
				$aux['codigo_departamento']=$staff->fkIdDepartamento->codigo_departamento;
				$aux['descripcion_departamento']=$staff->fkIdDepartamento->descripcion_departamento;
				//**********************************************************
				$aux['id_unidad']=$staff->fkIdUnidad->id_unidad;
				$aux['nombre_unidad']=$staff->fkIdUnidad->nombre_unidad;
				$aux['codigo_unidad']=$staff->fkIdUnidad->codigo_unidad;
				$aux['descripcion_unidad']=$staff->fkIdUnidad->descripcion_unidad;
				//**********************************************************
				$aux['id_activo_clasificacion']=$staff->fkIdActivoClasificacion->id_activo_clasificacion;
				$aux['nombre_activo_clasificacion']=$staff->fkIdActivoClasificacion->nombre_activo_clasificacion;
				$aux['descripcion_activo_clasificacion']=$staff->fkIdActivoClasificacion->descripcion_activo_clasificacion;
				$aux['coeficiente_depreciacion_activo_clasificacion']=$staff->fkIdActivoClasificacion->coeficiente_depreciacion_activo_clasificacion;
				$aux['anos_vida_util_activo_clasificacion']=$staff->fkIdActivoClasificacion->anos_vida_util_activo_clasificacion;
				$aux['codigo_activo_clasificacion']=$staff->fkIdActivoClasificacion->codigo_activo_clasificacion;
               	//**********************************************************
				$aux['id_activo_proveedor']=$staff->fkIdProveedor->id_activo_proveedor;
				$aux['nombre_activo_proveedor']=$staff->fkIdProveedor->nombre_activo_proveedor;
				$aux['nit_activo_proveedor']=$staff->fkIdProveedor->nit_activo_proveedor;
				$aux['direccion_activo_proveedor']=$staff->fkIdProveedor->direccion_activo_proveedor;
				$aux['observaciones_activo_proveedor']=$staff->fkIdProveedor->observaciones_activo_proveedor;
				$aux['telefono1_activo_proveedor']=$staff->fkIdProveedor->telefono1_activo_proveedor;
				$aux['telefono2_activo_proveedor']=$staff->fkIdProveedor->telefono2_activo_proveedor;
				
				$arreglo[]=$aux;					
			}
			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
