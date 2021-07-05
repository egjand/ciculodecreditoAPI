<?php


$con = new mysqli("localhost","root","","proyecto");

$sql = "select * from circulodecredito";

$query = $con->query($sql);

if($query){
    echo "primero_nombre:  | ";
    echo "segundo_nombre:  | ";
    echo "apellido_paterno | ";
    echo "apellido_materno  \n ";
    while($r = $query->fetch_object()){
        echo $r->primer_nombre." | ";
        echo $r->segundo_nombre." | ";
        echo  $r->apellido_paterno." | ";
        echo  $r->apellido_meterno." \n ";
    }
}
header("Content-Transfer-Encoding: UTF-8");
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=reporte.csv");
header("Pragma: no-cache");
header("Expires: 0");
die;

?>