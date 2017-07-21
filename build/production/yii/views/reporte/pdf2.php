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
<font color="#558FA6"></font>
<h1><font color="#558FA6">Lista de Empleados</font></h1>

<table width="340" border="1" class="tabla">
  <tr>
    <th width="91" align="center" style="border:1px solid black">nombre</th>
    <th width="52" align="center" style="border:1px solid black">NIT</th>
    <th width="135" align="center" style="border:1px solid black">DIRECCIÓN</th>
    <th width="135" align="center" style="border:1px solid black">TELEFONO 1</th>
    <th width="135" align="center" style="border:1px solid black">TELEFONO 2</th>
    <th width="135" align="center" style="border:1px solid black">OBSERVACIONES</th>
    </tr>
   <?php $i=0;foreach ($res11 as $value) {?>
  <tr>
    <td><?php echo $res11[$i]['nombre_activo_proveedor'];?></td>
    <td><?php echo $res11[$i]['nit_activo_proveedor'];?></td>
    <td><?php echo $res11[$i]['direccion_activo_proveedor'];?></td>
    <td><?php echo $res11[$i]['telefono1_activo_proveedor'];?></td>
    <td><?php echo $res11[$i]['telefono2_activo_proveedor'];?></td>
    <td><?php echo $res11[$i]['observaciones_activo_proveedor'];?></td>
    </tr>
   <?php $i++;} ?>
</table>

</body>
</html>