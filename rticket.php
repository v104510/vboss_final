<html>
<?php
include("config.php");
$vers=$_POST['versions'];
$issue=$_POST['issue'];
//echo "$billstartdt the variable $billenddate and $entityid";

if(isset($_POST['versions']) and $_POST['versions']!='')
{
  $sel=mysql_query("insert into tkt_mgmt
  (tkt_id, tkt_desc, tkt_resol_txt, tkt_usr, tkt_upd_usr, tkt_raise_dt, tkt_lastupd_dt, tkt_vr_nr)
  values
  (CEIL(RAND() * 100),'$issue',NULL,'BQA',NULL,SYSDATE(),SYSDATE(),$vers)");  

if($sel)
{
  
	   echo "<script>location.href='index.php?catg=1 & subcatg=tktmgmt '</script>";
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
	<b>Issue Details</b></td>
    <td><input name="issue" type="text" id="issue"></td>
  </tr>  
     
  
  <tr>
    <td><!--div align="center"-->
	<b>Version:</b></td>
	<td>
	<select name="versions">
<?php 
	$sql = mysql_query("SELECT distinct ent_vr_nr FROM version");
	while ($row = mysql_fetch_array($sql)){
		echo "<option value=\"".$row['ent_vr_nr']."\">" . $row['ent_vr_nr'] . "</option>";
	}
?>
	</select></td>
  </tr>
</table>
   
    <!--center-->
      <input name="sub" type="submit" id="sub" value="Submit Issue">
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