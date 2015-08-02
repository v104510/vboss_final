<html>
<?php
include("config.php");
$billstartdt=$_POST['t3'];
$billenddate=$_POST['p1'];
$entityid=$_POST['owner'];
//echo "$billstartdt the variable $billenddate and $entityid";

if(isset($_POST['t3']) and $_POST['t3']!='')
{
  $sel=mysql_query("CALL executebill('$entityid','$billstartdt','$billenddate',0)");
  $sel=mysql_query("CALL executebilldet('$entityid','$billstartdt','$billenddate',0)");

if($sel)
{
  
	   echo "<script>location.href='index.php?page=home'</script>";
	   //echo "SQL Went Fine";
	 }
else 
{
echo "Please contact the Admin or reach out to the technical support ";
}
}
?>

<form method="post">
<table width="366" border="0" > 
<tr>
    <td><!--div align="center"-->
	<b>Entity Name:</b></td>
	<td>
	<select name="owner">
<?php 
	$sql = mysql_query("SELECT entity_id, entity_name FROM entity");
	while ($row = mysql_fetch_array($sql)){
		echo "<option value=\"".$row['entity_id']."\">" . $row['entity_name'] . "</option>";
	}
?>
	</select></td>
  </tr>

   <tr>
    <td><!--div align="center"-->
	<b>Bill Start Date (YYYY-MM-DD):</b></td>
    <td><input name="t3" type="text" id="bsd"></td>
  </tr>
  <tr>
    <td><!--div align="center"><font size="+1" face="Comic Sans MS"--><b>Bill End Date (YYYY-MM-DD):</b> <!--/font></div--></td>
    <td><input name="p1" type="text" id="bed" ></td>
   </tr> 
</table>
   
    <!--center-->
      <input name="sub" type="submit" id="sub" value="Run Bill Run">
    <!--/center-->    
  
 </form>


<!--div><br>
<marquee behavior="scroll"  dir="ltr" align="absbottom">
<img src="usepics/logo.jpg" width="300" height="70"/>
</marquee>
</div-->
	</div>
</body>
</html>