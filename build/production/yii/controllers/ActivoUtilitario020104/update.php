<?php
/**
 * Estas son la accion para el controlador "ActivoUtilitario020104".
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
		$model=new ActivoUtilitario020104();
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
        					$error.= (!isset($record['id_activo_utilitario'])) ? "Variable indefinida {id_activo_utilitario}" : "";
        					$error.= (!isset($record['fk_id_activo_clasificacion'])) ? "Variable indefinida {fk_id_activo_clasificacion}" : "";
        					$error.= (!isset($record['nombre_activo_utilitario'])) ? "Variable indefinida {nombre_activo_utilitario}" : "";
        					$error.= (!isset($record['codigo_activo_utilitario'])) ? "Variable indefinida {codigo_activo_utilitario}" : "";
							if ($error == "") {
								$model=ActivoUtilitario020104::model()->findByPk($record['id_activo_utilitario']);							
								$audi=new LogSistema030003();
								if ($model!==null) {
        							$model->fk_id_activo_clasificacion = $record['fk_id_activo_clasificacion'];
        							$model->nombre_activo_utilitario = $record['nombre_activo_utilitario'];
        							$model->codigo_activo_utilitario = $record['codigo_activo_utilitario'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_activo_utilitario']);
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