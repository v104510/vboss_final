<html>

<div><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">Ticket Management</font></h2></center></div>
<div style="width:100%;float:left" >
<table>
<tr>
<td>
<table border ='1' align='center'>
<tr><td> Ticket Id</td>
<td> Ticket desc</td>
<td> Ticket Resolution</td>
<!--td> Attribute 3</td>
<td> Attribute 4</td-->
<td> Raised Date</td>
<td> Status</td>
<td> Version</td>
<td> Raised by</td>
<td> Upd by</td>
<td> Last Mod</td>
</tr>

<?php

include("config.php");
//$dress=$_REQUEST['dress'];
//$catg=$_REQUEST['catg'];
//$subcatg=$_REQUEST['subcatg'];



   $sel=mysql_query("select 
   tkt_id, tkt_desc, tkt_resol_txt, tkt_usr, tkt_upd_usr, tkt_raise_dt, tkt_lastupd_dt, tkt_vr_nr
from
	tkt_mgmt tkt");

//echo"<form method='post'><table border='0' align='center'><tr>";

//echo "<table><tr><td> Entity Name</td>
//<td> Attribute 1</td>
////<td> Attribute 2</td>
//<td> Attribute 3</td>
//<td> Attribute 4</td>
//<td> Attribute 5</td>
//<td> Bill Category</td>
//<td> Product Name</td>
//<td> Charge Type</td>
//<td> Base Rate</td>
//<td> Tax %</td>
//</tr>";

   
   while($row = mysql_fetch_assoc($sel))
{	
	
	echo "<tr>
<td> ".$row['tkt_id']."</td>
<td> ".$row['tkt_desc']."</td>
<td>".$row['tkt_resol_txt']."</td>
<td> ".$row['tkt_raise_dt']."</td>
<td> New </td>
<td> ".$row['tkt_vr_nr']."</td>
<td> ".$row['tkt_usr']."</td>
<td> ".$row['tkt_upd_usr']."</td>
<td> ".$row['tkt_lastupd_dt']."</td>
</tr>";	
}
?>

</table>
</td>
</tr>
</table>



<!--div><br>
<marquee behavior="scroll"  dir="ltr" align="absbottom">
<img src="usepics/logo.jpg" width="300" height="70"/>
</marquee>
</div-->
	</div>
</body>
</html>