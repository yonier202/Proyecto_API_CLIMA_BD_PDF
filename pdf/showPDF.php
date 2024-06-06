<?php
    require('PDF_modifier.php');

    $saya_pdf = new PDF_modifier();

    $saya_pdf->AddPage('P', 'Letter', 0);
    $saya_pdf->SetFont('Arial', 'B', 16);
    $saya_pdf->Cell(65);
    $saya_pdf->Cell(50,10, 'CLIMAS REGISTRADOS ', 0, 0, 'C');
    $saya_pdf->Line(10, 25, 200, 25);



    $saya_pdf->Ln(20);
    $saya_pdf->SetFont('Arial', 'B', 10);
    $saya_pdf->Cell(45,20, 'ID', 0, 0, 'C');
    $saya_pdf->Cell(45,20, 'Ciudad', 0, 0, 'C');
    $saya_pdf->Cell(45,20, 'Clima', 0, 0, 'C');
    $saya_pdf->Cell(45,20, 'Clima_Min', 0, 0, 'C');
    $saya_pdf->Line(10, 50, 200, 50);

    $conn = new mysqli("localhost", "root", "", "clima");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM clima";
    $result = $conn->query($query);

    $first = true;
    while($audit = $result->fetch_assoc()){
        // $auditorias[] = $audit;
        if($first){
            $saya_pdf->Ln(10);
        }else{
            $saya_pdf->Ln(6);
        }
        $saya_pdf->SetFont('Arial', '', 10);
        $saya_pdf->Cell(45,20, $audit['id'], 0, 0, 'C');
        $saya_pdf->Cell(45,20, $audit['nombre'], 0, 0, 'C');
        $saya_pdf->Cell(45,20, $audit['temp'], 0, 0, 'C');
        $saya_pdf->Cell(45,20, $audit['temp_min'], 0, 0, 'C');

        $first = false;
    }

    $conn->close();




    $saya_pdf->Output('I', 'Clima.pdf');

