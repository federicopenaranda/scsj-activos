<?php
/**
 * Estas son la accion para el controlador "UsuarioPrivilegio000004".
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
		$model=new UsuarioPrivilegio000004();
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
        					$error.= (!isset($record['id_usuario_privilegio'])) ? "Variable indefinida {id_usuario_privilegio}" : "";
        					$error.= (!isset($record['nombre_privilegio_usuario_privilegio'])) ? "Variable indefinida {nombre_privilegio_usuario_privilegio}" : "";
        					$error.= (!isset($record['accion_usuario_privilegio'])) ? "Variable indefinida {accion_usuario_privilegio}" : "";
        					$error.= (!isset($record['opciones_usuario_privilegio'])) ? "Variable indefinida {opciones_usuario_privilegio}" : "";
        					$error.= (!isset($record['funcion_usuario_privilegio'])) ? "Variable indefinida {funcion_usuario_privilegio}" : "";
        					$error.= (!isset($record['descripcion_usuario_privilegio'])) ? "Variable indefinida {descripcion_usuario_privilegio}" : "";
							if ($error == "") {
								$model=UsuarioPrivilegio000004::model()->findByPk($record['id_usuario_privilegio']);							
								$audi=new LogSistema030003();
								if ($model!==null) {
        							$model->nombre_privilegio_usuario_privilegio = $record['nombre_privilegio_usuario_privilegio'];
        							$model->accion_usuario_privilegio = $record['accion_usuario_privilegio'];
        							$model->opciones_usuario_privilegio = $record['opciones_usuario_privilegio'];
        							$model->funcion_usuario_privilegio = $record['funcion_usuario_privilegio'];
        							$model->descripcion_usuario_privilegio = $record['descripcion_usuario_privilegio'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_usuario_privilegio']);
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
