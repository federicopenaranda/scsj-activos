<?php
/**
 * Esta es la accion para el controlador Reporte
 */
class reporte1 extends CAction
{
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model = new Activo020101();
		$mPDF1=Yii::app()->ePdf->mpdf();
		
		if ($_GET['id_activo']) {
			
			$res1 = $model->queryPdf_1_de_rep1($_GET['id_activo']);
			$res2_r = $model->queryPdf_2r_de_rep1($_GET['id_activo']);//fk_id_u_r
			$res2_e = $model->queryPdf_2e_de_rep1($_GET['id_activo']);//fk_id_u_r
			$res3 = $model->queryPdf_3_de_rep1($_GET['id_activo']);
			$header='<img src="'.'images/logo2.png"/>';
			$mPDF1->SetHTMLHeader($header);
			$mPDF1->WriteHTML($controller->renderPartial('pdf1',array('res1'=>$res1,'res2_r'=>$res2_r,'res2_e'=>$res2_e,'res3'=>$res3),true));
			#$mPDF1->Output();	
			$mPDF1->Output('REP.PDF','D');
		} else {
			
			$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos {id_activo}");
			$controller->renderPartial('error',array('model'=>$respuesta,'callback'=>""));
		}
	}
}