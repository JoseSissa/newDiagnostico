<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "diagnosticocctn";

$con = mysqli_connect($server, $user, $password, $database);

if ($con->connect_error) {
    die("Error al conectar con la db: " . $con->connect_error);
}

$valor_solicitado = $_POST['valor_solicitado'];
$plazo = $_POST['plazo'];
$destino_credito = $_POST['destino_credito'];
$nombre_empresa = $_POST['nombre_empresa'];
$nit = $_POST['nit'];
$direccion_empresa = $_POST['direccion_empresa'];
$ciudad_empresa = $_POST['ciudad_empresa'];
$numero_contacto_empresa = $_POST['numero_contacto_empresa'];
$antiguedad_empresa = $_POST['antiguedad_empresa'];
$migrante_retornado = $_POST['migrante_retornado'];
$adjuntar_balance_general = "Probando los archivos 1";
// $_POST['adjuntar_balance_general'];
$adjuntar_estado_de_resultado = "Probando los archivos 2";
// $_POST['adjuntar_estado_de_resultado'];
$adjuntar_declaracion_renta = "Probando los archivos 3";
// $_POST['adjuntar_declaracion_renta'];
$consulta_centrales_de_riesgo = $_POST['consulta_centrales_de_riesgo'];

$con = mysqli_connect($server, $user, $password, $database);

echo "<pre>";
echo "valor_solicitado: ", $valor_solicitado, "<br>";
echo "plazo: ", $plazo, "<br>";
echo "destino_credito: ", $destino_credito, "<br>";
echo "nombre_empresa: ", $nombre_empresa, "<br>";
echo "nit: ", $nit, "<br>";
echo "direccion_empresa: ", $direccion_empresa, "<br>";
echo "ciudad_empresa: ", $ciudad_empresa, "<br>";
echo "numero_contacto_empresa: ", $numero_contacto_empresa, "<br>";
echo "antiguedad_empresa: ", $antiguedad_empresa, "<br>";
echo "migrante_retornado: ", $migrante_retornado, "<br>";
echo "adjuntar_balance_general: ", $adjuntar_balance_general, "<br>";
echo "adjuntar_estado_de_resultado: ", $adjuntar_estado_de_resultado, "<br>";
echo "adjuntar_declaracion_renta: ", $adjuntar_declaracion_renta, "<br>";
echo "consulta_centrales_de_riesgo;: ", $consulta_centrales_de_riesgo, "<br>";
echo "</pre>";
    
$query = "INSERT INTO empresas (id, valor_solicitado, plazo, destino_credito, nombre_empresa, nit, direccion_empresa, ciudad_empresa, numero_contacto_empresa, antiguedad_empresa, migrante_retornado, adjuntar_balance_general, adjuntar_estado_de_resultado, adjuntar_declaracion_renta, consulta_centrales_de_riesgo) VALUES (null, '$valor_solicitado', '$plazo', '$destino_credito', '$nombre_empresa', '$nit', '$direccion_empresa', '$ciudad_empresa', '$numero_contacto_empresa', '$antiguedad_empresa', '$migrante_retornado', '$adjuntar_balance_general', '$adjuntar_estado_de_resultado', '$adjuntar_declaracion_renta', '$consulta_centrales_de_riesgo')";

$datos = mysqli_query($con, $query);

return $datos;

?>