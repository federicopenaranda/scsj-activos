<?php
/**
 * Esta es la accion para el controlador "Usuario000101".
 */

class logout extends CAction
{
	public function run()
	{
    	$controller=$this->getController();
    	if (isset($_GET['callback'])) {
        	$callback=$_GET['callback'];
            Yii::app()->user->logout();
            $respuesta=array("success"=>"true","msg"=>"deslogueado!!");
			$controller->renderParTial('index',array('model'=>$respuesta,'callback'=>$callback));
        } else {
        	$respuesta=array("success"=>"true","msg"=>"Error de callback");
			$controller->renderParTial('index',array('model'=>$respuesta,'callback'=>''));
        }
	}
}
