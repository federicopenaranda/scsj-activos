<?php
/**
 * Este es el controlador para el modelo "Usuario000101".
 */
class Usuario000101Controller extends Controller
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
				'actions'=>array('login','logout','insert'),
				'users'=>array('*'),
				),
			array('allow',
				'actions'=>array('index','create','update','delete','listaPrivilegiosUsuario'),
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
				'create'=>'application.controllers.Usuario000101.create',
				'index'=>'application.controllers.Usuario000101.read',
				'update'=>'application.controllers.Usuario000101.update',
				'delete'=>'application.controllers.Usuario000101.delete',
				'login'=>'application.controllers.Usuario000101.login',
				'logout'=>'application.controllers.Usuario000101.logout',
				'insert'=>'application.controllers.Usuario000101.insert',
                'listaPrivilegiosUsuario'=>'application.controllers.Usuario000101.ListaPrivilegiosUsuario',
		);
	}
}
