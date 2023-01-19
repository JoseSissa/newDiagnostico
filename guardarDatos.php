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
echo "<pre>";
print_r($_FILES['adjuntar_balance_general']);
echo "</pre>";
$adjuntar_estado_de_resultado = "Probando los archivos 2";
echo "<pre>";
print_r($_FILES['adjuntar_estado_de_resultado']);
echo "</pre>";
$adjuntar_declaracion_renta = "Probando los archivos 3";
echo "<pre>";
print_r($_FILES['adjuntar_declaracion_renta']);
echo "</pre>";
$consulta_centrales_de_riesgo = $_POST['consulta_centrales_de_riesgo'];

if($valor_solicitado === "") {
    header("Status: 301 Moved Permanently");
    header("Location: https://localhost/newDiagnostico/si.html");
}

$con = mysqli_connect($server, $user, $password, $database);

$filenameBalanceGeneral = "documento_BalanceGeneral" . "_" . $nit . "_" . date("Y_m_d_H_i_s");
$filenameEstadoResultado = "documento_EstadoResultado"  . "_" . $nit . "_" . date("Y_m_d_H_i_s");
$filenamedeclaracionRenta = "documento_DeclaracionRenta" . "_" . $nit . "_" . date("Y_m_d_H_i_s");

$uploadOk = 1;

$locationBG = "Uploaded/BalanceGeneral/" . $filenameBalanceGeneral;
$locationER = "Uploaded/EstadoResultado/" . $filenameEstadoResultado;
$locationDR = "Uploaded/DeclaracionRenta/" . $filenamedeclaracionRenta;

$imageFileTypeBG = pathinfo($_FILES['adjuntar_balance_general']['name'], PATHINFO_EXTENSION);
$imageFileTypeER = pathinfo($_FILES['adjuntar_estado_de_resultado']['name'], PATHINFO_EXTENSION);
$imageFileTypeDC = pathinfo($_FILES['adjuntar_declaracion_renta']['name'], PATHINFO_EXTENSION);

$valid_extensions = array("jpg","jpeg","png","pdf","xlsx");
if ( !in_array(strtolower($imageFileTypeBG),$valid_extensions) ) {
    $uploadOk = 0;
}
if ( !in_array(strtolower($imageFileTypeER),$valid_extensions) ) {
    $uploadOk = 0;
}
if ( !in_array(strtolower($imageFileTypeDC),$valid_extensions) ) {
    $uploadOk = 0;
}

$locationBG = $locationBG . "." . $imageFileTypeBG;
$locationER = $locationER . "." . $imageFileTypeER;
$locationDR = $locationDR . "." . $imageFileTypeDC;

if ($uploadOk == 0){
    return 0;
}else {
    move_uploaded_file($_FILES['adjuntar_balance_general']['tmp_name'], $locationBG);
    move_uploaded_file($_FILES['adjuntar_estado_de_resultado']['tmp_name'], $locationER);
    move_uploaded_file($_FILES['adjuntar_declaracion_renta']['tmp_name'], $locationDR);
}



$query = "INSERT INTO empresas (id, valor_solicitado, plazo, destino_credito, nombre_empresa, nit, direccion_empresa, ciudad_empresa, numero_contacto_empresa, antiguedad_empresa, migrante_retornado, adjuntar_balance_general, adjuntar_estado_de_resultado, adjuntar_declaracion_renta, consulta_centrales_de_riesgo) VALUES (null, '$valor_solicitado', '$plazo', '$destino_credito', '$nombre_empresa', '$nit', '$direccion_empresa', '$ciudad_empresa', '$numero_contacto_empresa', '$antiguedad_empresa', '$migrante_retornado', '$locationBG', '$locationER', '$locationDR', '$consulta_centrales_de_riesgo')";

// $datos = mysqli_query($con, $query);

// echo $datos;

?>