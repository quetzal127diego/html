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
        
      background-color:background: #808080;
        background: -moz-linear-gradient(top, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);
        background: -webkit-linear-gradient(top, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);
        background: linear-gradient(to bottom, #808080 0%, #B3B3B3 50%, #C5C5C5 100%);;
		background-size: 1000vw 1000vh;
		background-repeat: no-repeat;
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

    </style>
  </head>
  <body>
  <?php

use MyApp\Query\Ejecuta;

?>
            <nav class="nav justify-content-center navbar-dark bg-dark ">
              <a class="nav-link disabled" href="#">Editar correo</a>
              <a class="nav-link clr-blanco" href="verperfil.php">Regresar</a>
              <a class="nav-link clr-blanco" href="http://localhost/pinchevicky/index.php">Inicio</a>
            </nav>

            <div class="container" style="width: 40%;">
                <br><br>
                
                <h1>Cambia tu correo</h1><br>
                <div class="row">
                  <div class="col-lg-12"><div class="mb-3">
                      <form action="EditarCorreo.php" method="POST">
                      <label for="nombre" class="form-label"><strong>Correo:</strong></label>
                     <input required type="text" name="correo" id="nombre" class="form-control borde" placeholder="Escribe el nombre del correo aqui">
                    </div>
                  
                    
              </div>
                
               
          </div>
               
        <div class="container-fluid h-100"> 
    		<div class="row w-100 align-items-center">
    			<div class="col text-center">
            <br>
    				<button type='submit' class="btn btn-success regular-button">Guardar</button>
    			</div>	
    		</div>
        </form>
        <?php 
               session_start();
              require("../../vendor/autoload.php");
              $correo="";
            
              if(isset($_POST["correo"])){
                $correo = $_POST['correo'];
                $user= $_SESSION['id'];
                 $queryS=new Ejecuta();
              
                 $cadena="UPDATE usuario SET usuario.correo='$correo' WHERE usuario.id_usr=$user";
                 $reg=$queryS->ejecuta($cadena);
                header('refresh:1 verPerfil.php');
              }
              
             
            ?>
              <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>