<?php
/**
 * Estas son la accion para el controlador "ActivoEntrega020103".
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
		$model=new ActivoEntrega020103();
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
        					$error.= (!isset($record['id_activo_entrega'])) ? "Variable indefinida {id_activo_entrega}" : "";
        					$error.= (!isset($record['fk_id_activo'])) ? "Variable indefinida {fk_id_activo}" : "";
        					$error.= (!isset($record['fk_id_usuario_recibio'])) ? "Variable indefinida {fk_id_usuario_recibio}" : "";
        					$error.= (!isset($record['fk_id_usuario_entrego'])) ? "Variable indefinida {fk_id_usuario_entrego}" : "";
        					$error.= (!isset($record['fecha_activo_entrega'])) ? "Variable indefinida {fecha_activo_entrega}" : "";
        					$error.= (!isset($record['estado_activo_entrega'])) ? "Variable indefinida {estado_activo_entrega}" : "";
							if ($error == "") {
								$model=ActivoEntrega020103::model()->findByPk($record['id_activo_entrega']);							
								$audi=new LogSistema030003();
								if ($model!==null) {
        							$model->fk_id_activo = $record['fk_id_activo'];
        							$model->fk_id_usuario_recibio = $record['fk_id_usuario_recibio'];
        							$model->fk_id_usuario_entrego = $record['fk_id_usuario_entrego'];
        							$model->fecha_activo_entrega = $record['fecha_activo_entrega'];
        							$model->estado_activo_entrega = $record['estado_activo_entrega'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_activo_entrega']);
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
