<?php
/**
 * Estas son la accion para el controlador "ActivoProveedor020104".
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
		$model=new ActivoProveedor020104();
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
        					$error.= (!isset($record['id_activo_proveedor'])) ? "Variable indefinida {id_activo_proveedor}" : "";
        					$error.= (!isset($record['nombre_activo_proveedor'])) ? "Variable indefinida {nombre_activo_proveedor}" : "";
        					$error.= (!isset($record['nit_activo_proveedor'])) ? "Variable indefinida {nit_activo_proveedor}" : "";
        					$error.= (!isset($record['direccion_activo_proveedor'])) ? "Variable indefinida {direccion_activo_proveedor}" : "";
        					$error.= (!isset($record['observaciones_activo_proveedor'])) ? "Variable indefinida {observaciones_activo_proveedor}" : "";
        					$error.= (!isset($record['telefono1_activo_proveedor'])) ? "Variable indefinida {telefono1_activo_proveedor}" : "";
        					$error.= (!isset($record['telefono2_activo_proveedor'])) ? "Variable indefinida {telefono2_activo_proveedor}" : "";
							if ($error == "") {
								$model=ActivoProveedor020104::model()->findByPk($record['id_activo_proveedor']);							
								$audi=new LogSistema030003();
								if ($model!==null) {
        							$model->nombre_activo_proveedor = $record['nombre_activo_proveedor'];
        							$model->nit_activo_proveedor = $record['nit_activo_proveedor'];
        							$model->direccion_activo_proveedor = $record['direccion_activo_proveedor'];
        							$model->observaciones_activo_proveedor = $record['observaciones_activo_proveedor'];
        							$model->telefono1_activo_proveedor = $record['telefono1_activo_proveedor'];
        							$model->telefono2_activo_proveedor = $record['telefono2_activo_proveedor'];
		                            if ($model->validate()) {
		                                $model->save();
                                        $audi->insertAudi("update",$model->tableName(),$record['id_activo_proveedor']);
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
