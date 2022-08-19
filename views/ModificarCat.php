<!doctype html>
<html lang="en">
  <head>
    <title>Modificar Producto</title>
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
		background-color:background: #808080;
        background: -moz-linear-gradient(top, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);
        background: -webkit-linear-gradient(top, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);
        background: linear-gradient(to bottom, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);;
		background-size: 1000vw 1000vh;
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
      width:8%;
      margin:auto;
      margin-left:15px;
      margin-right:15px;      
      margin-top:15px;
      padding: 6px;
    }
    .imagensita
    {
      width:60px;
    }

    </style>
  </head>
  <body>
  <?php
    use MyApp\Query\Select;
    require("../vendor/autoload.php");
?>
            <nav class="nav justify-content-center navbar-dark bg-dark ">
              <a class="nav-link disabled" href="">Modificar Producto</a>
              <?php
                echo "<a class='nav-link clr-blanco' href='AdminProd.php'>Regresar</a>";
                
                echo "<a class='nav-link clr-blanco' href='http://localhost/pinchevicky/'>Inicio</a>";
              ?>
              
            </nav>

            <!-- Tabla select -->


              <div class="md-6">              <br>
                <h1 align="center">Buscar productos</h1>

                <br>
              </div>
              <form class="d-flex">
                <button class="btn btn-success" name="refresh" type="submit"><strong>Refrescar</strong></button>
                <input onkeyup="$enviar" class="form-control me-2" name="busqueda" type="search" placeholder="Escribe algo relacionado con el producto (nombre, categoria, talla, etc)" aria-label="Search">
                <button class="btn btn-success" name="enviar" type="submit"><strong>Buscar</strong></button>
              </form>
              <br>
              <?php

                  
                if (isset($_GET['enviar'])) 
                {
                  $busqueda= $_GET['busqueda'];

                  require("../vendor/autoload.php");
                  
                  $query = new Select();

                  $cadena = "SELECT * FROM categoria_prenda WHERE cve_pcat LIKE '%$busqueda%' OR prenda LIKE '%$busqueda%'";

                  $tabla = $query->seleccionar($cadena);
 
                  echo 
                  "<table class='table table-hover align='left'>
                  <thead class='table-dark'>
                  <tr>
                  <th> ID_Categoria</th>
                  <th> Categoria</th>
                  <th> Modificar </th>
                  </tr>
                  </thead>
                  <tbody>";

                  foreach($tabla as $registros)
                  {
                    
                    echo "<tr>";
                    echo "<td> $registros->cve_pcat</td>";
                    echo "<td> $registros->prenda </td>";
                    echo " <td><a href='EstasmodCat.php?id=$registros->cve_pcat' class='list-group-item list-group-item-action flex-column align-items-start'>
                          <small><img src='../src/img/editar.png' alt='' width='20px'></small>
                          </a>";
                  echo "</td>
                        </tr>";
                  }
                  echo "</tbody>
                  </table>";
                  
                }
                else if (!isset($_GET['enviar'])) 
                {
                require("../vendor/autoload.php");
                
                $query = new Select();

                $cadena = "SELECT * FROM categoria_prenda";

                  $tabla = $query->seleccionar($cadena);
 
                  echo 
                  "<table class='table table-hover align='left'>
                  <thead class='table-dark'>
                  <tr>
                  <th> ID_Categoria</th>
                  <th> Categoria</th>
                  <th> Modificar </th>
                  </tr>
                  </thead>
                  <tbody>";
                  echo "<td colspan='3'> <h1>Que categoria vas a buscar? Ingresar datos en el buscador </h1></td>";
                  echo "</tbody>
                  </table>";
              }
                ?>              
                </div>
            </div>    
            </div>
          </div>
              <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>