<?php
/**
 * Estas son la accion para el controlador "Usuario000101".
 */

class update extends CAction
{
    /**
    * La funcion run ejecuta la logica de la accion
    * Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
    * @param array $callback se introduce el nombre de una funcion
    */
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new Usuario000101();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
						'activo_entrega_02_01_03'=>'ActivoEntrega020103',
						'usuario_unidad_00_01_02'=>'UsuarioUnidad000102',
						'usuario_tipo_usuario_00_01_02'=>'UsuarioTipoUsuario000102'
								);
            foreach ($listaRecords as $value) {
				
				$TotalEleVectores=0;
				#$records=json_decode($value);
                 $records=CJSON::decode(urldecode($value));
				foreach ($records as $propiedad => $valor) {
					
					if (is_array($valor)){
						
						$TotalEleVectores+=sizeof($valor);
					} 
				}
				$ListaTotalEleVec[]=$TotalEleVectores;
			}
			
			$NumVal=0;
			$i=0;
			$transaction=$model->dbConnection->beginTransaction();
            try {
				foreach ($listaRecords as $listaRecord) {
                	$sw=0;
                    $contValRecords=0;
					$record=CJSON::decode(urldecode($listaRecord));
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['id_usuario'])) ? "Variable indefinida {id_usuario}" : "";
        					#$error.= (!isset($record['fk_id_area'])) ? "Variable indefinida {fk_id_area}" : "";
        					#$error.= (!isset($record['fk_id_departamento'])) ? "Variable indefinida {fk_id_departamento}" : "";
        					#$error.= (!isset($record['fk_id_cargo'])) ? "Variable indefinida {fk_id_cargo}" : "";
        					$error.= (!isset($record['primer_nombre_usuario'])) ? "Variable indefinida {primer_nombre_usuario}" : "";
        					$error.= (!isset($record['segundo_nombre_usuario'])) ? "Variable indefinida {segundo_nombre_usuario}" : "";
        					$error.= (!isset($record['apellido_paterno_usuario'])) ? "Variable indefinida {apellido_paterno_usuario}" : "";
        					$error.= (!isset($record['apellido_materno_usuario'])) ? "Variable indefinida {apellido_materno_usuario}" : "";
        					$error.= (!isset($record['login_usuario'])) ? "Variable indefinida {login_usuario}" : "";
        					$error.= (!isset($record['contrasena_usuario'])) ? "Variable indefinida {contrasena_usuario}" : "";
        					$error.= (!isset($record['sexo_usuario'])) ? "Variable indefinida {sexo_usuario}" : "";
        					$error.= (!isset($record['telefono_usuario'])) ? "Variable indefinida {telefono_usuario}" : "";
        					$error.= (!isset($record['celular_usuario'])) ? "Variable indefinida {celular_usuario}" : "";
        					$error.= (!isset($record['correo_usuario'])) ? "Variable indefinida {correo_usuario}" : "";
        					$error.= (!isset($record['direccion_usuario'])) ? "Variable indefinida {direccion_usuario}" : "";
        					$error.= (!isset($record['imagen_usuario'])) ? "Variable indefinida {imagen_usuario}" : "";
        					$error.= (!isset($record['observaciones_usuario'])) ? "Variable indefinida {observaciones_usuario}" : "";
							if ($error=="") {
								$model=Usuario000101::model()->findByPk($record['id_usuario']);
                               	$audi=new LogSistema030003();
								
								if ($model!==null) {
        							$model->fk_id_area=$record['fk_id_area'];
        							$model->fk_id_departamento=$record['fk_id_departamento'];
        							$model->fk_id_cargo=$record['fk_id_cargo'];
        							$model->primer_nombre_usuario=$record['primer_nombre_usuario'];
        							$model->segundo_nombre_usuario=$record['segundo_nombre_usuario'];
        							$model->apellido_paterno_usuario=$record['apellido_paterno_usuario'];
        							$model->apellido_materno_usuario=$record['apellido_materno_usuario'];
        							$model->login_usuario=$record['login_usuario'];
        							$model->contrasena_usuario=$record['contrasena_usuario'];
        							$model->sexo_usuario=$record['sexo_usuario'];
        							$model->telefono_usuario=$record['telefono_usuario'];
        							$model->celular_usuario=$record['celular_usuario'];
        							$model->correo_usuario=$record['correo_usuario'];
        							$model->direccion_usuario=$record['direccion_usuario'];
        							$model->imagen_usuario=$record['imagen_usuario'];
        							$model->observaciones_usuario=$record['observaciones_usuario'];
	                            	if ($model->validate()) {
	                                	$model->save();
	                                	$audi->insertAudi("update",$model->tableName(),$record['id_usuario']);
	                                	foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
	                                		$t=0;
	                                    	if (is_array($valor) && sizeof($valor)!=0) {
	                                    		
	                                    		if (isset($listaRelaciones[$NomTabRel])) {
													
		                                        	switch ($NomTabRel) {
														case 'usuario_tipo_usuario_00_01_02':
															UsuarioTipoUsuario000102::model()->deleteAll('fk_id_usuario = '.$record['id_usuario']);
														break;
														case 'usuario_unidad_00_01_02':
															UsuarioUnidad000102::model()->deleteAll('fk_id_usuario = '.$record['id_usuario']);
													}
													
													foreach ($valor as $subvalue) {
		                                        
		                                        		$obj=new $listaRelaciones[$NomTabRel]();
                                                        $audi=new LogSistema030003();
														$listaNomPri=$obj->nombreLlavePrimaria($obj->tableName());
														
														if ($obj!==null) {
															$obj->fk_id_usuario=$record['id_usuario'];
															foreach ($subvalue as $key3 => $value3) {
																if ($obj->validaCampo($key3)) {
										           					$obj->$key3=$value3;
										           				}
								       						}
								       						if ($obj->validate()) {
										       					$obj->save();
                                                               	$audi->insertAudi("update",$obj->tableName(),$subvalue[$listaNomPri[0]['COLUMN_NAME']]);
										       					$sw++;
										       				} else {
										       					$error=$obj->getErrors();
										       				}
														}
														else {
															$error="id fuera de rango";
														}
													}//foreach
		                                    	} else {
		                                    		$error="variable  indefinida ".$NomTabRel;
		                                    	}
											} 
										}//foreach        
	                                	$contValRecords++;
	                            	} else {
	                                	$error=array_merge(array("Variable idefinida o "),$model->getErrors());
	                            	}
	                            } else {
									$error="Registro no encontrado";
								}//if
	                        } 
                        } catch(Exception $e) {
							$error=$e->getMessage();
						}
                    } else {
                        $error="Error de json";
                    }
                    if ($sw+$contValRecords == $ListaTotalEleVec[$i]+1) {
						$NumVal++;
					} 
					$i++;
				}//foreach
                if ($NumVal == $numeroRecords) {
					$transaction->commit();
					$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderPartial('update',array('model'=>$respuesta,'callback'=>$callback));
				}
			} catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
    }
}
