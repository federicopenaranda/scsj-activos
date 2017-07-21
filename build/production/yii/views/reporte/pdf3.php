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
<table width="549" border="0" align="center">
  <tr>
    <td align="center" width="433"><h2><font color="#558FA6">Reporte  de Activos Dados de Baja</font></h2></td>
  </tr>
  <tr>
    <td align="center"><h2><font color="#558FA6">Sistema de Activos SCSJ</font></h2></td>
  </tr>
</table>
<p>Generado:
  <?= date('Y-m-d H:m:s'); ?>
</p>
<table width="375" border="0">
  <tr>
    <td width="115">Fecha Mínima:</td>
    <td width="244"><?php echo str_replace("\"","",$fech_min);?></td>
  </tr>
  <tr>
    <td height="31">Fecha Máxima:</td>
    <td><?php echo str_replace("\"","",$fech_max);?></td>
  </tr>
</table>
<table width="340" border="1" class="tabla">
  <tr>
    <th width="91" align="center" style="border:1px solid black">condigo activo</th>
    <th width="52" align="center" style="border:1px solid black">descripción</th>
    <th width="135" align="center" style="border:1px solid black">piezas</th>
    <th width="135" align="center" style="border:1px solid black">fecha de adquisición</th>
    <th width="91" align="center" style="border:1px solid black">tipo</th>
    <th width="91" align="center" style="border:1px solid black">clasificación</th>
    <th width="52" align="center" style="border:1px solid black">ubicación</th>
  </tr>
   <?php $i=0;foreach ($res11 as $value) {?>
  <tr>
    <td><?php echo $res11[$i]['codigo_activo'];?></td>
    <td><?php echo $res11[$i]['descripcion_activo'];?></td>
    <td><?php echo $res11[$i]['piezas_activo'];?></td>
    <td><?php echo $res11[$i]['fecha_adquisicion_activo'];?></td>
    <td><?php echo $res11[$i]['nombre_activo_tipo'];?></td>
    <td><?php echo $res11[$i]['nombre_activo_clasificacion'];?></td>
    <td><?php echo $res11[$i]['ubicacion_activo_revision'];?></td>
  </tr>
   <?php $i++;} ?>
</table>

</body>
</html>