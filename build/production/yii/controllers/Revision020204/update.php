<?php
/**
 * Estas son la accion para el controlador "Revision020204".
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
		$model=new Revision020204();
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
        					$error.= (!isset($record['id_revision'])) ? "Variable indefinida {id_revision}" : "";
        					$error.= (!isset($record['fecha_inicio_revision'])) ? "Variable indefinida {fecha_inicio_revision}" : "";
        					$error.= (!isset($record['fecha_fin_revision'])) ? "Variable indefinida {fecha_fin_revision}" : "";
        					$error.= (!isset($record['observaciones_revision'])) ? "Variable indefinida {observaciones_revision}" : "";
        					$error.= (!isset($record['descripcion_revision'])) ? "Variable indefinida {descripcion_revision}" : "";
        					$error.= (!isset($record['estado_revision'])) ? "Variable indefinida {estado_revision}" : "";
							if ($error == "") {
								if ($record['estado_revision'] == 1)
									$numfilas=$model->updateAll(array('estado_revision'=>0,'estado_revision=1'));
									
								$model=Revision020204::model()->findByPk($record['id_revision']);							
								$audi=new LogSistema030003();
								if ($model!==null) {
        							$model->fecha_inicio_revision = $record['fecha_inicio_revision'];
        							$model->fecha_fin_revision = $record['fecha_fin_revision'];
        							$model->observaciones_revision = $record['observaciones_revision'];
        							$model->descripcion_revision = $record['descripcion_revision'];
        							$model->estado_revision = $record['estado_revision'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_revision']);
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