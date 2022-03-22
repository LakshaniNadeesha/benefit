<?php
require('fpdf/fpdf.php');

class PDF3 extends FPDF{
    function Header(){
        $this->SetFont('Arial','B',16);
        $this->SetTextColor(0,0,139);
        $this->Cell(180,10,'Time Off Report',0,1,'C');
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',11);
        $this->Cell(40,10,'Employee ID',0,0,'C');
        $this->Cell(60,10,'Employee Name',0,0,'C');
        $this->Cell(50,10,'Date',0,0,'C');
        $this->Cell(40,10,'OT Hours',0,1,'C');
        $y=$this->GetY();
        $this->Line(10,20,199,20);
        $this->Line(10,20,10,285);
        $this->Line(199,20,199,285);
        $this->Line(10,285,199,285);
        $this->Line(10,$y,199,$y);
        $this->Line(55,20,55,285);
        $this->Line(115,20,115,285);
        $this->Line(160,20,160,285);
       
    }
}

$pdf = new PDF3();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);


$i = 0;

    for ($i = 0; $i < sizeof($leave_row1); $i++) {
            $vai = $leave_row1[$i]; 
            $pdf->Cell(40,10,$vai->employee_ID,0,0,'C');
            $pdf->Cell(60,10,$vai->name,0,0,'C');
            $pdf->Cell(50,10,$vai->date,0,0,'C');
            $pdf->Cell(40,10,$vai->ot_hours,0,1,'C');
            $y1=$pdf->GetY();
            $pdf->Line(10,$y1+2,199,$y1+2);
        }


$pdf->Output();
?>