<?php 

// require __DIR__ . '/vendor/autoload.php';

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

class Connection {
    public function obtDatos() {
        $server = "localhost";
        $user = "root";
        $password = "";
        $database = "diagnosticocctn";

        $con = mysqli_connect($server, $user, $password, $database);

        if ($con->connect_error) {
            die("Error al conectar con la db: " . $con->connect_error);
        }
        $query = "SELECT * FROM ciudades WHERE departamento='SANTANDER' ORDER BY ciudad ASC;";
        $datos = mysqli_query($con, $query);

        while($row = mysqli_fetch_assoc($datos)){
            $json[] = $row;
        };

        if ($datos == false) {
            return -1;
		}
		
        return $json;
    }
};