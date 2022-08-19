<?php 

use MyApp\Query\Select;
require("../vendor/autoload.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        
        @import url('https://fonts.googleapis.com/css?family=Montserrat|Montserrat+Alternates|Poppins&display=swap');
    *{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: 'Montserrat Alternates', sans-serif;
	}
    
  body
    {
        
		background-image: url('http://localhost/pinchevicky/src/img/diagonal_striped_brick.png');
	}
    .fondo
    {
        background-color:white;
    }
    .clr-blanco
    {
        color:white;
    }
    .borde
    {
        border: border-solid;
        border-color:black;
        border-radius:5px;
    }
    .acomodo
    {
        width: 700px;
        padding-left: 70px;
        
    }
    .titulo
    {
        text-align: center;
        font
    }
    table
    {
      border-radius: 30px;
    }
    .contenedores
    {
      background-color: #212529;
      color:white;
      border-radius:5px;
      width:6%;
      margin:auto;
      margin-top:15px;
      padding: 6px;
    }
    .contenedores1
    {
      background-color: #212529;
      color:white;
      border-radius:5px;
      width:100;
      text-align: center;
      margin:auto;
      margin-right:15px;
      margin-left:15px;         
      margin-top:15px;
      padding: 6px;
    }
    .fecha
    {
      width:50%;
      margin: auto;
    }
    </style>
  </head>
  <body>
  

  <nav class="nav justify-content-center navbar-dark bg-dark ">
              <a class="nav-link disabled" href="#">Reporte de Ventas</a>
              <a class="nav-link clr-blanco" href="AdminProd.php">Regresar</a>
              <a class="nav-link clr-blanco" href="http://localhost/pinchevicky/">Inicio</a>
            </nav>
<br><br>

<h1 class="titulo">Reporte de Ventas</h1>
<div  style="">
  <?php
  date_default_timezone_set('America/Mexico_City');
  $fecha_actual=date("Y-m-d H:i:s");
  $qry = new Select();
  $ConsultaVentasHoy="SELECT COUNT(TV.CANTIDAD_DE_VENTAS) as CANTIDAD_DE_VENTAS, SUM(TV.SUM_VENT) AS VENTAS_TOTALES  FROM (
    SELECT COUNT(VG.FECHA_DE_VENTA) AS 'CANTIDAD_DE_VENTAS', SUM(VG.PRECIO) AS 'SUM_VENT', VG.FECHA_DE_VENTA FROM (
    SELECT productos.nombre as 'PRODUCTO', productos.precio as 'PRECIO',
    detalle_orden.fecha_detalle AS 'FECHA_DE_VENTA', orden.reg as 'No. ORDEN',
    CONCAT(persona.nombre, ' ',persona.apellidos)as 'CLIENTE' FROM persona JOIN usuario ON persona.id_persona=usuario.persona
    JOIN orden on orden.usr=usuario.id_usr join detalle_orden on orden.reg = detalle_orden.orden JOIN productos ON detalle_orden.producto=productos.cve_prod) AS VG
    group by VG.FECHA_DE_VENTA, VG.PRECIO) AS TV
    WHERE TV.FECHA_DE_VENTA='$fecha_actual'";
    $ventasHoy= $qry -> seleccionar($ConsultaVentasHoy);
  
    foreach ($ventasHoy as $registros)
    {
      echo "<h4 text-align='left'>Ventas de hoy: ".$registros->VENTAS_TOTALES."</h4>";
    }
  ?>
<a class='nav-link dropdown-toggle contenedores1' style="color:white;"href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>ESCOGE EL REPORTE QUE DESEAS VER</a> 
  <ul class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown'>
  <li><a class='dropdown-item clr-blanco' href='Registros.php?vista=1'>Ultimas 15 ventas</a></li><li><hr class='dropdown-divider'></li>
  <li><a class='dropdown-item clr-blanco' href='Registros.php?vista=2'>Cantidad de ventas por categoria</a></li><li><hr class='dropdown-divider'></li>
  <li><a class='dropdown-item clr-blanco' href='Registros.php?vista=3'>Ventas de un dia</a></li><li><hr class='dropdown-divider'></li>
  <li><a class='dropdown-item clr-blanco' href='Registros.php?vista=4'>Total de ventas en general</a></li><li><hr class='dropdown-divider'></li>
  <li><a class='dropdown-item clr-blanco' href='Registros.php?vista=5'>Total de ventas en un periodo</a></li><li><hr class='dropdown-divider'></li>
  <li><a class='dropdown-item clr-blanco' href='Registros.php?vista=6'>Muestra de ventas de un dia</a></li><li><hr class='dropdown-divider'></li>
  <li><a class='dropdown-item clr-blanco' href='Registros.php?vista=7'>Muestra de ventas de un periodo</a></li><li><hr class='dropdown-divider'></li>
  </ul>
</div>

<!----------------------- Venta General------------------------------------------------------------------------------------------->

    <?php

     if(isset($_GET['vista']))
     {
     $query = new Select();
     
     $vista = $_GET['vista'];
      if($vista==1)
      {
     
     $cadena = "SELECT productos.nombre , productos.precio,
     detalle_orden.fecha_detalle , orden.reg ,
     CONCAT(persona.nombre, ' ',persona.apellidos)as 'CLIENTE' FROM persona JOIN usuario ON persona.id_persona=usuario.persona JOIN orden on orden.usr=usuario.id_usr 
     join detalle_orden on orden.reg = detalle_orden.orden JOIN productos ON detalle_orden.producto=productos.cve_prod LIMIT 15";
     
     $VG = $query->seleccionar($cadena); 
     ?>
     <br><br>
     <div class="row" style="text-align:center">
      <div class="col">
      <h2>Ultimas 15 ventas</h2>
     <table class="table fondo borde">
  <thead>
    
      <th scope="col">#</th>
      <th scope="col">Producto</th>
      <th scope="col">Precio</th>
      <th scope="col">Fecha de venta</th>
      <th scope="col">No. Orden</th>
      <th scope="col">Cliente</th>
    
  </thead>
    
<?php   
$i=1;
foreach ($VG as $registros){
 
  echo "<tr>";
  echo "<td> $i</td>";
  echo "<td> $registros->nombre</td>";
  echo "<td><h4 >$ $registros->precio</h4></td>";
  echo "<td> $registros->fecha_detalle </td>";
  echo "<td> <h4>$registros->reg </h4></td>";
  echo "<td> $registros->CLIENTE </td>";
echo "</td>
      </tr>";
      $i++;
}
echo "</tbody>
</table>";
      }
      else if ($vista == 2) {
?>
      </div>
     <br><br>
      <div class="col" style="text-align:center">
      <h2>Cantidad de ventas de cada categoria</h2>
     <table class="table fondo borde">
  <thead>
    
      <th scope="col">#</th>
      <th scope="col">Categoria</th>
      <th scope="col">Ventas</th>
    
  </thead>
     <?php 
     $query = new Select();
     
     $cadena = "SELECT PVC.CATEGORIA, SUM(VENTAS) AS VENTAS FROM (
      SELECT categoria_prenda.prenda as 'CATEGORIA', COUNT(RV.PRODUCTO) AS 'VENTAS' FROM categoria_prenda 
         INNER JOIN 
         (SELECT productos.categoria_prenda AS CATEGORIA_PRENDA,productos.nombre as 'PRODUCTO', 
         productos.precio as 'PRECIO',
         detalle_orden.fecha_detalle AS 'FECHA_DE_VENTA', 
         orden.reg as 'No_ORDEN',
         CONCAT(persona.nombre, ' ',persona.apellidos)as 'CLIENTE' FROM persona 
         JOIN usuario ON persona.id_persona=usuario.persona 
         JOIN orden on orden.usr=usuario.id_usr 
         join detalle_orden on orden.reg = detalle_orden.orden 
         JOIN productos ON detalle_orden.producto=productos.cve_prod)AS RV ON categoria_prenda.cve_pcat = RV.CATEGORIA_PRENDA
         GROUP BY categoria_prenda,RV.PRODUCTO) AS PVC GROUP BY PVC.CATEGORIA";
     
     $PVC = $query->seleccionar($cadena);   
$f=1;
foreach ($PVC as $registros){
 
  echo "<tr>";
  echo "<td> $f</td>";
  echo "<td> $registros->CATEGORIA</td>";
  echo "<td><h4 >$registros->VENTAS</h4></td>";
echo "</td>
      </tr>";
      $f++;
}
echo "</tbody>
</table></div>";
      }
      else if ($vista == 3) {
?>
    <?php  
      
?>

      </div>
     <br><br>
      <div class="col" style="text-align:center">
      <h2>Ventas de un determinado dia</h2>

        <h5 align:center>Selecciona un dia</h5>
        <form  method="POST">
              <div class="">
                <form method="post">
                <input  required class="form-control fecha" name="fecha"type="date" />
                </div>
                <br><br>
                <button class="btn btn-outline-success buscar" name="mandar" type="submit">Buscar</button><br>
                </form>
                <?php
                  
                if (isset($_POST['fecha'])) 
                {
                  $busqueda= $_POST['fecha'];
                ?>
     <table class="table fondo borde">
  <thead>
    
      <th scope="col">#</th>
      <th scope="col">CANTIDAD DE VENTAS</th>
      <th scope="col">TOTAL DE VENTA</th>
    
  </thead>
     <?php 
     $query = new Select();
     
     $cadena = "SELECT COUNT(TV.CANTIDAD_DE_VENTAS) as CANTIDAD_DE_VENTAS, SUM(TV.SUM_VENT) AS VENTAS_TOTALES  FROM (
      SELECT COUNT(VG.FECHA_DE_VENTA) AS 'CANTIDAD_DE_VENTAS', SUM(VG.PRECIO) AS 'SUM_VENT', VG.FECHA_DE_VENTA FROM (
      SELECT productos.nombre as 'PRODUCTO', productos.precio as 'PRECIO',
      detalle_orden.fecha_detalle AS 'FECHA_DE_VENTA', orden.reg as 'No. ORDEN',
      CONCAT(persona.nombre, ' ',persona.apellidos)as 'CLIENTE' FROM persona JOIN usuario ON persona.id_persona=usuario.persona
      JOIN orden on orden.usr=usuario.id_usr join detalle_orden on orden.reg = detalle_orden.orden JOIN productos ON detalle_orden.producto=productos.cve_prod) AS VG
      group by VG.FECHA_DE_VENTA, VG.PRECIO) AS TV
      WHERE TV.FECHA_DE_VENTA='$busqueda'
      ";
     
     $TV = $query->seleccionar($cadena);   
$f=1;
foreach ($TV as $registros){
 
  echo "<tr>";
  echo "<td> $f</td>";
  echo "<td> $registros->CANTIDAD_DE_VENTAS</td>";
  echo "<td><h3 > $$registros->VENTAS_TOTALES</h3></td>";
echo "</td>
      </tr>";
      $f++;
}
echo "</tbody>
</table></div>";
      }
    }
    else if ($vista == 4) {
?>
<?php  
      
      ?>
      
            </div>
           <br><br>
            <div class="col" style="text-align:center">
            <h2>Ventas totales en general</h2>
           <table class="table fondo borde">
        <thead>
          
            <th scope="col">#</th>
            <th scope="col">CANTIDAD DE VENTAS</th>
            <th scope="col">TOTAL DE VENTA</th>
          
        </thead>
           <?php 
           $query = new Select();
           
           $cadena = "SELECT COUNT(VG.FECHA_DE_VENTA) AS CANTIDAD_DE_VENTAS, SUM(VG.PRECIO) AS TOTAL_VENTAS FROM (
            SELECT productos.nombre as 'PRODUCTO', productos.precio as 'PRECIO',
            detalle_orden.fecha_detalle AS 'FECHA_DE_VENTA', orden.reg as 'No. ORDEN',
            CONCAT(persona.nombre, ' ',persona.apellidos)as 'CLIENTE' FROM persona JOIN usuario ON persona.id_persona=usuario.persona
            JOIN orden on orden.usr=usuario.id_usr join detalle_orden on orden.reg = detalle_orden.orden JOIN productos ON detalle_orden.producto=productos.cve_prod) AS VG            
            ";
           
           $TV = $query->seleccionar($cadena);   
      $f=1;
      foreach ($TV as $registros){
       
        echo "<tr>";
        echo "<td> $f</td>";
        echo "<td> $registros->CANTIDAD_DE_VENTAS</td>";
        echo "<td><h3 > $$registros->TOTAL_VENTAS</h3></td>";
      echo "</td>
            </tr>";
            $f++;
      }
      echo "</tbody>
      </table></div>";
            }
            else if ($vista == 5) {
              ?>
       
<?php  
      
      ?>
      
            </div>
           <br><br>
            <div class="col" style="text-align:center">
            <h2>Ventas totales en determinado periodo</h2><br><br>
            <label for="fecha_detalle" ><strong>Selecciona las fechas del periodo</strong></label><br>
              <form  method="POST">
              <div class="">
                <small>Fecha 1</small>
                <input  required class="form-control fecha" name="fecha1"type="date" />
                </div>
                <div class="">
                <small>Fecha 2</small> <input required class="form-control fecha" name="fecha2"type="date" />
                </div>
                <br>
                <button class="btn btn-outline-success buscar" name="mandar" type="submit">Buscar</button>
            </div>
              </form>
              <?php 
              if (isset($_POST['fecha1'])&&isset($_POST['fecha2'])) 
              {
                $fecha1= $_POST['fecha1'];
                $fecha2= $_POST['fecha2'];
                
              ?>
               
           <table class="table fondo borde">
        <thead>
          
            <th scope="col">#</th>
            <th scope="col">CANTIDAD DE VENTAS</th>
            <th scope="col">TOTAL DE VENTA</th>
          
        </thead>
           <?php 
           $query = new Select();
           
           $cadena = "SELECT  count(TV.CANTIDAD_DE_VENTAS) as 'CANTIDAD_VENTAS', SUM(TV.SUM_VENT) AS 'VENTAS_TOTALES'  FROM (
            SELECT COUNT(VG.FECHA_DE_VENTA) AS 'CANTIDAD_DE_VENTAS', SUM(VG.PRECIO) AS 'SUM_VENT', VG.FECHA_DE_VENTA FROM (
            SELECT productos.nombre as 'PRODUCTO', productos.precio as 'PRECIO',
            detalle_orden.fecha_detalle AS 'FECHA_DE_VENTA', orden.reg as 'No. ORDEN',
            CONCAT(persona.nombre, ' ',persona.apellidos)as 'CLIENTE' FROM persona JOIN usuario ON persona.id_persona=usuario.persona
            JOIN orden on orden.usr=usuario.id_usr join detalle_orden on orden.reg = detalle_orden.orden JOIN productos ON detalle_orden.producto=productos.cve_prod) AS VG
            group by VG.FECHA_DE_VENTA, VG.PRECIO) AS TV
            WHERE TV.FECHA_DE_VENTA between '$fecha1' and '$fecha2'
                      
            ";
           
           $TV = $query->seleccionar($cadena);   
      $f=1;
      foreach ($TV as $registros){
       
        echo "<tr>";
        echo "<td> $f</td>";
        echo "<td> $registros->CANTIDAD_VENTAS</td>";
        echo "<td><h3 > $$registros->VENTAS_TOTALES</h3></td>";
      echo "</td>
            </tr>";
            $f++;
      }
      echo "</tbody>
      </table></div>";
            }
          }
          
       else if ($vista == 6) {
        ?>
      
       
<?php  
      
      ?>
      
            </div>
           <br><br>
            <div class="col" style="text-align:center">
            <h2>Muestra de ventas de un dia</h2><br><br>
            <label for="fecha_detalle" ><strong>Selecciona el dia</strong></label><br>
              <form  method="POST">
              <div class="">
                <input  required class="form-control fecha" name="fecha1"type="date" />
                <br>
                <button class="btn btn-outline-success buscar" name="mandar" type="submit">Buscar</button><br>
                </div>
              </form>
              <?php 
              if (isset($_POST['fecha1'])) 
              {
                $fecha1= $_POST['fecha1'];
                
              ?>
               
           <table class="table fondo borde">
        <thead>
          
            <th scope="col">#</th>
            <th scope="col">Producto</th>
            <th scope="col">Precio al que se vendio</th>
            <th scope="col">Fecha de venta</th>
            <th scope="col">No. de orden</th>
            <th scope="col">Cliente</th>
          
        </thead>
           <?php 
           $query = new Select();
           
           $cadena = "SELECT RV.PRODUCTO, RV.PRECIO, RV.FECHA_DE_VENTA,RV.No_ORDEN,RV.CLIENTE FROM
           (SELECT productos.nombre as 'PRODUCTO', productos.precio as 'PRECIO',
           detalle_orden.fecha_detalle AS 'FECHA_DE_VENTA', orden.reg as 'No_ORDEN',
           CONCAT(persona.nombre, ' ',persona.apellidos)as 'CLIENTE' FROM persona JOIN usuario ON persona.id_persona=usuario.persona JOIN orden on 
           orden.usr=usuario.id_usr join detalle_orden on orden.reg = detalle_orden.orden JOIN productos ON detalle_orden.producto=productos.cve_prod)AS RV 
           WHERE RV.FECHA_DE_VENTA='$fecha1'
            ";
           
           $TV = $query->seleccionar($cadena);   
      $f=1;
      foreach ($TV as $registros){
       
        echo "<tr>";
        echo "<td> $f</td>";
        echo "<td> $registros->PRODUCTO</td>";
        echo "<td><h3 > $$registros->PRECIO</h3></td>";
        echo "<td> $registros->FECHA_DE_VENTA</td>";
        echo "<td> $registros->No_ORDEN</td>";
        echo "<td> $registros->CLIENTE</td>";
      echo "</td>
            </tr>";
            $f++;
      }
      echo "</tbody>
      </table></div>";
            }
          }
          else if ($vista == 7) {
            ?>
<?php  
      
      ?>
      
            </div>
           <br><br>
            <div class="col" style="text-align:center">
            <<div class="col" style="text-align:center">
            <h2>Muestra de ventas en determinado periodo</h2><br><br>
            <label for="fecha_detalle" ><strong>Selecciona las fechas del periodo</strong></label><br>
              <form  method="POST">
              <div class="">
                <small>Fecha 1</small>
                <input  required class="form-control fecha" name="fecha1"type="date" />
                </div>
                <div class="">
                <small>Fecha 2</small> <input required class="form-control fecha" name="fecha2"type="date" />
                </div>
                <br>
                <button class="btn btn-outline-success buscar" name="mandar" type="submit">Buscar</button>
            </div>
              </form>
              <?php 
              if (isset($_POST['fecha1'])&&isset($_POST['fecha2'])) 
              {
                $fecha1= $_POST['fecha1'];
                $fecha2= $_POST['fecha2'];
                
              ?>
               
           <table class="table fondo borde">
        <thead>
          
            <th scope="col">#</th>
            <th scope="col">Producto</th>
            <th scope="col">Precio al que se vendio</th>
            <th scope="col">Fecha de venta</th>
            <th scope="col">No. de orden</th>
            <th scope="col">Cliente</th>
          
        </thead>
           <?php 
           $query = new Select();
           
           $cadena = "SELECT RV.PRODUCTO, RV.PRECIO, RV.FECHA_DE_VENTA,RV.No_ORDEN,RV.CLIENTE FROM
           (SELECT productos.nombre as 'PRODUCTO', productos.precio as 'PRECIO',
           detalle_orden.fecha_detalle AS 'FECHA_DE_VENTA', orden.reg as 'No_ORDEN',
           CONCAT(persona.nombre, ' ',persona.apellidos)as 'CLIENTE' FROM persona JOIN usuario ON persona.id_persona=usuario.persona JOIN orden on 
           orden.usr=usuario.id_usr join detalle_orden on orden.reg = detalle_orden.orden JOIN productos ON detalle_orden.producto=productos.cve_prod)AS RV 
           WHERE RV.FECHA_DE_VENTA BETWEEN'$fecha1' AND '$fecha2'
            ";
           
           $TV = $query->seleccionar($cadena);   
      $f=1;
      foreach ($TV as $registros){
       
        echo "<tr>";
        echo "<td> $f</td>";
        echo "<td> $registros->PRODUCTO</td>";
        echo "<td><h3 > $$registros->PRECIO</h3></td>";
        echo "<td> $registros->FECHA_DE_VENTA</td>";
        echo "<td> $registros->No_ORDEN</td>";
        echo "<td> $registros->CLIENTE</td>";
      echo "</td>
            </tr>";
            $f++;
      }
      echo "</tbody>
      </table></div>";
            }
          }
      ?>

    <?php 
     }
      else
      {
        echo "<br><br><div class='alert alert-info'><h3 align='center'><strong>Por favor selecciona una opcion arriba</strong></h3></div>";
      }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>