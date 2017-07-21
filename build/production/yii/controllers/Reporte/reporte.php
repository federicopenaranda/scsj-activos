<?php
/**
 * Esta es la accion para el controlador Reporte
 */
class reporte extends CAction
{
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model = new ActivoEntrega020103();
		$mPDF1=Yii::app()->ePdf->mpdf();
		$res12e=array();
		if ($_GET['id_usuario']) {

			$res12 = $model->consulta12_de_rep1($_GET['id_usuario']);
			$id_a_e = $res12[0]['id_activo_entrega'];
			if($id_a_e!="")
				$res12e = $model->consulta12e_de_rep1($_GET['id_usuario'],$id_a_e);
			$res11 = $model->consulta11_de_rep1($_GET['id_usuario']);//lista los activos
			$header='<img src="'.'images/logo2.png"/>';
			$mPDF1->SetHTMLHeader($header);
			$mPDF1->WriteHTML($controller->renderPartial('pdf',array('res11'=>$res11,'res12'=>$res12,'res12e'=>$res12e),true));
			#$mPDF1->Output();	
			$mPDF1->Output('REP.PDF','D');
		} else {
			
			$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos {'id_usuario'}");
			$controller->renderPartial('error',array('model'=>$respuesta,'callback'=>""));
		}
		/*$model=new Beneficiario();
		$error="";
		$listaConsulta1=array();
		$listaConsulta2=array();
		$listaConsulta3=array();
		$listaConsulta4=array();
		if ($_GET['id'] && isset($_GET['id'])) {
			$id=$_GET['id'];
			$res11=$model->consulta1_1_de_rep2($id);
			$res12=$model->consulta1_2_de_rep2($id);
			$res13=$model->consulta1_3_de_rep2($id);
			$res14=$model->consulta1_4_de_rep2($id);
			$res15=$model->consulta1_5_de_rep2($id);
			$res16=$model->consulta1_6_de_rep2($id);
			$res17=$model->consulta1_7_de_rep2($id);
			$res18=$model->consulta1_8_de_rep2($id);
			$res21=$model->consulta2_1_de_rep2($id);
			$res22=$model->consulta2_2_de_rep2($id);
			$res23=$model->consulta2_3_de_rep2($id);
			$res3=$model->consulta3_de_rep2($id);
			$res31=$model->subconsulta1_de_rep3($id);
			$header='<img src="'.'images/logo2.png"/>';
			$mPDF1->SetHTMLHeader($header);
			$mPDF1->WriteHTML($controller->renderPartial('pdf',array('res11'=>$res11,'res12'=>$res12,'res13'=>$res13,'res14'=>$res14,'res15'=>$res15,'res16'=>$res16,'res17'=>$res17,'res18'=>$res18,'res21'=>$res21,'res22'=>$res22,'res23'=>$res23,'res3'=>$res3,'res31'=>$res31),true));
			$mPDF1->Output('REP.PDF','D');
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
			$controller->renderPartial('error',array('model'=>$respuesta,'callback'=>""));
		}*/
	}
}