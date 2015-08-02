<?php
	include_once('config.php');	
?>

<script>
	$(document).ready(function()
	{
		$('#menu li a').removeClass('active');
		$('#menu #performbillrun a').addClass('active');
		
		$('body').animate({scrollTop :450}, 2000);
	});	
	
  $(function() {
    $( "#datepicker" ).datepicker();
  });
	
</script>  
<div><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">Load Rules</font></h2></center></div>
<div style="width:100%;float:left" > <br> <br>
<form action = "" method = "post"">
<div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name" align="center">Enter File Name<span>*</span></div>
										<div class="contactpage_textbox" align="center"><input type="text" name="FileName" class="cpagetextbox_text"/></div>
									 </div> <br>
									  <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="conatctpage_submit" align="center"><input type="submit" name="StartRulesLoad" class="sub_button" value="submit"/></div>
									  </div>
									  </form>
									 
</div>

<?php
//  Include PHPExcel_IOFactory
include 'C:\xampp\htdocs\vboss\PHPExcel\Classes\PHPExcel\IOFactory.php';
//echo "I am Here"; exit();
if (isset($_POST['StartRulesLoad'])) 
{ 
$inputFileName = $_POST['FileName'];
//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$loadSheets = array('Sheet1', 'Sheet2','Sheet3');
	$objReader->setLoadSheetsOnly($loadSheets);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$i =0;
$error = 0 ;
$starttime = date("h:i:sa");
$brstart = microtime(true);
//while($objPHPExcel->setActiveSheetIndex($i))
for ($i =0 ; $i <3; $i++ )
{
	
	if($i == 3){
		break;
	}
//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet($i); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
//$dbc=mysql_connect('localhost','root','root','shop');
//  Loop through each row of the worksheet in turn
// Starting from 2 to ignore the header
//$error = 0 ;
//$starttime = date("h:i:sa");
//$brstart = microtime(true);

$line = "";

for ($row = 2; $row <= $highestRow; $row++)
{ 
    //  Read a row of data into an array
	
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);

	if($i == 0){
	$ent_rule_id = $rowData[0][0];
	$ent_prod_id =$rowData[0][1];
	$ent_id = $rowData[0][2];
	$ent_chg_type =$rowData[0][3];
	$ent_pro_rate =$rowData[0][4];
	$ent_amt =$rowData[0][5];
	$ent_tax_per =$rowData[0][6];
	$ent_ver =$rowData[0][7];
	
	$line = $line . "('$ent_rule_id','$ent_prod_id','$ent_id','$ent_chg_type','$ent_pro_rate','$ent_amt','$ent_tax_per','$ent_ver'),";
	}
	if($i == 1){
	$ent_prod_id = $rowData[0][0];
	$ent_prod_name =$rowData[0][1];
	$ent_ver =$rowData[0][2];
	
	$line = $line . "('$ent_prod_id','$ent_prod_name','$ent_ver'),";
	}
	if($i == 2){
	$ent_id = $rowData[0][0];
	$ent_name =$rowData[0][1];
	$attr1 = $rowData[0][2];
	$attr2 =$rowData[0][3];
	$attr3 =$rowData[0][4];
	$attr4 =$rowData[0][5];
	$attr5 =$rowData[0][6];
	$ent_bill_cat =$rowData[0][7];
	$ent_ver =$rowData[0][8];
	
	$line = $line . "('$ent_id','$ent_name','$attr1','$attr2','$attr3','$attr4','$attr5','$ent_bill_cat','$ent_ver'),";
	}
}

$line = rtrim($line,",");


if($i ==0){
	$sql = "INSERT INTO entity_prod_rule (ENT_RULE_ID, ENT_PROD_ID, ENTITY_ID, ENT_CHG_TYPE, ENT_PRORATE, ENT_AMT, ENT_TX_PER, ENT_VR_NR) VALUES". $line ;
}
if($i==1)
{
	$sql ="INSERT INTO entity_prod (ENT_PROD_ID,ENT_PROD_NAME,ENT_VR_NR) VALUES". $line ;
}	
if($i == 2)
{
	$sql="INSERT INTO ENTITY (ENTITY_ID,ENTITY_NAME,ENT_ATTR1,ENT_ATTR2,ENT_ATTR3,ENT_ATTR4,ENT_ATTR5,ENT_BILL_CATG,ENT_VR_NR) VALUES". $line ;
}

	  
    $r = mysql_query($sql); 
	
//$i ++;

}

$brend = microtime(true);
$endtime = date("h:i:sa");
$brdiff = $brend - $brstart ;
$Alert = "Rules Load started at ".$starttime."\\n Rules load Completed at ".$endtime.".\\n"."Time Elapsed:".$brdiff." seconds";
echo "<script type= 'text/javascript'>alert('$Alert');</script>";

}
function excel_date($xl_date)
{
return $displayDate = PHPExcel_Style_NumberFormat::toFormattedString($xl_date, 'YYYY-MM-DD hh:mm:ss');
}
?>
