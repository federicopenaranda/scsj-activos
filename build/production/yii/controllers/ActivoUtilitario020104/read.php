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
			$model=new ActivoUtilitario020104();
            
            if (isset($_GET['query']) && $_GET['query'] != "") {
                	
				$condiQuery = "";
				$filtro = CJSON::decode($_GET['query']);
                foreach ($filtro as $fvalues):
					foreach($fvalues as $fk=>$fv):
						$condiQuery.= $fk." LIKE '%".$fv."%' OR ";
					endforeach;
				endforeach;
				$condiQuery = substr ($condiQuery, 0, -3);
				$modelo = $model::model()->with('fkIdActivoClasificacion')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
				$total = sizeof($modelo);
			} else {
                 
				if (isset($_GET['filter']) && $_GET['filter']!='') {
					$filtro=CJSON::decode($_GET['filter']);
					
                    if (isset($_GET['sort']) && $_GET['sort']!='') {		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];
						
                        foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
							if ($condicion == "fk_id_activo_clasificacion"
								) {
								$modelo = $model::model()->with('fkIdActivoClasificacion')->filterTextoInt($condicion,$valor)->ordenar($condisort,$valorsort)->findAll();
								$total="".sizeof($modelo);
								$modelo=$model::model()->with('fkIdActivoClasificacion')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
								} else {
								$modelo=$model::model()->with('fkIdActivoClasificacion')->filterTexto($condicion,$valor)->ordenar($condisort,$valorsort)->findAll();
								$total="".sizeof($modelo);
								$modelo=$model::model()->with('fkIdActivoClasificacion')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
								}
						}
					} else {
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
							if ($condicion == "fk_id_activo_clasificacion"
								) {
								$modelo=$model::model()->with('fkIdActivoClasificacion')->filterTextoInt($condicion,$valor)->findAll();
								$total="".sizeof($modelo);
								$modelo=$model::model()->with('fkIdActivoClasificacion')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							} else {
								$modelo=$model::model()->with('fkIdActivoClasificacion')->filterTexto($condicion,$valor)->findAll();
								$total="".sizeof($modelo);
								$modelo=$model::model()->with('fkIdActivoClasificacion')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							}
						}
					}
					
				} else {
					if(isset($_GET['sort']) && $_GET['sort']!=''){
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];
						$modelo=$model::model()->with('fkIdActivoClasificacion')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
					} else {
						$modelo=$model::model()->with('fkIdActivoClasificacion')->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
					$total=$model->count();
				}
			}//if query
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_activo_utilitario']=$staff->id_activo_utilitario;
				$aux['fk_id_activo_clasificacion']=$staff->fk_id_activo_clasificacion;
				$aux['nombre_activo_utilitario']=$staff->nombre_activo_utilitario;
				$aux['codigo_activo_utilitario']=$staff->codigo_activo_utilitario;
					//***********************************************************
				$aux['id_activo_clasificacion']=$staff->fkIdActivoClasificacion->id_activo_clasificacion;
				$aux['nombre_activo_clasificacion']=$staff->fkIdActivoClasificacion->nombre_activo_clasificacion;
				$aux['descripcion_activo_clasificacion']=$staff->fkIdActivoClasificacion->descripcion_activo_clasificacion;
				$aux['coeficiente_depreciacion_activo_clasificacion']=$staff->fkIdActivoClasificacion->coeficiente_depreciacion_activo_clasificacion;
				$aux['anos_vida_util_activo_clasificacion']=$staff->fkIdActivoClasificacion->anos_vida_util_activo_clasificacion;
				$aux['codigo_activo_clasificacion']=$staff->fkIdActivoClasificacion->codigo_activo_clasificacion;
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
