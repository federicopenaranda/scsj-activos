<?php
/**
 * Este es el controlador para el modelo "Reporte".
 */
class ReporteController extends Controller
{
	public function actions()
    {
		return array(
				'repActivoInfo'=>'application.controllers.Reporte.reporte1',
				'repActivosUsuario'=>'application.controllers.Reporte.reporte',
				'reportEx'=>'application.controllers.Reporte.reportEx',
				'reportEx2'=>'application.controllers.Reporte.reportEx2',
				'reporte2'=>'application.controllers.Reporte.reporte2',
				'reporte3'=>'application.controllers.Reporte.reporte3',
		);
	}
}
