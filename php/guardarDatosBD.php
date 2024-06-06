
<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// if ($_SERVER['REQUEST_METHOD'] != 'POST') {
//     http_response_code(405);
//     echo "Método no permitido";
//     exit;
// }

$server = "localhost";
$username = "root";
$password = "";
$bd = "clima";

$conn = mysqli_connect($server, $username, $password, $bd);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
// Imprimir los datos recibidos para depuración
file_put_contents('php://stderr', print_r($data, true));

if ($data) {
    $sql = "INSERT INTO clima (id, nombre, temp, temp_min, temp_max) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Vincular los parámetros a los marcadores de posición
        $stmt->bind_param("isdss", $data['id'], $data['nombre'], $data['temp'], $data['temp_min'], $data['temp_max']);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Datos guardados exitosamente";
        } else {
            echo "Error al guardar los datos: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
} else {
    echo "No se recibieron datos";
}
$conn->close();
?>