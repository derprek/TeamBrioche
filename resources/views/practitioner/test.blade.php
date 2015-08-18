<?php 		
include 'fpdf.php';
include 'font/helveticab.php';
include 'font/helveticabi.php';


$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);

$pdf->Cell(40,10,  'Question 1: '. $questions[0]->question );
$pdf->Ln(10);
$pdf->Cell(40,10,  'Answer:' . $managers[0]->answers );
$pdf->Ln(20);

$pdf->Cell(40,10,  'Question 2: '. $questions[1]->question );
$pdf->Ln(10);
$pdf->Cell(40,10,  'Answer:' . $managers[1]->answers );
$pdf->Ln(20);

$pdf->Cell(40,10,  'Question 3: '. $questions[2]->question );
$pdf->Ln(10);
$pdf->Cell(40,10,  'Answer:' . $managers[2]->answers );
$pdf->Ln(20);

$pdf->Cell(40,10,  'Question 4: '. $questions[3]->question );
$pdf->Ln(10);
$pdf->Cell(40,10,  'Answer:' . $managers[3]->answers );
$pdf->Ln(20);

$pdf->Cell(40,10,  'Question 5: '. $questions[4]->question );
$pdf->Ln(10);
$pdf->Cell(40,10,  'Answer:' . $managers[4]->answers );
$pdf->Ln(20);

$pdf->Cell(40,10,  'Question 6: '. $questions[5]->question );
$pdf->Ln(10);
$pdf->Cell(40,10,  'Answer:' . $managers[5]->answers );
$pdf->Ln(20);

$pdf->Cell(40,10,  'Question 7: '. $questions[6]->question );
$pdf->Ln(10);
$pdf->Cell(40,10,  'Answer:' . $managers[6]->answers );
$pdf->Ln(20);

$pdf->Cell(40,10,  'Question 8: '. $questions[7]->question );
$pdf->Ln(10);
$pdf->Cell(40,10,  'Answer:' . $managers[7]->answers );
$pdf->Ln(20);

$pdf->Cell(40,10,  'Question 9: '. $questions[8]->question );
$pdf->Ln(10);
$pdf->Cell(40,10,  'Answer:' . $managers[8]->answers );
$pdf->Ln(20);

$pdf->Output();

?>