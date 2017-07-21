<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
  <style type="text/css">
  /*td {border:1px solid black}*/
  .tabla{
    /*font-family: Verdana,Arial,Helvetica;*/
    /*font-size: 8px;*/
    text-align: center;
    width: 300px;
  }
  .tabla th{
    padding: 3px;
    font-size: 8px;
    background-color: #6f9abc;
    background-repeat: repeat-x;
    color: #FFFFFF;
    border-right-style: solid;
    border-right-color: #558FA6;
    border-bottom-color: #558FA6;
    font-family:"Trebuchet MS",Arial;
    text-transform: uppercase;
    text-align: left;
  }
  .tabla td{
    padding: 3px;
    font-size: 8px;
    /*background-color: #e4eef6;*/
    background-repeat: repeat-x;
    /*color:#6f9abc;*/
    height: 3px;
    text-transform: uppercase;
  }
  .tabla2{
    positioning: static;
    top: 150px;
    left: 250px;
    font-size: 8px;
  }
  </style>
</head>

<body>
<p><font color="#558FA6"></font>
</p>
<p>&nbsp;</p>

<table width="549" border="0" align="center">
  <tr>
    <td align="center" width="433"><h2><font color="#558FA6">Reporte  de Asignación de Activos</font></h2></td>
  </tr>
  <tr>
    <td align="center"><h2><font color="#558FA6">Sistema de Activos SCSJ</font></h2></td>
  </tr>
</table>
<h2 align="center"><font color="#558FA6"></h2>
<p>Generado :
  <?= date('Y-m-d H:m:s'); ?>
</p>
<p>
<h3><font color="#558FA6">Responsable</font></h3>
</p>
<table width="954" border="0">
  <tr>
    <td width="199"><strong>NOMBRE : </strong></td>
    <td width="267"><?php echo $res12[0]['primer_nombre_usuario'];?></td>
    <td width="118"><strong>APELLIDO :</strong></td>
    <td width="352"><?php echo $res12[0]['apellido_paterno_usuario']." ".$res12[0]['apellido_materno_usuario'];?></td>
  </tr>
  <tr>
    <td><strong>FECHA  DE INVENTARIO :</strong></td>
    <td><?php echo $res11[0]['fecha_inicio_revision'];?></td>
    <td><strong>UNIDAD:</strong></td>
    <?php $cad="";$i=0;foreach ($res12 as $value) {
	$cad.=$res12[$i]['nombre_unidad'].","; $i++;
	}?>
    <td><?php echo substr($cad,0,-1);?></td>
  </tr>
</table>
<font color="#558FA6">
<h2><font color="#558FA6">Lista  de Activos Asignados</font></h2>
</font>
<table width="340" border="1" class="tabla">
  <tr>
    <th width="91" align="center" style="border:1px solid black">CÓDIGO</th>
    <th width="52" align="center" style="border:1px solid black">descripción</th>
    <th width="50" align="center" style="border:1px solid black">piezas</th>
    <th width="120" align="center" style="border:1px solid black">FECHA DE ADQUISICIÓN</th>
    <th width="91" align="center" style="border:1px solid black">CLASIFICACIÓN</th>
    <th width="91" align="center" style="border:1px solid black">UBICACIÓN</th>
    <th width="52" align="center" style="border:1px solid black">OBSERVACIONES</th>
  </tr>
   <?php $i=0;foreach ($res11 as $value) {?>
  <tr>
    <td><?php echo $res11[$i]['codigo_activo'];?></td>
    <td><?php echo $res11[$i]['descripcion_activo'];?></td>
    <td><?php echo $res11[$i]['piezas_activo'];?></td>
    <td><?php echo $res11[$i]['fecha_adquisicion_activo'];?></td>
    <td><?php echo $res11[$i]['nombre_activo_clasificacion'];?></td>
    <td><?php echo $res11[$i]['ubicacion_activo_revision'];?></td>
   <td>&nbsp;</td>
  </tr>
   <?php $i++;} ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="671" border="0">
  <tr>
    <td align="center">________________________________________</td>
    <td align="center">_______________________________________</td>
  </tr>
  <tr>
    <td align="center">Firma de Recibo</td>
    <td align="center">Firma de Entrega</td>
  </tr>
  <tr>
    <td width="320" align="center"><?php echo $res12[0]['primer_nombre_usuario']." ".$res12[0]['apellido_paterno_usuario']." ".$res12[0]['apellido_materno_usuario'];?></td>
    <td width="341" align="center"><?php echo $res12e[0]['primer_nombre_usuario']." ".$res12e[0]['apellido_paterno_usuario']." ".$res12e[0]['apellido_materno_usuario'];?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>