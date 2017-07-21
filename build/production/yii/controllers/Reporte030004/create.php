<?php
/**
 * Estas son la accion para el controlador "Reporte030004".
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
		$respuesta = new stdClass();
		$model = new Reporte030004();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback = $_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
			$contValRecords=0;
			$transaction=$model->dbConnection->beginTransaction();
            try {
				foreach ($listaRecords as $listaRecord) {
					$record=CJSON::decode(urldecode($listaRecord));
                    $model=new Reporte030004();
                    $audi=new LogSistema030003();
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['codigo_reporte'])) ? "Variable indefinida {codigo_reporte}" : "";
        					$error.= (!isset($record['nombre_reporte'])) ? "Variable indefinida {nombre_reporte}" : "";
        					$error.= (!isset($record['descripcion_reporte'])) ? "Variable indefinida {descripcion_reporte}" : "";
        					$error.= (!isset($record['estado_reporte'])) ? "Variable indefinida {estado_reporte}" : "";
        					$error.= (!isset($record['ruta_reporte'])) ? "Variable indefinida {ruta_reporte}" : "";
        					$error.= (!isset($record['tipo_reporte'])) ? "Variable indefinida {tipo_reporte}" : "";
							if ($error=="") {
        						$model->codigo_reporte = $record['codigo_reporte'];
        						$model->nombre_reporte = $record['nombre_reporte'];
        						$model->descripcion_reporte = $record['descripcion_reporte'];
        						$model->estado_reporte = $record['estado_reporte'];
        						$model->ruta_reporte = $record['ruta_reporte'];
        						$model->tipo_reporte = $record['tipo_reporte'];
	                            if ($model->validate()) {
	                                $model->save();
                                    $audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
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
				}
                if ($contValRecords == $numeroRecords) {
                    $transaction->commit();
                    $respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
                    $controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
                } else {
                    $transaction->rollback();
                    $respuesta->meta=array("success"=>"false","msg"=>$error);
                    $controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
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




