<?php
/**
 * Estas son la accion para el controlador "ActivoRevision020205".
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
					
					$error="";
                	$sw=0;
                    $contValRecords=0;
					$bandera=0;
					$objAcEn=new ActivoEntrega020103();
					$record=CJSON::decode(urldecode($listaRecord));

                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try {
        					$error.= (!isset($record['id_activo_revision'])) ? "Variable indefinida {id_activo_revision}" : "";
        					$error.= (!isset($record['fk_id_revision'])) ? "Variable indefinida {fk_id_revision}" : "";
        					$error.= (!isset($record['fk_id_activo'])) ? "Variable indefinida {fk_id_activo}" : "";
        					$error.= (!isset($record['fk_id_activo_estado'])) ? "Variable indefinida {fk_id_activo_estado}" : "";
        					$error.= (!isset($record['fk_id_usuario'])) ? "Variable indefinida {fk_id_usuario}" : "";
        					$error.= (!isset($record['fecha_activo_revision'])) ? "Variable indefinida {fecha_activo_revision}" : "";
        					$error.= (!isset($record['observacion_activo_revision'])) ? "Variable indefinida {observacion_activo_revision}" : "";
        					$error.= (!isset($record['estado_activo_revision'])) ? "Variable indefinida {estado_activo_revision}" : "";
							#$error.= (!isset($record['fk_id_usuario_recibio'])) ? "Variable indefinida {fk_id_usuario_recibio}" : "";
							if ($error=="") {
								
								$model=ActivoRevision020205::model()->findByPk($record['id_activo_revision']);
                               	$audi=new LogSistema030003();
								
								if ($model!==null) {
        							$model->fk_id_revision				=$record['fk_id_revision'];
        							$model->fk_id_activo				=$record['fk_id_activo'];
        							$model->fk_id_activo_estado			=$record['fk_id_activo_estado'];
									$model->fk_id_usuario 				= Yii::app()->user->getId();
        							$model->fecha_activo_revision		=$record['fecha_activo_revision'];
        							$model->observacion_activo_revision	=$record['observacion_activo_revision'];
        							$model->estado_activo_revision		=$record['estado_activo_revision'];
	                            	
									if ($model->validate()) {
	                                	$model->save();
	                                	$audi->insertAudi("update",$model->tableName(),$record['id_activo_revision']);
										
										$idUre = $record['fk_id_usuario_recibio'];
										$idAct = $record['fk_id_activo'];

										if($idUre !==NULL){
	                                		$modAcEnt=ActivoEntrega020103::model()->findAll(array('condition'=>'fk_id_usuario_entrego = :idUre AND fk_id_activo = :idAct AND estado_activo_entrega = 1','params'=>array(':idUre'=>$idUre,':idAct'=>$idAct)));
											$bandera=1;
										}
							
										if (!$modAcEnt and $bandera==1 ){
											$objAcEn->fk_id_activo 				= $record['fk_id_activo'];
											$objAcEn->fk_id_usuario_recibio 	= $record['fk_id_usuario_recibio'];
											$objAcEn->fk_id_usuario_entrego 	= Yii::app()->user->getId();
											$objAcEn->fecha_activo_entrega		= date('Y-m-d');
											$objAcEn->estado_activo_entrega		= 1;
											if ($objAcEn->validate()) {
												$objAcEn->save();
												$audi=new LogSistema030003();
												$audi->insertAudi("update",$objAcEn->tableName(),$objAcEn->getPrimaryKey());
												$sw=1;
											} else {
												$error = $model->getErrors();
											}
										}
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
                   if($error==""){
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
