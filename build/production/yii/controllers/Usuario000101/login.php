<?php
/**
 * Esta es la accion para el controlador "Usuario000101".
 */
class login extends CAction
{
	public function run()
    {
		$controller=$this->getController();
        if (isset($_GET['callback'])) {
           
            if (isset($_GET['login_usuario']) && isset($_GET['contrasena_usuario'])) {
                $username=$_GET['login_usuario'];
                $password=$_GET['contrasena_usuario'];
                $callback=$_GET['callback'];
                $identity=new UserIdentity($username,$password);
                $identity->authenticate();
                if ($identity->errorCode===UserIdentity::ERROR_NONE) {
                    //$duration=$this->rememberMe ? 3600*24*30:0
                    Yii::app()->user->login($identity);
                    $respuesta=array("success"=>"true","msg"=>"logeado!!");
					$controller->renderParTial('index',array('model'=>$respuesta,'callback'=>$callback));
                } else{
                    $controller->renderParTial('index',array('model'=>array('sin acceso'),'callback'=>$callback));
                }
            } else {
				$respuesta=array("success"=>"true","msg"=>"Parametros indefinidos");
				$controller->renderParTial('index',array('model'=>$respuesta,'callback'=>$callback));
            }
        } else {
        	$respuesta=array("success"=>"true","msg"=>"Error de callback");
			$controller->renderParTial('index',array('model'=>$respuesta,'callback'=>''));
        }
	}
}