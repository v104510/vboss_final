<html>

<div><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">Release Info</font></h2></center></div>
<div style="width:100%;float:left" >
<?php
include("config.php");

   $sel=mysql_query("select  max(ent_vr_nr) vernr from version where ent_vr_catg = 'BL'");
   while($row = mysql_fetch_assoc($sel))
   {
	   echo "<b>Base Line Version Number:</b>".$row['vernr']."<br/>";
   }	
   
   $sel=mysql_query("select  max(ent_vr_nr) vernr from version where ent_vr_catg = 'CU'");
   while($row = mysql_fetch_assoc($sel))
   {
	   echo "<b>Current Line Version Number:</b>".$row['vernr']."<br/>";
   }	
?>

<table>
<tr>
<td>
<table border ='1' align='center'>
<tr><td> Release Ver</td>
<td> Previous Release </td>
<td> Release Category</td>
<td> Date Created</td>
</tr>

<?php

   $sel=mysql_query("select  ent_vr_nr,ent_prev_vr_nr,IF(ent_vr_catg='BL','Baselined','Current') txt, ver_date dats from version order by ent_vr_nr desc");
   while($row = mysql_fetch_assoc($sel))
   {
  
	echo "<tr>
<td> ".$row['ent_vr_nr']."</td>
<td> ".$row['ent_prev_vr_nr']."</td>
<td>".$row['txt']."</td>
<td> ".$row['dats']."</td>
</tr>";

}
?>

</table>
</td>
</tr>
</table>

<?php
include("config.php");
//echo "$billstartdt the variable $billenddate and $entityid";

if(isset($_POST['fcv']) and $_POST['fcv']!='')
{
	// Reset current version so that multiple clicks are not allowed
   $curver = '';	
   $sel=mysql_query("select  max(ent_vr_nr) vernr from version where ent_vr_catg = 'CU'");
   while($row = mysql_fetch_assoc($sel))
   {
	   $curver = $row['vernr'];
   }
   
   // update current version to finalized
   if($curver != '')
   {
		$sel=mysql_query("update version set ent_vr_catg='BL' where ent_vr_catg = 'CU' and ent_vr_nr = ".$curver."");
		if($sel)
		{
			echo "<script>location.href='index.php?catg=2 & subcatg=FR '</script>";	
		}
		else 
		{
			//echo "The value in Post".$curver."The version in ".$_POST['fcv']."";
			echo "Please contact the Admin or reach out to the technical support ";
		}
	}else{
		echo "Nothing to Finalize. Request for new release via Ticket ";
	}
 }

?>

<form method="post">
      <input name="fcv" type="submit" id="sub" value="Finalize Current Version">  
 </form>
</div>
</body>
</html>