<?php
require('fpdf/fpdf.php');

class PDF2 extends FPDF{
    function Header(){
        $this->SetFont('Arial','B',12);
        $this->Cell(180,10,'Time Off Report',0,1,'C');
        $this->Cell(35,10,'Employee ID',0,0,'C');
        $this->Cell(50,10,'Employee Name',0,0,'C');
        $this->Cell(35,10,'Date',0,0,'C');
        $this->Cell(35,10,'OT Hours',0,0,'C');
        $this->Cell(40,10,'Status',0,1,'C');
        $y=$this->GetY();
        $this->Line(10,20,199,20);
        $this->Line(10,20,10,285);
        $this->Line(199,20,199,285);
        $this->Line(10,285,199,285);
        $this->Line(10,$y,199,$y);
        $this->Line(45,20,45,285);
        $this->Line(95,20,95,285);
        $this->Line(135,20,135,285);
        $this->Line(170,20,170,285);
    }
}

$pdf = new PDF2();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);


$i = 0;

    for ($i = 0; $i < sizeof($leave_row2); $i++) {
            $vai = $leave_row2[$i]; 
            $pdf->Cell(35,10,$vai->employee_ID,0,0,'C');
            $pdf->Cell(50,10,$vai->name,0,0,'C');
            $pdf->Cell(35,10,$vai->date,0,0,'C');
            $pdf->Cell(35,10,$vai->ot_hours,0,0,'C');
            $pdf->Cell(40,10,$vai->status,0,1,'C');
            $y1=$pdf->GetY();
            $pdf->Line(10,$y1+2,199,$y1+2);
        }


$pdf->Output();
?>