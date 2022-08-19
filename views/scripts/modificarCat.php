<?php
use MyApp\query\Ejecuta;
use MyApp\data\database;

if (!empty($_POST["btnmodifcarCa"])) 
{
        $queryM = new Ejecuta();
        extract($_POST);

        $id=$_POST["id"];
        $prenda=$_POST["prenda"];

        $update = "UPDATE categoria_prenda SET prenda='$prenda' WHERE cve_pcat = $id";

        $consulta = $queryM->ejecuta($update);
        
        header("refresh:3 ../views/AdminCategorias.php");
}
?>