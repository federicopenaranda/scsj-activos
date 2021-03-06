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
			$model=new UsuarioPrivilegio000004();
			
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
					$aux['id_usuario_privilegio']=$staff->id_usuario_privilegio;
					$aux['nombre_privilegio_usuario_privilegio']=$staff->nombre_privilegio_usuario_privilegio;
					$aux['accion_usuario_privilegio']=$staff->accion_usuario_privilegio;
					$aux['opciones_usuario_privilegio']=$staff->opciones_usuario_privilegio;
					$aux['funcion_usuario_privilegio']=$staff->funcion_usuario_privilegio;
					$aux['descripcion_usuario_privilegio']=$staff->descripcion_usuario_privilegio;
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
