<?php
/**
 * Esta es la accion para el controlador Reporte
 */
class reporte2 extends CAction
{
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model = new Activo020101();
		$mPDF1=Yii::app()->ePdf->mpdf();
		
		if ($_GET['id_activo']) {
			
			$res11 = $model->queryPdf_1_de_rep2($_GET['id_activo']);
			$mPDF1->WriteHTML($controller->renderPartial('pdf2',array('res11'=>$res11),true));
			#$mPDF1->Output();	
			$mPDF1->Output('REP.PDF','D');
		} else {
			
			$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos {id_activo}");
			$controller->renderPartial('error',array('model'=>$respuesta,'callback'=>""));
		}
	}
}