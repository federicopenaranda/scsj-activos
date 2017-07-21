<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class verificarRevision extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de listar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		if (isset($_GET['callback']) && $_GET['callback']!=='') {
			$callback=$_GET['callback'];
			$model=new Revision020204();
			#$modelo=array();
			$modelo=$model::model()->findAll(array('condition'=>'estado_revision = 1'));
			if (sizeof($modelo)== 1){
				$respuesta->meta=array("success"=>"true","msg"=>"true");
				$controller->renderParTial('especial',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"false");
				$controller->renderParTial('especial',array('model'=>$respuesta,'callback'=>$callback));	
			}			
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('especial',array('model'=>$respuesta,'callback'=>''));
		}
	}
}