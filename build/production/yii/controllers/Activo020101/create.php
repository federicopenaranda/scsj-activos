<?php
/**
 * Estas son la accion para el controlador "Activo020101".
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
		$model=new Activo020101();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        
        if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
            $listaRelaciones=array(
						'activo_entrega_02_01_03'=>'ActivoEntrega020103',
						'activo_ubicacion_02_01_03'=>'ActivoUbicacion020103',
						'activo_valor_02_01_03'=>'ActivoValor020103',
								);
            foreach ($listaRecords as $value) {
				
				$TotalEleVectores=0;
				#$records=json_decode($value);
                $records=CJSON::decode(urldecode($value));
				foreach ($records as $propiedad => $valor) {

					if ($propiedad == "cantidad_activo") {
						$cantidad=$valor;
					}
					if (is_array($valor)){
						
						$TotalEleVectores+=sizeof($valor);
					} 
				}
				$ListaTotalEleVec[]=$TotalEleVectores;
			}
			$cantidad = $cantidad==0 || $cantidad==""? 1: $cantidad;
			
			$NumVal=0;
			$i=0;
			$transaction=$model->dbConnection->beginTransaction();
            try {
				foreach ($listaRecords as $listaRecord) {
                	$sw=0;
                    $contValRecords=0;
					$record=CJSON::decode(urldecode($listaRecord));
                    $model=new Activo020101();
                    $audi=new LogSistema030003();
                    if (json_last_error() === JSON_ERROR_NONE) {
                    	try{
        					$error.= (!isset($record['fk_id_proveedor'])) ? "Variable indefinida {fk_id_proveedor}" : "";
        					$error.= (!isset($record['fk_id_activo_clasificacion'])) ? "Variable indefinida {fk_id_activo_clasificacion}" : "";
        					$error.= (!isset($record['fk_id_activo_utilitario'])) ? "Variable indefinida {fk_id_activo_utilitario}" : "";
        					$error.= (!isset($record['fk_id_unidad'])) ? "Variable indefinida {fk_id_unidad}" : "";
        					$error.= (!isset($record['fk_id_area'])) ? "Variable indefinida {fk_id_area}" : "";
        					$error.= (!isset($record['fk_id_departamento'])) ? "Variable indefinida {fk_id_departamento}" : "";
        					#$error.= (!isset($record['codigo_activo'])) ? "Variable indefinida {codigo_activo}" : "";
        					$error.= (!isset($record['descripcion_activo'])) ? "Variable indefinida {descripcion_activo}" : "";
        					$error.= (!isset($record['piezas_activo'])) ? "Variable indefinida {piezas_activo}" : "";
        					$error.= (!isset($record['fecha_adquisicion_activo'])) ? "Variable indefinida {fecha_adquisicion_activo}" : "";
        					#$error.= (!isset($record['fecha_baja_activo'])) ? "Variable indefinida {fecha_baja_activo}" : "";
        					$error.= (!isset($record['precio_adquisicion_activo'])) ? "Variable indefinida {precio_adquisicion_activo}" : "";
        					$error.= (!isset($record['garantia_meses_activo'])) ? "Variable indefinida {garantia_meses_activo}" : "";
        					$error.= (!isset($record['archivo_foto_activo'])) ? "Variable indefinida {archivo_foto_activo}" : "";
							
							$objUnidad	 		= new Unidad010004();
							$subUnidad 			= $objUnidad::model()->find(array('condition'=>'id_unidad = '.$record['fk_id_unidad']));
							$objArea 			= new Area010004();
							$subArea 			= $objArea::model()->find(array('condition'=>'id_area = '.$record['fk_id_area']));
							$objDepartamento 	= new Departamento010004();
							$subDepartamento 	= $objDepartamento::model()->find(array('condition'=>'id_departamento = '.$record['fk_id_departamento']));
							$objClasificacion 	= new ActivoClasificacion020104();
							$subClasificacion 	= $objClasificacion::model()->find(array('condition'=>'id_activo_clasificacion = '.$record['fk_id_activo_clasificacion']));
							$objUtilitario 		= new ActivoUtilitario020104();
							$subUtilitario 		= $objUtilitario::model()->find(array('condition'=>'id_activo_utilitario = '.$record['fk_id_activo_utilitario']));
							for ($j=0; $j < $cantidad; $j++) {
								
								$model=new Activo020101();
								$res = Activo020101::model()->findAll();
								$may=0;
								foreach($res as $r):
									if( substr($r->codigo_activo,-3) > $may)
										$may = substr($r->codigo_activo,-3);
								endforeach;
								$cod = $may+1;
								switch(strlen($cod)){
									case 1;
										$cod = "00".$cod;
									break;
									case 2:
										$cod = "0".$cod;
									break;
									case 3:
										$cod= $cod;
									break;
								}
								$codigo = $subUnidad->codigo_unidad."".$subArea->codigo_area."".$subDepartamento->codigo_departamento."".$subClasificacion->codigo_activo_clasificacion."".$subUtilitario->codigo_activo_utilitario."".$cod;
								
								if ($error=="") {
									$model->fk_id_proveedor				=$record['fk_id_proveedor'];
									$model->fk_id_activo_clasificacion	=$record['fk_id_activo_clasificacion'];
									$model->fk_id_activo_utilitario		=$record['fk_id_activo_utilitario'];
									$model->fk_id_unidad				=$record['fk_id_unidad'];
									$model->fk_id_area					=$record['fk_id_area'];
									$model->fk_id_departamento			=$record['fk_id_departamento'];
									$model->codigo_activo				=$codigo;
									$model->descripcion_activo			=$record['descripcion_activo'];
									$model->piezas_activo				=$record['piezas_activo'];
									$model->fecha_adquisicion_activo	=$record['fecha_adquisicion_activo'];
									#$model->fecha_baja_activo			=$record['fecha_baja_activo'];
									$model->precio_adquisicion_activo	=$record['precio_adquisicion_activo'];
									$model->garantia_meses_activo		=$record['garantia_meses_activo'];
									$model->archivo_foto_activo			=$record['archivo_foto_activo'];
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
														$obj->fk_id_activo=$id_tabla_principal;
														foreach ($subvalue as $key3 => $value3) {
															if($obj->validaCampo($key3)){
																
																if ($key3=="fk_id_activo")
																	$obj->fk_id_activo=$id_tabla_principal;
																else {
																	if($key3 == "fk_id_usuario_entrego")
																		$obj->fk_id_usuario_entrego = Yii::app()->user->getId();
																	else
																		$obj->$key3=$value3;
																}
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
							}//for cantidad
                        } catch(Exception $e) {
							$error=$e->getMessage();
						}
                    } else {
                        $error="Error de json";
                    }
					
					if($contValRecords==$cantidad){
						$contValRec++;
					}
					
                    if ($sw+$contValRec == $ListaTotalEleVec[$i]+1) {
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





