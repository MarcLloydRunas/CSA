<?php 
session_start();
require_once("../../../../db/config.php");

$acc_id_number = "";

if (isset($_SESSION['pass_id_number'])) {
    $acc_id_number = $_SESSION['pass_id_number'];
}else{
    $acc_id_number = "no id number found";
}

$tz = date_default_timezone_get();
$custdate = date("F j, Y",strtotime($tz));

require('../../../../fpdf184/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();

// code for print Heading of tables
$pdf->SetFont('Arial','B',11);	

$pdf->Image('../../../../img/logo_v4.png',96,280,15);

$pdf->Write(5,'Activity Logs Report                                                                                             '.$custdate,'C');
$pdf->Ln();
$pdf->Ln();

$width_cell=array(47.5,47.5,47.5,47.5);
$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'ID Number',1,0,'C',true); // First header column 
$pdf->Cell($width_cell[1],10,'Activity',1,0,'C',true); // Second header column
$pdf->Cell($width_cell[2],10,'Counselor ID',1,0,'C',true); // Second header column
$pdf->Cell($width_cell[3],10,'Date',1,0,'C',true); // Third header column 

//code for print data
$sql = "SELECT log_id, appointment, receiver, date FROM  activity_log WHERE (log_id = '$acc_id_number')";
$query = $pdo -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{

foreach($results as $row) {
	$counter = 1;
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();
	foreach($row as $column){
		if($counter == 2){
            $pdf->Cell(52,11,$column,1,0,'C');
        }else{
            $pdf->Cell(46,11,$column,1,0,'C');
        }
        ++$counter;
    }
		
} }
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Write(5,'                                                                                                                                               ________________________','C');
$pdf->Ln();
$pdf->Write(5,'                                                                                                                                                                                         <staff position>','C');
$pdf->Ln();
$pdf->Output();
?>