<?php
/**
 * Esta es la accion para el controlador PrivilegiosUsuario
 */
class insert extends CAction
{
	/**
    * Esta accion inserta las 4 acciones (create,read,update,delete) por cada tabla de la base de datos.
    */
	public function run()
	{
    	$controller=$this->getController();
		$respuesta=new stdClass();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
		if ($error == "") {
        	$callback=$_GET['callback'];
            
            $modeUsuario =new Usuario000101();
			$modeUsuario->id_usuario=1;
              
			$modeUsuario->fk_id_area=1;
              
			$modeUsuario->fk_id_departamento=1;
              
			$modeUsuario->fk_id_cargo=1;
              
			$modeUsuario->primer_nombre_usuario="admin";
              
			$modeUsuario->segundo_nombre_usuario="admin";
              
			$modeUsuario->apellido_paterno_usuario="admin";
              
			$modeUsuario->apellido_materno_usuario="admin";
              
			$modeUsuario->login_usuario="admin";
              
			$modeUsuario->contrasena_usuario=sha1("admin");
              
			$modeUsuario->sexo_usuario="m";
              
			$modeUsuario->telefono_usuario="admin";
              
			$modeUsuario->celular_usuario="admin";
              
			$modeUsuario->correo_usuario="admin";
              
			$modeUsuario->direccion_usuario="admin";
              
			$modeUsuario->imagen_usuario="admin";
              
			$modeUsuario->observaciones_usuario="admin";
              
			$modeUsuario->fecha_creacion_usuario=date("Y-m-d");
              
			$modeUsuario->save();
			
			$modeUsuarioTipo=new UsuarioTipo000201();
			$modeUsuarioTipo->nombre_usuario_tipo="admin";
			$modeUsuarioTipo->descripcion_usuario_tipo="administrador";
			$modeUsuarioTipo->save();
		
			
			$modeUsuarioTipoUsuario=new UsuarioTipoUsuario000102();
			$modeUsuarioTipoUsuario->fk_id_usuario_tipo = $modeUsuarioTipo->getPrimaryKey();
			$modeUsuarioTipoUsuario->fk_id_usuario		= $modeUsuario->getPrimaryKey();
			$modeUsuarioTipoUsuario->save();
            
        	$arreglo=array (
'Activo020101',
'ActivoClasificacion020104',
'ActivoEntrega020103',
'ActivoEstado020204',
'ActivoProveedor020104',
'ActivoRevision020205',
'ActivoUbicacion020103',
'ActivoUtilitario020104',
'ActivoValor020103',
'Area010004',
'Cargo010004',
'Departamento010004',
'LogSistema030003',
'Reporte030004',
'Revision020204',
'Ubicacion020104',
'Unidad010004',
'Usuario000101',
'UsuarioPrivilegio000004',
'UsuarioTipo000201',
'UsuarioTipoPrivilegio000202',
'UsuarioTipoUsuario000102',
'UsuarioUnidad000102',
            );
            foreach ($arreglo as $valor) {
                
                for ($i=1;$i<=4;$i++) {
                    $model=new UsuarioPrivilegio000004();
                    switch ($i) {
                        case 1:
                            $model->accion_usuario_privilegio="create";
                            $model->nombre_privilegio_usuario_privilegio="crea ".$valor;
                        break;
                        case 2:
                            $model->accion_usuario_privilegio="index";
                            $model->nombre_privilegio_usuario_privilegio="lee ".$valor;
                        break;
                        case 3:
                            $model->accion_usuario_privilegio="update";
                            $model->nombre_privilegio_usuario_privilegio="actualiza ".$valor;
                        break;
                        case 4:
                            $model->accion_usuario_privilegio="delete";
                            $model->nombre_privilegio_usuario_privilegio="elimina ".$valor;
                        break;
                     }  
					$model->opciones_usuario_privilegio="controlador";
                    $model->funcion_usuario_privilegio		= $valor; 
                    $model->descripcion_usuario_privilegio="automatico";
					if ($model->validate())
						$model->save(); 
                }
            }
            
            $model=new UsuarioTipoPrivilegio000202();
			$registros=UsuarioPrivilegio000004::model()->findAll();
			foreach($registros as $registro):
				$model=new UsuarioTipoPrivilegio000202();
				$model->fk_id_usuario_tipo=$modeUsuarioTipo->getPrimaryKey();
				$model->fk_id_usuario_privilegio = $registro->id_usuario_privilegio;
				$model->save();
			endforeach;
            
            $respuesta->meta=array("success"=>"true","msg"=>"Registros Creados!!");
            $controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}