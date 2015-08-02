<?php
	include_once('config.php');
	require('C:\xampp\php\pear\fpdf\fpdf.php'); 

class PDF extends FPDF {
 
function Header() {
	//$this->Image("D:\logo.jpg", (4.5/2)-1.5, 0.5, 3, 1, "JPG","www.verizon.com");
	//$this->Image("D:\logo.jpg",170,8,30);
    $this->SetFont('Times','',14);
    $this->SetY(0.25);
	$this->Cell(0, .25, " Vz-BOSS ", 'T', 2, "C");
	$this->SetY(0.25);
    //reset Y
    $this->SetY(1);
}
 
function Footer() {
//This is the footer; it's repeated on each page.
//enter filename: phpjabber logo, x position: (page width/2)-half the picture size,
//y position: rough estimate, width, height, filetype, link: click it!
    //$this->Image("D:\logo.jpg", (4.5/2)-1.5, 9.8, 3, 1, "JPG","www.verizon.com");
}
 
}

/*define('DB_HOST1', 'localhost'); 
define('DB_NAME1', 'vbass'); 
define('DB_USER1','root'); 
define('DB_PASSWORD1',''); 
$con=mysql_connect(DB_HOST1,DB_USER1,DB_PASSWORD1) or die("Failed to connect to MySQL: " . mysql_error());

mysql_select_db('DB_NAME1',$con) or die("Failed to connect to MySQL: " . mysql_error());*/
//echo 'I am here'; exit;
if(isset($_GET['file_name']))
{
	
	$ename = $_GET['file_name'];
$pdf=new PDF("P","in","Letter");
$pdf->SetMargins(1.5,1.5,1.5);
$pdf->AddPage();

$pdf->SetFont('Times','',12);

$pdf->Ln();
$pdf->Ln();

        $sql = "select e.ent_ins_name,a.line1,a.line2,a.zip_code,a.state,a.country,b.period_st_dt,
b.period_ed_dt,b.tnx_desc,b.txn_base_amt,b.txn_qty,b.tax_amt,b.txn_amt
 From ADDRESS_HISTORY_TR a, bill_gen_det b, ent_inst_tr e, version v where 
b.ent_inst_id = e.ent_inst_id
and e.address_id = a.address_id
and v.ent_vr_catg = 'CU'
and v.ver_date = (select max(ver_date) from version where ent_vr_catg ='CU')
and e.ent_vr_nr = v.ent_vr_nr
and e.ent_ins_name = '". $ename ."'";

        $result = mysql_query($sql);
		if (!$result) {
			printf("Error:sads %s\n", mysql_error($con));
			exit();
		}
   $i = 0;    
        while($rows=mysql_fetch_array($result))
        {
			
			$AccName = 'Account Name';
			$accname = $rows[0];
			$addline1 = $rows[1];
			$addline2 = $rows[2];
			$addline3 = $rows[3];
			$addline4 = $rows[4];
			$addline5 = $rows[5];
			$payment_date = $rows[7];
			$desc = "Charge Details - ".$rows[8];
			$baseamt = $rows[9];
			$qty = $rows[10];
			$tax = $rows[11];
			$total = $rows[12] + $tax;
			$charge =$baseamt;
			
			if($qty != '' and $qty > 0)
			{
			$charge =$baseamt*$qty; 
			}
			else{
				$qty = 0;
			}
				
			
			$Address = 'Address';
			$EffDate = $rows[6];
			$Line1="Monthly Charges as on ".$EffDate;
			$Line2="Tax applied @ 10% ";
			$Line3="Total Charges  ";
			
			if($i == 0)
			{

            $pdf->SetFillColor(240, 100, 100);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(0,.25, "Bill for the month ".$EffDate, 1, 2, "C", 1);
			
			$pdf->SetFillColor(240, 100, 100);
			$pdf->SetFont('Times','B',12);
			  

			$pdf->Cell(0,.25, "Customer Details", 1, 2, "C", 1);
			  
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0, 0.20, $AccName, 1, 0, 'L');
            $pdf->Cell(0, 0.20, $accname, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $Address, 1, 0, 'L');
            //$pdf->Cell(0, 0.20, $address, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $addline1, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $addline2, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $addline3, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $addline4, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $addline5, 1, 1, 'R');
			$pdf->Cell(0, 0.20, "Payment Date", 1, 0, 'L');
            $pdf->Cell(0, 0.20, $payment_date , 1, 1, 'R');
						
			 //$pdf->Multicell(0,1,"\n");
			 
			}
			$pdf->Multicell(0,0.5,"\n");
			$pdf->SetFillColor(240, 100, 100);
			$pdf->SetFont('Times','B',12);
			  
			
			$pdf->Cell(0, .25, $desc, 1, 2, "C", 1);
			  
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0, 0.20, 'Base Amount', 1, 0, 'L');
			$pdf->Cell(0, 0.20, $baseamt, 1, 1, 'R');
			$pdf->Cell(0, 0.20, 'Quantity', 1, 0, 'L');
			$pdf->Cell(0, 0.20, $qty, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $Line1, 1, 0, 'L');
            $pdf->Cell(0, 0.20, $charge, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $Line2, 1, 0, 'L');
            $pdf->Cell(0, 0.20, $tax, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $Line3, 1, 0, 'L');
            $pdf->Cell(0, 0.20, $total, 1, 1, 'R');
			//$pdf->Multicell(0,1,"\n");
		$i++;
        }
$file = $accname.".pdf";		
$filename = $_SERVER['DOCUMENT_ROOT'].'/vboss/PDF/'.$file;
$pdf->Output($filename,'F');
$pdf->close();

header("Location: download_pdf.php?file_name=".$file);
exit;
}
