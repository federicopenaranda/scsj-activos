<?php
/**
 * Este es el controlador para el modelo "UsuarioTipoPrivilegio000202".
 */
class UsuarioTipoPrivilegio000202Controller extends Controller
{
	/**
	* La funcion filters() se definen todas los filtros del controlador
	* @return array retorna todas los filtros definidas en un array
	*/
	public function filters()
    {
		return array('accessControl');
	}
    
	/**
	* La funcion accessRules es un filtro donde se autentifica los permisos para cada accion 
	* @return array retorna todas las acciones definidas en un array
	*/
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
				'actions'=>array('index','create','update','delete'),
				'users'=>array('@'),
				),
			array('deny',
				'users'=>array('*'),
				),
		);
	}
    
	/**
	* La funcion actions() se definen todas las acciones del controlador	
	* @return array retorna todas las acciones definidas en un array	
	*/
	public function actions()
    {
		return array(
				'create'=>'application.controllers.UsuarioTipoPrivilegio000202.create',
				'index'=>'application.controllers.UsuarioTipoPrivilegio000202.read',
				'update'=>'application.controllers.UsuarioTipoPrivilegio000202.update',
				'delete'=>'application.controllers.UsuarioTipoPrivilegio000202.delete',
		);
	}
}
