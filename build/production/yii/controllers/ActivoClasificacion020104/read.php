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
			$model=new ActivoClasificacion020104();
			
            try {
            	if (isset($_GET['query']) && $_GET['query'] != "") {
                	
                    $condiQuery = "";
					$filtro = CJSON::decode($_GET['query']);
                    foreach ($filtro as $fvalues):
                        foreach($fvalues as $fk=>$fv):
                            $condiQuery.= $fk." LIKE '%".$fv."%' OR ";
                        endforeach;
                    endforeach;
                    $condiQuery = substr ($condiQuery, 0, -3);
                    $modelo = $model::model()->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
                    $total = sizeof($modelo);
                 } else {

                    if (isset($_GET['filter']) && $_GET['filter']!='') {
                        $filtro=CJSON::decode($_GET['filter']);
                        if (isset($_GET['sort']) && $_GET['sort']!='') {		
                            $sort=CJSON::decode($_GET['sort']);
                            $condisort=isset($sort[0]['property']) ? $sort[0]['property'] : "";
                            $valorsort=isset($sort[0]['direction']) ? $sort[0]['direction'] :"error";
                            foreach ($filtro as $parametro) {
                                $condicion=isset($parametro['property']) ? $parametro['property'] : "" ;
                                $valor=isset($parametro['value']) ? $parametro['value'] : "error" ;
                                $modelo=$model::model()->filterTexto($condicion,$valor)->ordenar($condisort,$valorsort)->findAll();
								$total="".sizeof($modelo);
								$modelo=$model::model()->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
                            }
                        } else {
                            foreach ($filtro as $parametro) {
                                $condicion=isset($parametro['property']) ? $parametro['property'] : "" ;
                                $valor=isset($parametro['value']) ? $parametro['value'] : "error" ;
                                $modelo=$model::model()->filterTexto($condicion,$valor)->findAll();
								$total="".sizeof($modelo);
								$modelo=$model::model()->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
                            }
                        }
                        
                    } else {
                        if (isset($_GET['sort']) && $_GET['sort']!=''){
                            $sort=CJSON::decode($_GET['sort']);
                            $condisort=isset($sort[0]['property']) ? $sort[0]['property'] : "";
                            $valorsort=isset($sort[0]['direction']) ? $sort[0]['direction'] :"error";
                            $modelo=$model->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
                        } else {
                            $modelo=$model->pagina($_GET['limit'],$_GET['start'])->findAll();
                        }
                        $total=$model->count();
                    }
				}//if query
                $arreglo=array();
				foreach($modelo as $staff) {
                	$aux=array();
					$aux['id_activo_clasificacion']=$staff->id_activo_clasificacion;
					$aux['nombre_activo_clasificacion']=$staff->nombre_activo_clasificacion;
					$aux['descripcion_activo_clasificacion']=$staff->descripcion_activo_clasificacion;
					$aux['coeficiente_depreciacion_activo_clasificacion']=$staff->coeficiente_depreciacion_activo_clasificacion;
					$aux['anos_vida_util_activo_clasificacion']=$staff->anos_vida_util_activo_clasificacion;
					$aux['codigo_activo_clasificacion']=$staff->codigo_activo_clasificacion;
					$arreglo[]=$aux;
				}
			} catch(Exception $e) {
				$error=$e->getMessage();
			}
			if ($error=="") {
				$respuesta->registros=$arreglo;	
				$respuesta->total=$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>$error);
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
