<html>

<div><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">Billing Rules</font></h2></center></div>
<div style="width:100%;float:left" >
<table>
<tr>
<td>
<table border ='1' align='center'>
<tr><td> Entity Name</td>
<td> Attribute 1</td>
<td> Attribute 2</td>
<td> Attribute 3</td>
<td> Attribute 4</td>
<td> Attribute 5</td>
<td> Bill Category</td>
<td> Product Name</td>
<td> Charge Type</td>
<td> Base Rate</td>
<td> Tax %</td>
</tr>

<?php

include("config.php");
//$dress=$_REQUEST['dress'];
//$catg=$_REQUEST['catg'];
//$subcatg=$_REQUEST['subcatg'];



   $sel=mysql_query("select 
	ent.entity_name entname, ent.ent_attr1 attr1,ent.ent_attr2 attr2,ent.ent_attr3 attr3,
    ent.ent_attr4 attr4,ent.ent_attr5 attr5, ent.ent_bill_catg billcatg,
    ep.ent_prod_name prodname, epr.ent_chg_type chgtype, epr.ent_amt amt,
    epr.ent_tx_per txrate
from
	entity ent,
    entity_prod ep,
    entity_prod_rule epr
where
	ent.entity_id = epr.entity_id and
    ep.ent_prod_id = epr.ent_prod_id
order by ent.entity_name");

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
	//echo "Hello";
	$entname  = $row['entname'];
	$attr1 = $row['attr1'];
	$attr2 = $row['attr2'];
	$attr3 = $row['attr3'];
	$attr4 = $row['attr4'];
	$attr5 = $row['attr5'];
	$billcatg = $row['billcatg'];
	$prodname = $row['prodname'];
	$chgtype = $row['chgtype'];
	$amt = $row['amt'];
	$taxrate = $row['txrate'];
	
	
	echo "<tr>
<td> $entname</td>
<td> $attr1</td>
<td> $attr2</td>
<td> $attr3</td>
<td> $attr4</td>
<td> $attr5</td>
<td> $billcatg</td>
<td> $prodname</td>
<td> $chgtype</td>
<td> $amt</td>
<td> $taxrate</td>
</tr>";	
}
?>

</table>
</td>
</tr>
</table>



<div><br>
<marquee behavior="scroll"  dir="ltr" align="absbottom">
<img src="usepics/logo.jpg" width="300" height="70"/>
</marquee>
</div>
	</div>
</body>
</html>




