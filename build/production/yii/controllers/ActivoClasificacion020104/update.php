<?php
/**
 * Estas son la accion para el controlador "ActivoClasificacion020104".
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
		$model=new ActivoClasificacion020104();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
			$contValRecords=0;
			$transaction=$model->dbConnection->beginTransaction();
            try {
				foreach ($listaRecords as $listaRecord) {
					$record=CJSON::decode(urldecode($listaRecord));
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['id_activo_clasificacion'])) ? "Variable indefinida {id_activo_clasificacion}" : "";
        					$error.= (!isset($record['nombre_activo_clasificacion'])) ? "Variable indefinida {nombre_activo_clasificacion}" : "";
        					$error.= (!isset($record['descripcion_activo_clasificacion'])) ? "Variable indefinida {descripcion_activo_clasificacion}" : "";
        					$error.= (!isset($record['coeficiente_depreciacion_activo_clasificacion'])) ? "Variable indefinida {coeficiente_depreciacion_activo_clasificacion}" : "";
        					$error.= (!isset($record['anos_vida_util_activo_clasificacion'])) ? "Variable indefinida {anos_vida_util_activo_clasificacion}" : "";
        					$error.= (!isset($record['codigo_activo_clasificacion'])) ? "Variable indefinida {codigo_activo_clasificacion}" : "";
							if ($error == "") {
								$model=ActivoClasificacion020104::model()->findByPk($record['id_activo_clasificacion']);							
								$audi=new LogSistema030003();
								if ($model!==null) {
        							$model->nombre_activo_clasificacion = $record['nombre_activo_clasificacion'];
        							$model->descripcion_activo_clasificacion = $record['descripcion_activo_clasificacion'];
        							$model->coeficiente_depreciacion_activo_clasificacion = $record['coeficiente_depreciacion_activo_clasificacion'];
        							$model->anos_vida_util_activo_clasificacion = $record['anos_vida_util_activo_clasificacion'];
        							$model->codigo_activo_clasificacion = $record['codigo_activo_clasificacion'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_activo_clasificacion']);
		                                $contValRecords++;
		                            } else {
		                                $error=array_merge(array("Variable idefinida o "),$model->getErrors());
		                            }
		                        } else {
									$error="Registro no encontrado";
								}
	                        }
                        } catch(Exception $e) {
							$error=$e->getMessage();
						}
                    } else {
                        $error="Error de json";
                    }
				}
                if ($contValRecords == $numeroRecords) {
                    $transaction->commit();
					$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
                } else {
                    $transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
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
