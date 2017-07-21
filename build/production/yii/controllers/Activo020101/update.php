<?php
/**
 * Estas son la accion para el controlador "Activo020101".
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
		$model=new Activo020101();
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
						'activo_ubicacion_02_01_03'=>'ActivoUbicacion020103',
						'activo_valor_02_01_03'=>'ActivoValor020103',
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
        					$error.= (!isset($record['id_activo'])) ? "Variable indefinida {id_activo}" : "";
        					$error.= (!isset($record['fk_id_proveedor'])) ? "Variable indefinida {fk_id_proveedor}" : "";
        					$error.= (!isset($record['fk_id_activo_clasificacion'])) ? "Variable indefinida {fk_id_activo_clasificacion}" : "";
        					$error.= (!isset($record['fk_id_activo_utilitario'])) ? "Variable indefinida {fk_id_activo_utilitario}" : "";
        					$error.= (!isset($record['fk_id_unidad'])) ? "Variable indefinida {fk_id_unidad}" : "";
        					$error.= (!isset($record['fk_id_area'])) ? "Variable indefinida {fk_id_area}" : "";
        					$error.= (!isset($record['fk_id_departamento'])) ? "Variable indefinida {fk_id_departamento}" : "";
        					#$error.= (!isset($record['codigo_activo'])) ? "Variable indefinida {codigo_activo}" : "";
        					$error.= (!isset($record['descripcion_activo'])) ? "Variable indefinida {descripcion_activo}" : "";
        					$error.= (!isset($record['piezas_activo'])) ? "Variable indefinida {piezas_activo}" : "";
        					$error.= (!isset($record['fecha_adquisicion_activo'])) ? "Variable indefinida {fecha_adquisicion_activo}" : "";
        					#$error.= (!isset($record['fecha_baja_activo'])) ? "Variable indefinida {fecha_baja_activo}" : "";
        					$error.= (!isset($record['precio_adquisicion_activo'])) ? "Variable indefinida {precio_adquisicion_activo}" : "";
        					$error.= (!isset($record['garantia_meses_activo'])) ? "Variable indefinida {garantia_meses_activo}" : "";
        					$error.= (!isset($record['archivo_foto_activo'])) ? "Variable indefinida {archivo_foto_activo}" : "";
							if ($error=="") {
								$model=Activo020101::model()->findByPk($record['id_activo']);
                               	$audi=new LogSistema030003();
								if ($model!==null) {
        							$model->fk_id_proveedor				= $record['fk_id_proveedor'];
        							$model->fk_id_activo_clasificacion	= $record['fk_id_activo_clasificacion'];
        							$model->fk_id_activo_utilitario		= $record['fk_id_activo_utilitario'];
        							$model->fk_id_unidad				= $record['fk_id_unidad'];
        							$model->fk_id_area					= $record['fk_id_area'];
        							$model->fk_id_departamento			= $record['fk_id_departamento'];
        							$model->codigo_activo				= $record['codigo_activo'];
        							$model->descripcion_activo			= $record['descripcion_activo'];
        							$model->piezas_activo				= $record['piezas_activo'];
        							$model->fecha_adquisicion_activo	= $record['fecha_adquisicion_activo'];
        							#$model->fecha_baja_activo			= $record['fecha_baja_activo'];
        							$model->precio_adquisicion_activo	= $record['precio_adquisicion_activo'];
        							$model->garantia_meses_activo		= $record['garantia_meses_activo'];
        							$model->archivo_foto_activo			= $record['archivo_foto_activo'];
	                            	if ($model->validate()) {
	                                	$model->save();
	                                	$audi->insertAudi("update",$model->tableName(),$record['id_activo']);
	                                	foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
	                                		$t=0;
	                                    	if (is_array($valor) && sizeof($valor)!=0) {
	                                    	
	                                    		if (isset($listaRelaciones[$NomTabRel])) {

		                                        	foreach ($valor as $subvalue) {
		                                        
		                                        		$obj=new $listaRelaciones[$NomTabRel]();
                                                        $audi=new LogSistema030003();
														$listaNomPri=$obj->nombreLlavePrimaria($obj->tableName());
											
														if(isset($subvalue[$listaNomPri[0]['COLUMN_NAME']])) {
															$obj=$listaRelaciones[$NomTabRel]::model()->findByPk($subvalue[$listaNomPri[0]['COLUMN_NAME']]);
														} else {
															$sw=-1; 
															$error="llave primaria indefinida";
														}
														if ($obj!==null) {
															$obj->fk_id_activo=$record['id_activo'];
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
