<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $bd = "clima";
    
    $conn = mysqli_connect($server, $username, $password, $bd);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    require '../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};

    $sql = "SELECT * FROM clima";
    $resultado = $conn->query($sql);

    $excel = new Spreadsheet();
    $hoja = $excel->getActiveSheet();
    $hoja->setTitle("Clima");

    $hoja->setCellValue('A1', 'id');
    $hoja->setCellValue('B1', 'nombre');
    $hoja->setCellValue('C1', 'temp');
    $hoja->setCellValue('D1', 'temp_min');
    $hoja->setCellValue('E1', 'temp_max');

    $fila=2;

    while($row=$resultado->fetch_assoc()){
        $hoja->setCellValue('A'.$fila, $row['id']);
        $hoja->setCellValue('B'.$fila, $row['nombre']);
        $hoja->setCellValue('C'.$fila, $row['temp']);
        $hoja->setCellValue('D'.$fila, $row['temp_min']);
        $hoja->setCellValue('E'.$fila, $row['temp_max']);
        $fila++;
    }

    // redirect output to client browser
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Clima.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    
?>