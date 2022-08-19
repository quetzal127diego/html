<!doctype html>
<html lang="en">
  <head>
    <title>BZshop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="cards.css">
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
		background-color:background: #808080;
        background: -moz-linear-gradient(top, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);
        background: -webkit-linear-gradient(top, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);
        background: linear-gradient(to bottom, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);;
		background-size: 10000vw 10000vh;
		background-repeat: no-repeat;
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
    </style>
  </head> 
  
  <body>

  <?php
  require('../scripts/validarUser.php');
  
    require('../components/navbar.php');
    
   
    $correo=$_SESSION["correo"];
    $nombre=$_SESSION["nombre"];
    $apellido=$_SESSION["apellidos"];
    $tel=$_SESSION["tel"];
    
   
  ?> 
 
    
<h1 class="titulo">Historial de compras y ordenes</h1>

<!----------------------- Venta General------------------------------------------------------------------------------------------->

    <?php
     use MyApp\Query\Select;
     require("../../vendor/autoload.php");
     $query = new Select();
     
     $cadena = "SELECT fecha_orden, reg, reg_det, orden, fecha_detalle, producto, unidades, estado, precio_venta, cve_prod, nombre, precio, imagen FROM orden JOIN detalle_orden ON orden.reg=detalle_orden.reg_det JOIN productos on detalle_orden.producto=productos.cve_prod 
     join usuario on orden.usr = usuario.id_usr WHERE correo='$correo'";
     
     $VG = $query->seleccionar($cadena); 
     ?>
     <br><br>
     <div class="row">
      <div class="col">
      <h2>Ordenes</h2>
     <table class="table fondo">
  <thead>
    
      <th scope="col">#</th>
      <th scope="col">Producto</th>
     
      <th scope="col">Fecha de orden</th>
      <th scope="col">No. Orden</th>
      <th scope="col">Imagen</th>
    
  </thead>
    
<?php   
$i=1;
foreach ($VG as $registros){
 
  echo "<tr>";
  echo "<td> $i</td>";
  echo "<td> $registros->nombre</td>";
  
  echo "<td> $registros->fecha_orden </td>";
  echo "<td> <h4>$registros->orden </h4></td>";
  echo "<td> <img style='max-width:60pt;' src='../scripts/$registros->imagen?>'> </td>";
echo "</td>
      </tr>";
      $i++;
}
echo "</tbody>
</table>";
?>
      </div>
     <br><br>
      <div class="col">
      <h2>Compras recogidas en bazar</h2>
     <table class="table fondo">
  <thead>
    
      <th scope="col">#</th>
      <th scope="col">No. Compra</th>
      <th scope="col">Producto</th>
      <th scope="col">Precio</th>
      <th scope="col">Fecha de Compra</th>
      <th scope="col">Imagen</th>
    
  </thead>
     <?php 
     $query = new Select();
     
     $cadena2 = "SELECT fecha_orden, reg, reg_det as geo, orden, fecha_detalle, producto, unidades, estado, precio_venta, cve_prod, nombre, precio, imagen  FROM orden JOIN detalle_orden ON orden.reg=detalle_orden.reg_det JOIN productos on detalle_orden.producto=productos.cve_prod 
     join usuario on orden.usr = usuario.id_usr WHERE correo='$correo'";
     
     $PVC = $query->seleccionar($cadena2);   
$f=1;
foreach ($PVC as $registros){
 
  echo "<tr>";
  echo "<td> $f</td>";
  echo "<td> $registros->reg</td>";
  echo "<td><h4 >$registros->nombre</h4></td>";
  echo "<td> $registros->precio_venta</td>";
  echo "<td> $registros->fecha_detalle</td>";
  echo "<td> <img style='max-width:60pt;' src='../scripts/$registros->imagen?>'> </td>";
echo "</td>
      </tr>";
      $f++;
}
echo "</tbody>
</table>";
?>
      </div>
<!-- inicio del usuario-->

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>