<?php
require('../fpdf/fpdf.php');
class PDF_modifier extends FPDF{
    function Header()
    {
        // $this->Line(0,25, 300,25);
        $this->Line(10, 11, 200, 11);
        // Select Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Framed title
        $this->Cell(60);
        $this->Image('logopng.png', 60, 0, 0, 10);

        $this->Cell(80, -10, 'SAYA.SAS', 0, 0, 'C');
        // Line break
        $this->Ln(5);
    }

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        $this->SetLineWidth(0.5);
        $this->Line(0,265, 280,265);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 10);
        // Print centered page number
        $this->Cell(0, 10, 'Pagina '.$this->PageNo(), 0, 0, 'L');
        $this->Cell(0, 10, 'SAYA.SAS', 0, 0, 'R');
    }
}