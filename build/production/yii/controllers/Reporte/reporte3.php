<?php
/**
 * Esta es la accion para el controlador Reporte
 */
class reporte3 extends CAction
{
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model = new ActivoEntrega020103();
		$mPDF1=Yii::app()->ePdf->mpdf();
		if (isset($_GET['fecha_min']) && isset($_GET['fecha_max'])) {
			
			$res11 = $model->consulta11_de_rep3($_GET['fecha_min'],$_GET['fecha_max']);
			$header='<img src="'.'images/logo2.png"/>';
			$mPDF1->SetHTMLHeader($header);
			$mPDF1->WriteHTML($controller->renderPartial('pdf3',array('res11'=>$res11,'fech_min'=>$_GET['fecha_min'],'fech_max'=>$_GET['fecha_max']),true));
			#$mPDF1->Output();	
			$mPDF1->Output('REP.PDF','D');
		} else {
			
			$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos {'fecha_min'} {'fecha_max'}");
			$controller->renderPartial('error',array('model'=>$respuesta,'callback'=>""));
		}
	}
}