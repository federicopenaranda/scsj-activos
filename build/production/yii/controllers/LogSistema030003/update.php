<?php
/**
 * Estas son la accion para el controlador "LogSistema030003".
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
		$model=new LogSistema030003();
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
        					$error.= (!isset($record['id_log_sistema'])) ? "Variable indefinida {id_log_sistema}" : "";
        					$error.= (!isset($record['fk_id_usuario'])) ? "Variable indefinida {fk_id_usuario}" : "";
        					$error.= (!isset($record['fecha_hora_log_sistema'])) ? "Variable indefinida {fecha_hora_log_sistema}" : "";
        					$error.= (!isset($record['accion_log_sistema'])) ? "Variable indefinida {accion_log_sistema}" : "";
        					$error.= (!isset($record['tabla_log_sistema'])) ? "Variable indefinida {tabla_log_sistema}" : "";
        					$error.= (!isset($record['id_registro_log_sistema'])) ? "Variable indefinida {id_registro_log_sistema}" : "";
							if ($error == "") {
								$model=LogSistema030003::model()->findByPk($record['id_log_sistema']);							
								$audi=new LogSistema030003();
								if ($model!==null) {
									$model->fk_id_usuario = Yii::app()->user->getId();
        							$model->fecha_hora_log_sistema = $record['fecha_hora_log_sistema'];
        							$model->accion_log_sistema = $record['accion_log_sistema'];
        							$model->tabla_log_sistema = $record['tabla_log_sistema'];
        							$model->id_registro_log_sistema = $record['id_registro_log_sistema'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_log_sistema']);
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
