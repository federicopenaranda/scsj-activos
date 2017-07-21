<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class calculoValorActual extends CAction
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
		$error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['id_activo'])) ? "{ Error variable indefinida id_activo } " : "";
		
		if ($error == "") {
			$callback=$_GET['callback'];
			$id=$_GET['id_activo'];
			$model=new Activo020101();
			$modelo=$model::model()->with('fkIdProveedor','fkIdActivoTipo','fkIdActivoClasificacion')->find(array('condition'=>'id_activo = '.$id));
			
			if($modelo) {
				$fAdqui 	= $modelo->fecha_adquisicion_activo;
				$precio 	= $modelo->precio_adquisicion_activo;
				$anosUtil 	= $modelo->fkIdActivoClasificacion->anos_vida_util_activo_clasificacion*12;
				$coef 		= $modelo->fkIdActivoClasificacion->coeficiente_depreciacion_activo_clasificacion;
				#calculos
				$listDepre 	= array($precio);
				$coef_men	= ($coef/100)/12;
				$m = $model->calculaMes($fAdqui,date("Y-m-d"));
				for ($i=1; $i <= $m; $i++) {
					$calc			= $precio-($precio*$coef_men);
					$listDepre[$i]	= $calc;
					$precio			= $calc;
				}
				if($listDepre[$m]!=0)
					$respuesta->registros = round($listDepre[$m],2);
				else
					$respuesta->registros = 0;	
				$controller->renderParTial('especial',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error id no encontrado");
				$controller->renderParTial('especial',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('especial',array('model'=>$respuesta,'callback'=>''));
		}
	}
}