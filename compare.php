<html>
<body>
<div><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">Bill Comparision</font></h2></center></div>
<div style="width:100%;float:left" >

<table>
<tr>
<td>
<table border ='1' align='center'>
<tr><td>Customer Name</td>
<td> Bill Date </td>
<td> Invoice (Current Version)</td>
<td> Invoice (Baseline Version)</td>
</tr>

<?php
include("config.php");


   $sel = mysql_query("select e.ent_ins_name ename, bi.bill_dt bt from  ENT_INST_TR e,  BILL_GEN bi where 
bi.ent_inst_id = e.ent_inst_id");

    while($arr=mysql_fetch_assoc($sel))
   {
	$ent_ins_name = $arr['ename'];
	
	$bill_dt = $arr['bt'];

    echo "<tr>
	<td> $ent_ins_name </td>
	<td> $bill_dt</td>
	<td><a href='pdf.php?file_name=$ent_ins_name' alt='Download PDF'>View File</a></td>
	<td><a href='pdf_bl.php?file_name=$ent_ins_name' alt='Download PDF'>View File</a></td>
	</tr>";

   }
	
?>

</table>
</td>
</tr>
</table>
<div>
<br>
<!--marquee behavior="scroll"  dir="ltr" align="absbottom">
<img src="usepics/logo.jpg" width="200" height="70"/>
</marquee>
</div-->

	</div>
</body>
</html>




