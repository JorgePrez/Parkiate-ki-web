

<?php


$query="UPDATE placas_entrada_salida SET id_auto='$id_auto' WHERE id_entrada_salida='$id_entrada_salida' AND id_parqueo='$id_parqueo'";

$resultadoupdatecar1 = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
pg_free_result($resultadoupdatecar1);




?>



