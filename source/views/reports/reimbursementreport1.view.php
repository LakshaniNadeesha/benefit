<?php
require('fpdf/fpdf.php');

class PDF1 extends FPDF{
    function Header(){
        $this->SetFont('Arial','B',12);
        $this->Cell(180,10,'Reimbursement Report',0,1,'C');
        $this->Cell(35,10,'Employee ID',0,0,'C');
        $this->Cell(40,10,'Handled Date',0,0,'C');
        $this->Cell(40,10,'Claim Amount',0,0,'C');
        $this->Cell(40,10,'Reason',0,0,'C');
        $this->Cell(40,10,'Status',0,1,'C');
        $y=$this->GetY();
        $this->Line(10,20,199,20);
        $this->Line(10,20,10,285);
        $this->Line(199,20,199,285);
        $this->Line(10,285,199,285);
        $this->Line(10,$y,199,$y);
        $this->Line(45,20,45,285);
        $this->Line(85,20,85,285);
        $this->Line(125,20,125,285);
        $this->Line(165,20,165,285);
    }
}

$pdf = new PDF1();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);


$i = 0;

    for ($i = 0; $i < sizeof($reim_row1); $i++) {
            $vai = $reim_row1[$i]; 
            $pdf->Cell(35,10,$vai->employee_ID,0,0,'C');
            $pdf->Cell(40,10,$vai->handled_date,0,0,'C');
            $pdf->Cell(40,10,$vai->claim_amount,0,0,'C');
            $pdf->Cell(40,10,$vai->reimbursement_reason,0,0,'C');
            $pdf->Cell(40,10,$vai->reimbursement_status,0,1,'C');
            $y1=$pdf->GetY();
            $pdf->Line(10,$y1+2,199,$y1+2);
        }


$pdf->Output();
?>