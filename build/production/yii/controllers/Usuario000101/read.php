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
			$model=new Usuario000101();
			
            if (isset($_GET['query']) && $_GET['query'] != "") {
                	
				$condiQuery = "";
				$filtro = CJSON::decode($_GET['query']);
                foreach ($filtro as $fvalues):
					foreach($fvalues as $fk=>$fv):
						$condiQuery.= $fk." LIKE '%".$fv."%' OR ";
					endforeach;
				endforeach;
				$condiQuery = substr ($condiQuery, 0, -3);
				$modelo = $model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->findAll(array("condition"=>$condiQuery,"offset"=>$_GET['start'],"limit" => $_GET['limit']));
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
							if ($condicion == "fk_id_area" || 
								$condicion == "fk_id_departamento" || 
								$condicion == "fk_id_cargo"
								) {
								$modelo=$model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->filterTextoInt($condicion,$valor)->ordenar($condisort,$valorsort)->findAll();
								$total="".sizeof($modelo);
								$modelo=$model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							} else {
								$modelo=$model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->filterTexto($condicion,$valor)->ordenar($condisort,$valorsort)->findAll();
								$total="".sizeof($modelo);
                            	$modelo=$model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							}
                        }
                    }else{
                        foreach ($filtro as $parametro) {
                            $condicion=$parametro['property'];
                            $valor=$parametro['value'];
							if ($condicion == "fk_id_area" || 
								$condicion == "fk_id_departamento" || 
								$condicion == "fk_id_cargo"
								) {
								$modelo=$model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->filterTextoInt($condicion,$valor)->findAll();
								$total="".sizeof($modelo);
								$modelo=$model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->filterTextoInt($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							} else {
								$modelo = $model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->filterTexto($condicion,$valor)->findAll();
								$total="".sizeof($modelo);
                            	$modelo=$model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
							}
                        }
                    }
                    
                } else {
                    if(isset($_GET['sort']) && $_GET['sort']!=''){
                        $sort=CJSON::decode($_GET['sort']);
                        $condisort=$sort[0]['property'];
                        $valorsort=$sort[0]['direction'];	
                        $modelo=$model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
                    } else {
                        $modelo=$model::model()->with('fkIdArea','fkIdCargo','fkIdDepartamento')->pagina($_GET['limit'],$_GET['start'])->findAll();
                    }
                    $total=$model->count();
                }
			}//if query
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
				$aux['id_usuario']=$staff->id_usuario;
				$aux['fk_id_area']=$staff->fk_id_area;
				$aux['fk_id_departamento']=$staff->fk_id_departamento;
				$aux['fk_id_cargo']=$staff->fk_id_cargo;
				$aux['primer_nombre_usuario']=$staff->primer_nombre_usuario;
				$aux['segundo_nombre_usuario']=$staff->segundo_nombre_usuario;
				$aux['apellido_paterno_usuario']=$staff->apellido_paterno_usuario;
				$aux['apellido_materno_usuario']=$staff->apellido_materno_usuario;
				$aux['login_usuario']=$staff->login_usuario;
				#$aux['contrasena_usuario']=$staff->contrasena_usuario;
				$aux['sexo_usuario']=$staff->sexo_usuario;
				$aux['telefono_usuario']=$staff->telefono_usuario;
				$aux['celular_usuario']=$staff->celular_usuario;
				$aux['correo_usuario']=$staff->correo_usuario;
				$aux['direccion_usuario']=$staff->direccion_usuario;
				$aux['imagen_usuario']=$staff->imagen_usuario;
				$aux['observaciones_usuario']=$staff->observaciones_usuario;
				$aux['fecha_creacion_usuario']=$staff->fecha_creacion_usuario;
				//***********************************************************
				$aux['id_area']=$staff->fkIdArea->id_area;
				$aux['nombre_area']=$staff->fkIdArea->nombre_area;
				$aux['codigo_area']=$staff->fkIdArea->codigo_area;
				$aux['descripcion_area']=$staff->fkIdArea->descripcion_area;
				//**********************************************************
				$aux['id_cargo']=$staff->fkIdCargo->id_cargo;
				$aux['nombre_cargo']=$staff->fkIdCargo->nombre_cargo;
				$aux['descripcion_cargo']=$staff->fkIdCargo->descripcion_cargo;
				//**********************************************************
				$aux['id_departamento']=$staff->fkIdDepartamento->id_departamento;
				$aux['nombre_departamento']=$staff->fkIdDepartamento->nombre_departamento;
				$aux['codigo_departamento']=$staff->fkIdDepartamento->codigo_departamento;
				$aux['descripcion_departamento']=$staff->fkIdDepartamento->descripcion_departamento;
				
				$aux2=array();
				foreach($staff->usuarioTipoUsuarios as $va) {
					$aux2[]=$va->fk_id_usuario_tipo;
				}
				$aux['usuario_tipo_usuario_00_01_02']=$aux2;
				
				$aux2=array();
				foreach($staff->usuarioUnidad000102s as $va) {
					$aux2[]=$va->fk_id_unidad;
				}
				$aux['usuario_unidad_00_01_02']	= $aux2;
				#print_r($staff->usuarioUnidad000102s);
				#$aux2=array();
				#foreach($staff->activoEstado as $va) {
					#$aux2[]=$va->nombre_activo_estado;
				#}
				#$aux['activo_estado']=$aux2;
				
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
