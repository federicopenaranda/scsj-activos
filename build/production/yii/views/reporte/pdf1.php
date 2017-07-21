<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
  <style type="text/css">
  #contenido {
  float: left;
  width: 85%;
}
#contenido #izquierda {
  float: left;
  width: 50%;
  position: relative;
}
#contenido #derecha {
  float: right;
  width: 50%;
  position: relative;
}
  
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
  /*para columnas */
  .tabla tc{
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
  </style>
</head>

<body>
<p>
<table width="549" border="0" align="center">
  <tr>
    <td align="center" width="433"><h1><font color="#558FA6">Reporte de Activo</font></h1></td>
  </tr>
  <tr>
    <td align="center"><h1><font color="#558FA6">Sistema de Activos SCSJ</font></h1></td>
  </tr>
</table>
<p>Generado:
  <?= date('Y-m-d H:m:s'); ?>
</p>
<h2><font color="#558FA6">Datos del Activo</font></h2>
<table border="0">
  <tr>
    <td width="351" height="160"><table width="337" height="175" border="0" class="tabla">
      <tr>
        <th width="107" style="border:1px solid black" >CÓDIGO:</th>
        <td width="214" style="border:1px solid black"><?php echo $res1[0]['codigo_activo'];?></td>
      </tr>
      <tr>
        <th width="107" style="border:1px solid black" >UNIDAD:</th>
        <td width="214" style="border:1px solid black"><?php echo $res1[0]['nombre_unidad'];?></td>
      </tr>
      <tr>
        <th width="107" style="border:1px solid black" >AREA:</th>
        <td width="214" style="border:1px solid black"><?php echo $res1[0]['nombre_area'];?></td>
      </tr>
      <tr>
        <th width="107" style="border:1px solid black" >DEPARTAMENTO:</th>
        <td width="214" style="border:1px solid black"><?php echo $res1[0]['nombre_departamento'];?></td>
      </tr>
      <tr>
        <th width="107" style="border:1px solid black">PIEZAS:</th>
        <td width="214" style="border:1px solid black"><?php echo $res1[0]['piezas_activo'];?></td>
      </tr>
      <tr>
        <th width="107" style="border:1px solid black">FECHA DE ADQUISICIÓN:</th>
        <td width="214" style="border:1px solid black"><?php echo $res1[0]['fecha_adquisicion_activo'];?></td>
      </tr>
      <tr>
        <th width="112" style="border:1px solid black">PRECIO:</th>
        <td width="178" style="border:1px solid black">Bs. <?php echo $res1[0]['precio_adquisicion_activo'];?></td>
      </tr>
  </table></td>
    <td width="369"><table width="265" height="198" border="0" align="center" class="tabla">
      <tr>
        <th width="112" style="border:1px solid black">GARANTÍA:</th>
        <td width="178" style="border:1px solid black"><?php echo $res1[0]['garantia_meses_activo'];?> MESES</td>
      </tr>
      <tr>
        <th width="112" style="border:1px solid black">MEDIDA:</th>
        <td width="178" style="border:1px solid black"><?php echo $res1[0]['medida_activo'];?></td>
      </tr>
      <tr>
        <th width="112" style="border:1px solid black">PROVEEDOR:</th>
        <td width="178" style="border:1px solid black"><?php echo $res1[0]['nombre_activo_proveedor'];?></td>
      </tr>
      <tr>
        <th width="112" style="border:1px solid black">TIPO:</th>
        <td width="178" style="border:1px solid black"><?php echo $res1[0]['nombre_activo_tipo'];?></td>
      </tr>
      <tr>
        <th width="112" style="border:1px solid black">CLASIFICACIÓN:</th>
        <td width="112" style="border:1px solid black"><?php echo $res1[0]['nombre_activo_clasificacion'];?></td>
      </tr>
      <tr>
        <th  width="107" style="border:1px solid black">DESCRIPCIÓN:</th>
        <td width="107" style="border:1px solid black"><?php echo $res1[0]['descripcion_activo'];?></td>
      </tr>
    </table></td>
  </tr>
</table>
<h2><font color="#558FA6">Movimientos del Activo</font></h2>
<table width="600" border="1" class="tabla">
  <tr>
    <th width="33" align="center" style="border:1px solid black">USUARIO QUE RECIBIÓ</th>
    <th width="33" align="center" style="border:1px solid black">USUARIO QUE ENTREGÓ</th>
    <th width="29" align="center" style="border:1px solid black">FECHA DE ENTREGA</th>
  </tr>
<?php if(sizeof($res2_r) != 0) {?>
   <?php $i=0;foreach ($res2_r as $value) {?>
  <tr>
    <td><?php echo $res2_r[$i]['primer_nombre_usuario']." ".$res2_r[$i]['segundo_nombre_usuario']." ".$res2_r[$i]['apellido_paterno_usuario']." ".$res2_r[$i]['apellido_paterno_usuario']." ".$res2_r[$i]['apellido_paterno_usuario'];?></td>
    <td><?php echo $res2_e[$i]['primer_nombre_usuario']." ".$res2_e[$i]['segundo_nombre_usuario']." ".$res2_e[$i]['apellido_paterno_usuario']." ".$res2_e[$i]['apellido_materno_usuario'];?></td>
    <td><?php echo $res2_r[$i]['fecha_activo_entrega'];?></td>
  </tr>
   <?php $i++;} ?>
   <?php } else {?>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <?php }//if sezeof()?>
</table>
<h2><font color="#558FA6">Revisiones del Activo</font></h2>
<table width="290" border="1" class="tabla">
  <tr>
    <th width="33" align="center" style="border:1px solid black">VALOR</th>
    <th width="53" align="center" style="border:1px solid black">FECHA de REVISIóN</th>
    <th width="53" align="center" style="border:1px solid black">UBICACIÓN</th>
    <th width="41" align="center" style="border:1px solid black"> INICIO </th>
    <th width="29" align="center" style="border:1px solid black"> FIN</th>
    <th width="41" align="center" style="border:1px solid black">OBSERVACIÓN</th>
  </tr>
   <?php $i=0;foreach ($res3 as $value) {?>
  <tr>
    <td>bs.<?php echo $res3[$i]['valor_activo_valor'];?></td>
    <td><?php echo $res3[$i]['fecha_activo_revision'];?></td>
    <td><?php echo $res3[$i]['nombre_ubicacion'];?></td>
    <td><?php echo $res3[$i]['fecha_inicio_revision'];?></td>
    <td><?php echo $res3[$i]['fecha_fin_revision'];?></td>
    <td><?php echo $res3[$i]['observacion_activo_revision'];?></td>
  </tr>
   <?php $i++;} ?>
</table>

</body>
</html>