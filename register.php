<?php
include("config.php");
$title=$_REQUEST['sel1'];
$fname=$_REQUEST['t1'];
$lname=$_REQUEST['t2'];
$gen=$_REQUEST['r1'];
$id=$_REQUEST['t3'];
$pass=$_REQUEST['p1'];
$phone=$_REQUEST['t5'];
$add=$_REQUEST['t6'];
$city=$_REQUEST['t7'];
$coun=$_REQUEST['t8'];
$dob=$_REQUEST['t9'];
if($_REQUEST['sub'])
{
$sel=mysql_query("select id from register where id='$id' ");
$arr=mysql_fetch_array($sel);

if($arr['id']!=$id)
  {
   if(mysql_query("insert into register values('$title','$fname','$lname','$gen','$id','$pass','$phone','$add','$city','$coun','$dob')"))
	   {
	      $suc = "Successfully Registered";
	     echo "<font color='#00CCFF'>$suc</font>";
	   }
	 }
else 
{
echo "user already exists";
}

}
?>
<html>
<head>
</head>
<body>


<div ><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">Register Yourself</font></h2></center></div>
<div>
<div style="width:25%;float:right">
<br><br><br><br><br>
<!--img src="usepics/7.jpg">-->
</div>
<br><br>
<center><div style="width:70%;float:right" align="center">
<fieldset style="background:#e5f9ff;width:75%">
<br><br>
<form method="post" name="f1" >
<table width="366" border="0" align="center">

  <tr>
    <td><div><strong><font size="+0.5" face="Lucida Handwriting">Title:</font></strong></div></td>
    <td><label>
      <select name="sel1" id="sel1">
        <option value="Mr.">Mr.</option>
        <option value="Ms.">Ms.</option>
        <option value="Mrs.">Mrs.</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td width="164"><div><font size="+0.5" face="Lucida Handwriting"><b> First&nbsp;Name:</b></font></div></td>
    <td width="192">
      
        <input name="t1" type="text" id="t1" >   
		</td>
  </tr>
  <tr>
    <td><div><font size="+0.5" face="Lucida Handwriting"><strong>Last name:</strong></font></div></td>
    <td><input name="t2" type="text" id="t2"  ></td>
  </tr>
  <tr>
    <td><div><font size="+0.5" face="Lucida Handwriting"><b>&nbsp;Gender:</b> </font></div></td>
    <td><input name="r1" type="radio" value="male">
      <strong>Male</strong>
        <input name="r1" type="radio" value="female">
        <strong>Female</strong></td>
  </tr>
  <tr>
    <td><div><font size="+0.5" face="Lucida Handwriting"><b>&nbsp;Enter Email : </b></font></div></td>
    <td><input name="t3" type="text" id="t3" ></td>
  </tr>
  <tr>
    <td><div><font size="+0.5" face="Lucida Handwriting"><b>&nbsp;Choose a  Password:</b> </font></div></td>
    <td><input name="p1" type="text" id="p1" ></td>
  </tr>
  <tr> <td><div><font size="+0.5" face="Lucida Handwriting"><b>Phone no: </b></font></div></td>
    <td><input name="t5" type="text" id="t5" ></td>
  </tr>
  <tr>
    <td><div><font size="+0.5" face="Lucida Handwriting"><strong>Address:</strong></font></div></td>
    <td><label>
      <textarea name="t6" id="t6" ></textarea>
    </label></td>
  </tr>
  <tr>
    <td><div><font size="+0.5" face="Lucida Handwriting"><strong>City:</strong></font></div></td>
    <td><input name="t7" type="text" id="t7" ></td>
  </tr>
  <tr>
    <td><div><font size="+0.5" face="Lucida Handwriting"><strong>Country:</strong></font></div></td>
    <td><input name="t8" type="text" id="t8" ></td>
  </tr>
  <tr>
    <td><div><strong><font size="+0.5" face="Lucida Handwriting">Date of Birth: </font></strong></div></td>
    <td><label>
      <input name="t9" type="text" id="t9">
    </label></td>
  </tr>
  <tr>
    <td colspan="2"><label><br>
    <center>
      <input name="sub" type="submit" id="sub" value="Create my Account">
    </center>
    </label></td>
    </tr>
 
</table>
 </form>
</fieldset>
</div>
</center>

</div>

</body>
</html>