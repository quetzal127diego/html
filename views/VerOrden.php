<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
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
        background-color:background: #808080;
        background: -moz-linear-gradient(top, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);
        background: -webkit-linear-gradient(top, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);
        background: linear-gradient(to bottom, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);;
		background-size: 100vw 100vh;
		background-repeat: no-repeat;
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
    .fecha
    {
      width:50%;
      margin: auto;
    }
    .buscar
    {
      width:20%;
      margin: auto;
    }
    .contenedor
    {
      width: 100%;
      margin-left:19%;
    }
    .resaltar
    {
      text-decoration: strong;
    }
    .tamano
    {
        width:40%;
    }

    </style>
  </head>
  <body>
        <?php 
        use MyApp\Query\Select;
        use MyApp\Query\Ejecuta;
        include("components/navbar.php");
        $orden = $_GET["orden"];
        $query = new Select();

        $cadena = "SELECT RV.PRODUCTO, 
        RV.PRECIO, 
        RV.FECHA_DE_VENTA AS 'FECHA_DE_VENTA',
        RV.No_ORDEN,
        RV.CLIENTE 
        FROM (SELECT productos.nombre as 'PRODUCTO', 
        productos.precio as 'PRECIO', 
        detalle_orden.fecha_detalle AS 'FECHA_DE_VENTA', 
        orden.reg as 'No_ORDEN', 
        CONCAT(persona.nombre, ' ',persona.apellidos)as 'CLIENTE' 
        FROM persona JOIN usuario ON persona.id_persona=usuario.persona 
        JOIN orden on orden.usr=usuario.id_usr 
        JOIN detalle_orden on orden.reg = detalle_orden.orden 
        JOIN productos ON detalle_orden.producto=productos.cve_prod where detalle_orden.estado='Activo')AS RV
        WHERE RV.No_ORDEN = $orden
        ";

        $consulta = $query -> seleccionar($cadena);
        foreach($consulta as $registros)
      {
        ?>
        <br><br>
        <div class="container">
            <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color:black; color:white;">
                Datos de la orden
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Numero de la orden:
                <h5><?php echo $registros->No_ORDEN ?></h5>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Nombre del producto: <br> 
                <h5><?php echo $registros->PRODUCTO; ?></h5>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Precio:
                <h3><?php echo "$".$registros->PRECIO; ?></h3>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Fecha en de orden:
                <h5><?php echo $registros->FECHA_DE_VENTA ?></h5>
            </li>
        </ul></div>
        <br><br>
        <?php }?>
        <div class="row contenedor">
        <form action="" method="POST" class="tamano" enctype="multipart/form-data">
          <?php
          include "../views/scripts/daralta.php";
          ?>
                     <div class="col-lg-7">
                      <label for="nombre" class="form-label "><strong>Fecha en la que se hizo la entrega del producto</strong></label>
                      <input  required class="form-control" name="date" type="date" />
                    </div>
                        <br>
                    <div class="col-lg-5">
                      <label for="precio" class="form-label "><strong>Precio al que se vendio el producto</strong></label>
                      <input required type="text" name="precio"  class="form-control" placeholder="Escribe el precio del producto aqui">
                    </div>
                    <?php
                    echo "<input type='hidden' name='orden' value='$orden'>";
                    ?>
                    <br><br><br><br><br><br>
                    <div class="col-lg-12">
                <button type="submit" name="ordennnueva" class="btn btn-primary tamano" value="guardar">Confirmar Orden</button>
      </div>
        </form>
        </div>            
            
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>