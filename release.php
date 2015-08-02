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



<!--div><br>
<marquee behavior="scroll"  dir="ltr" align="absbottom">
<img src="usepics/logo.jpg" width="300" height="70"/>
</marquee>
</div-->


<?php
//echo "$billstartdt the variable $billenddate and $entityid";

if(isset($_POST['cnv']) and $_POST['cnv']!='')
{
	// Reset current version so that multiple clicks are not allowed
   $basever = '';	
   $curcnt = 1;
   $sel=mysql_query("select  count(1) vernr from version where ent_vr_catg = 'CU'");
   while($row = mysql_fetch_assoc($sel))
   {
	   $curcnt = $row['vernr'];
   }
   
   $sel=mysql_query("select  max(ent_vr_nr) vernr from version where ent_vr_catg = 'BL'");
   while($row = mysql_fetch_assoc($sel))
   {
	   $basever = $row['vernr'];
   }
   
   
   // update current version to finalized
   if($curcnt != 1 and $basever != '')
   {
	   $curno = $basever+1;
		$sel=mysql_query("insert into version(ent_vr_nr,ent_prev_vr_nr,ent_vr_catg,inst_ctg,ver_date) 
		values
		($curno , $basever , 'CU', 'DEV', SYSDATE())
		");
		if($sel)
		{
			echo "<script>location.href='index.php?catg=1 & subcatg=Release '</script>";	
		}
		else 
		{
			//echo "The value in Post". $curno . "The base". $basever."The version in ".$_POST['cnv']."";
			echo "Please contact the Admin or reach out to the technical support ";
		}
	}else{
		//echo "$curcnt and $basever <br/>";
		echo "A current Version already exists no need for new current version";
	}
 }

?>

<form method="post">
      <input name="cnv" type="submit" id="sub" value="Create New Version">  
 </form>

	</div>
</body>
</html>