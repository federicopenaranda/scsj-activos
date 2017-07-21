<?php
/**
 * Esta es la accion para el controlador Reporte
 */
class reportEx extends CAction
{
	public function run()
	{
		$respuesta=new stdClass();
    	$controller = $this->getController();
		$phpExcel = new PHPExcel();
		$model = new Activo020101();
		
		
		
			$phpExcel->getActiveSheet()->getStyle('B3')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					 'rgb' => 'F2BABC'
				)
			));
		
        //area de diseño de excel
        $styleArray = array(
                'borders' => array(
                    'allborders'=>array(
                        'style' =>PHPExcel_Style_Border::BORDER_THIN,
                        'color'=>array('argb'=>'000000'),
                    )
                ),
              );
		
		$phpExcel->getActiveSheet(0);
		$phpExcel->setActiveSheetIndex(0)
            ->mergeCells('B2:D2')
            ->setCellValue('B2', 'Lista de Activos');
		/*
		* Area de consultas
		*/
		if (isset($_GET['fecha_ini']) && isset($_GET['fecha_max']) && isset($_GET['id_revision'])){
			$datetimemin = $_GET['fecha_ini'];
			$datetimemax = $_GET['fecha_max'];
			$id = $_GET['id_revision'];

			$res = $model->consultaEx1_de_rep1($id,$datetimemin,$datetimemax);
			#$res = Activo020101::model()->findAll(array('condition'=>'fecha_baja_activo	BETWEEN "'.$datetimemin.'" AND "'.$datetimemax.'"'));
			//se agregan los titulos del reporte
			$phpExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
			$phpExcel->setActiveSheetIndex(0) //seelecciona la hoja donde 0 es el indice de la hoja
					->setCellValue('B3', 'Codigo') //asignamos el contenido a la celda deseada (celda,valor)
					->setCellValue('C3', 'Descripcion')
					->setCellValue('D3', 'Cantidad');
			$pos=4; //numero de la fila
			foreach($res as $r):
				$phpExcel->setActiveSheetIndex(0)
					->setCellValue('B'.$pos, $r['codigo_activo'])
					->setCellValue('C'.$pos,$r['descripcion_activo'])
					->setCellValue('D'.$pos,$r['cantidad_activo']);
				$pos++;
			endforeach;
			$phpExcel->getActiveSheet()->getStyle('B2:D'.($pos-1))->applyFromArray($styleArray); // se aplica el formato de estilo
			//asigna el ancho de las columnas de forma automática en base al contenido de cada una de ellas 
			for($i = 'A'; $i <= 'D'; $i++) {
				$phpExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
			}

			/**
			* Area de configuracion de PHPExcel
			*/
			$filename = 'YiiExcel';
        	header('Content-Type: application/vnd.ms-excel');
        	header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        	header('Cache-Control: max-age=0');
        	$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
        	$objWriter->save('php://output');
        	exit();
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"parametros indefinidos fecha_ini, fecha_max o id_revision");
			$controller->renderParTial('error',array('model'=>$respuesta,'callback'=>''));
		}
	}
}