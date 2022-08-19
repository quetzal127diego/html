<?php
        use MyApp\query\Ejecuta;
        use MyApp\data\database;
        if (!empty($_POST["ordennnueva"])) 
        {
                if (isset($_POST['date']) && isset($_POST['precio']) && isset($_POST['orden']))
                {
                   
                    $update = new Ejecuta();
                    extract($_POST);
                    $ordenDet=$_POST["orden"];
                   
                    $precio=$_POST['precio'];
                    $date = date('Y-m-d');

                    $insercion= "UPDATE detalle_orden SET precio_venta='$precio', fecha_detalle='$date' WHERE orden=$ordenDet";
                    $updt = $update->ejecuta($insercion); 

                    echo "<div class='alert alert-success'>Orden confirmada correctamente </div>";

                }
            }
        ?>