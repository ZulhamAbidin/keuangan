<?php

ob_start();
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->Image('../log.png',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'LAPORAN DATA PENJUALAN',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon :082378250151 ',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Saphire Lounge',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Jambi Selatan',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'Laporan data Penjualan',0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1.5, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(12, 0.8, 'Jumlah (Rp)', 1, 0, 'C');
$pdf->ln();

$no=1;
include '../koneksi.php';

$tanggal1 = date('Y-m-d', strtotime($_POST['tanggal1']));
$tanggal2 = date('Y-m-d', strtotime($_POST['tanggal2']));


$query=mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE tanggal_jual BETWEEN '$tanggal1' AND '$tanggal2'");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1.5, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(6, 0.8, $lihat['tanggal_jual'],1, 0, 'C');
	$pdf->Cell(6, 0.8, $lihat['nama_barang'],1, 0, 'C');
	$pdf->Cell(12, 0.8, 'Rp. '. number_format($lihat['jumlah_jual']), 1, 0,'C');
	$pdf->ln();
	$no++;
}

$query1 = mysqli_query($koneksi, "SELECT sum(jumlah_jual) as jumlahJual FROM data_penjualan WHERE tanggal_jual BETWEEN '$tanggal1' AND '$tanggal2'");
$data1  = mysqli_fetch_array($query1);
	$pdf->Cell(13.5, 0.8,'Total Pendapatan',1, 0, 'C');
	$pdf->Cell(12, 0.8,'Rp. '. number_format($data1['jumlahJual']), 1, 0, 'C');

$pdf->ln();
$pdf->SetFont('Arial','B',10);

$pdf->Cell(24.3,1.7," Jambi, ".date("D-d/m/Y"),0,0,'R');
$pdf->ln();
$pdf->Cell(24,0.7,'PEMILIK USAHA',0,0,'R');
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->Cell(23.7,0.7,'Sri Wardhani',0,0,'R');

$pdf->Output("laporan_data_penjualan.pdf","I");

?>

