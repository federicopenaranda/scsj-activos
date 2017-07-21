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
			$model=new LogSistema030003();
            
            if (isset($_GET['query']) && $_GET['query'] != "") {
                	
				$condiQuery = "";
				$filtro = CJSON::decode($_GET['query']);
                foreach ($filtro as $fvalues):
					foreach($fvalues as $fk=>$fv):
						$condiQuery.= $fk." LIKE '%".$fv."%' OR ";
					endforeach;
				endforeach;
				$condiQuery = substr ($condiQuery, 0, -3);
				$modelo = $model::model()->with('fkIdUsuario')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
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
							$modelo=$model::model()->with('fkIdUsuario')->filterTexto($condicion,$valor)->ordenar($condisort,$valorsort)->findAll();
							$total="".sizeof($modelo);	
							$modelo=$model::model()->with('fkIdUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();				
						}
					} else {
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
							$modelo=$model::model()->with('fkIdUsuario')->filterTexto($condicion,$valor)->findAll();
							$total="".sizeof($modelo);
							$modelo=$model::model()->with('fkIdUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
					}
					
				} else {
					if(isset($_GET['sort']) && $_GET['sort']!=''){
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];
						$modelo=$model::model()->with('fkIdUsuario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
					} else {
						$modelo=$model::model()->with('fkIdUsuario')->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
					$total=$model->count();
				}
			}//if query
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_log_sistema']=$staff->id_log_sistema;
				$aux['fk_id_usuario']=$staff->fk_id_usuario;
				$aux['fecha_hora_log_sistema']=$staff->fecha_hora_log_sistema;
				$aux['accion_log_sistema']=$staff->accion_log_sistema;
				$aux['tabla_log_sistema']=$staff->tabla_log_sistema;
				$aux['id_registro_log_sistema']=$staff->id_registro_log_sistema;
					//***********************************************************
				$aux['id_usuario']=$staff->fkIdUsuario->id_usuario;
				$aux['fk_id_area']=$staff->fkIdUsuario->fk_id_area;
				$aux['fk_id_departamento']=$staff->fkIdUsuario->fk_id_departamento;
				$aux['fk_id_cargo']=$staff->fkIdUsuario->fk_id_cargo;
				$aux['primer_nombre_usuario']=$staff->fkIdUsuario->primer_nombre_usuario;
				$aux['segundo_nombre_usuario']=$staff->fkIdUsuario->segundo_nombre_usuario;
				$aux['apellido_paterno_usuario']=$staff->fkIdUsuario->apellido_paterno_usuario;
				$aux['apellido_materno_usuario']=$staff->fkIdUsuario->apellido_materno_usuario;
				$aux['login_usuario']=$staff->fkIdUsuario->login_usuario;
				$aux['contrasena_usuario']=$staff->fkIdUsuario->contrasena_usuario;
				$aux['sexo_usuario']=$staff->fkIdUsuario->sexo_usuario;
				$aux['telefono_usuario']=$staff->fkIdUsuario->telefono_usuario;
				$aux['celular_usuario']=$staff->fkIdUsuario->celular_usuario;
				$aux['correo_usuario']=$staff->fkIdUsuario->correo_usuario;
				$aux['direccion_usuario']=$staff->fkIdUsuario->direccion_usuario;
				$aux['imagen_usuario']=$staff->fkIdUsuario->imagen_usuario;
				$aux['observaciones_usuario']=$staff->fkIdUsuario->observaciones_usuario;
				$aux['fecha_creacion_usuario']=$staff->fkIdUsuario->fecha_creacion_usuario;
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
