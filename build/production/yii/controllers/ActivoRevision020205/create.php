<?php
/**
 * Estas son la accion para el controlador "ActivoRevision020205".
 */

class create extends CAction
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
		$model=new ActivoRevision020205();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
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
                    $model=new ActivoRevision020205();
                    $audi=new LogSistema030003();
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['fk_id_revision'])) ? "Variable indefinida {fk_id_revision}" : "";
        					$error.= (!isset($record['fk_id_activo'])) ? "Variable indefinida {fk_id_activo}" : "";
        					#$error.= (!isset($record['fk_id_activo_estado'])) ? "Variable indefinida {fk_id_activo_estado}" : "";
        					$error.= (!isset($record['fk_id_usuario'])) ? "Variable indefinida {fk_id_usuario}" : "";
        					$error.= (!isset($record['condicion_activo_revision'])) ? "Variable indefinida {condicion_activo_revision}" : "";
							$error.= (!isset($record['fecha_activo_revision'])) ? "Variable indefinida {fecha_activo_revision}" : "";
        					$error.= (!isset($record['observacion_activo_revision'])) ? "Variable indefinida {observacion_activo_revision}" : "";
        					$error.= (!isset($record['estado_activo_revision'])) ? "Variable indefinida {estado_activo_revision}" : "";
							if ($error=="") {
        						$model->fk_id_revision				= $record['fk_id_revision'];
        						$model->fk_id_activo				= $record['fk_id_activo'];
        						#$model->fk_id_activo_estado=$record['fk_id_activo_estado'];
								$model->fk_id_usuario 				= Yii::app()->user->getId();
								$model->condicion_activo_revision	= $record['condicion_activo_revision'];
        						$model->fecha_activo_revision		= $record['fecha_activo_revision'];
        						$model->observacion_activo_revision	= $record['observacion_activo_revision'];
        						$model->estado_activo_revision		= $record['estado_activo_revision'];
	                            if ($model->validate()) {
	                                $model->save();
                                    $audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
	                                $id_tabla_principal=$model->getPrimaryKey();
	                                foreach ($record as $NomTabRel => $valor) {//key=nombre_tabla_atrib , $value=[{},{}] 0 ""
	                                	
	                                    if (is_array($valor) && sizeof($valor)!=0) {
	                                    	
	                                    	if (isset($listaRelaciones[$NomTabRel])) {

		                                        foreach ($valor as $subvalue) {
		                                        
		                                        	$obj=new $listaRelaciones[$NomTabRel]();
                                                    $audi=new LogSistema030003();
													$obj->fk_id_activo_revision=$id_tabla_principal;
		                                            foreach ($subvalue as $key3 => $value3) {
														if($obj->validaCampo($key3)){
						           							if ($key3=="fk_id_activo_revision")
						           								$obj->fk_id_activo_revision=$id_tabla_principal;
						           							else
						           								$obj->$key3=$value3;
						           						}
					       							}
		                                            
                                                    if ($obj->validate()) {
					       								$obj->save();
                                                        $audi->insertAudi("create",$obj->tableName(),$obj->getPrimaryKey());

					       								$sw++;
					       							} else {
					       								$error=$obj->getErrors();
					       							}
		                                        }
		                                    } else {
												$error="variable  indefinida ".$NomTabRel;
		                                    }
										} 
									}//foreach
	                                            
	                                $contValRecords++;
	                            } else {
	                                $error=array_merge(array("Variable idefinida o "),$model->getErrors());
	                            }
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
					$respuesta->meta=array("success"=>"true", "msg"=>"Se creo exitosamente !!!");
					$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			} catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
    }
}





