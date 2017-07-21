<?php
/**
 * Este es el controlador para el modelo "".
 */
class PermisosController extends Controller
{
	public function filters()
    {
		return array('accessControl');
	}
	
	public function accessRules()
    {
    	/*$objusu = new Usuario000101();
		$nombre = Yii::app()->user->name;
		$aux = $objusu->listaAcciones($nombre,'controlador');
		
		$arreglo = array(
		array('allow',
			'actions'=>array('login','logout'),
			'users'=>array('*'),
			),
		array('allow',
			'actions'=>$aux,
			'users'=>array('@'),
			),
		array('deny',
			'users'=>array('*'),
			),	
		);
		return $arreglo;*/
		return array(
			array('allow',
				'actions'=>array('login','logout'),
				'users'=>array('*'),
				),
			array('allow',
				'actions'=>array('tipousuario','privilegio'),
				'users'=>array('@'),
				),
			array('deny',
				'users'=>array('*'),
				),
		);
	}
	public function actionPrivilegio()
	{
		$respuesta=new stdClass();
		$error="";
		$error.= (!isset($_GET['limit'])) ? "{ Error variable indefinida limit } " : "";
		$error.= (!isset($_GET['start'])) ? "{ Error variable indefinida start } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
    	if ($error == "") {
			$callback=$_GET['callback'];
			$objusu=new UsuarioPrivilegio000004();
			#$nombre=Yii::app()->user->name;
			$id=Yii::app()->user->id;
			$Criteria=new CDbCriteria();
			$Criteria->join="INNER JOIN usuario_tipo_privilegio_00_02_02 AS utp ON utp.fk_id_usuario_privilegio = t.id_usuario_privilegio
INNER JOIN usuario_tipo_00_02_01 AS ut ON utp.fk_id_usuario_tipo = ut.id_usuario_tipo
INNER JOIN usuario_tipo_usuario_00_01_02 AS utu ON utu.fk_id_usuario_tipo = ut.id_usuario_tipo
INNER JOIN usuario_00_01_01 AS u ON utu.fk_id_usuario = u.id_usuario";
			$Criteria->condition="u.id_usuario = '$id'";
			$b=$objusu::model()->findAll($Criteria);
			$total=sizeof($b);
			$condi="";
			$error="";
			try {
				if (isset($_GET['filter']) && $_GET['filter']!='') {
					$filtro=CJSON::decode($_GET['filter']);
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$condi=$condi." ".$condicion." like '%".$valor."%' and ";		
					}
					$Criteria->condition=$condi."true";
					if (isset($_GET['sort']) && $_GET['sort']!='') {
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];	
						$Criteria->order=$condisort.' '.$valorsort;
					}
					$bensT=$objusu::model()->findAll($Criteria);
					$total="".sizeof($bensT);
					$Criteria->limit=$_GET['limit'];
					$Criteria->offset=$_GET['start'];
					$bens=$objusu::model()->findAll($Criteria);	
				} else {
					if (isset($_GET['sort']) && $_GET['sort']!='') {
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];	
						$Criteria->order=$condisort.' '.$valorsort;
					}
					$Criteria->limit=$_GET['limit'];
					$Criteria->offset=$_GET['start'];
					$bens=$objusu::model()->findAll($Criteria);
					
				}
			} catch (Exception $e) {
				$error=$e;
			}
			if ($error=="") {
				$arreglo=array();
				foreach($bens as $staff){
					$aux=array();
					$aux['nombre_privilegio_usuario_privilegio']	= $staff->nombre_privilegio_usuario_privilegio;
					$aux['accion_usuario_privilegio']	=$staff->accion_usuario_privilegio;
					$arreglo[]=$aux;	
				}
				$respuesta->registros=$arreglo;	
				$respuesta->total=(int)$total;
				$this->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>$error);
				$this->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$this->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
	
	public function actionTipousuario()
	{
		$respuesta=new stdClass();
		$error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
		if ($error == "") {
			$callback=$_GET['callback'];
			$model=new Usuario000101();

			$id=Yii::app()->user->id;
			$arreglo=$model->getTipo($id);
			$total=sizeof($arreglo);
			
			$respuesta->registros=$arreglo;	
			$respuesta->total=(int)$total;
			$this->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$this->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}		
}
