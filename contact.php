<?php
include("config.php");
$name=$_REQUEST['t1'];
$phone=$_REQUEST['t2'];
$email=$_REQUEST['t3'];
$subj=$_REQUEST['t4'];
$mesg=$_REQUEST['t5'];

if($_REQUEST['sub'])
 {
 if(mysql_query("insert into fdbk values('$name','$phone','$email','$subj','$mesg')"))
    {
	  echo "<font face='Lucida Handwriting' color='red' size='+1'>Message sent successfully</font>";
     }
 
  }
?>
<html>
<div><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">CONTACT US</font></h2></center></div>
<div style="width:100%;float:left" >
<div>
  <p><br/>
      <font face="Lucida Handwriting" size="+1" color="#996699">E-mail:</font><font face="Lucida Handwriting" size="+1" color="#009966"> smartcodes@inc.com
      </font><font face="Lucida Handwriting" size="+1" color="#66CC66"><br>
      </font>
	   <br>
    <font color="#996699" size="+1" face="Lucida Handwriting">Address:    <font color="#009966">Smart Codes Inc limited,Mindspace, Hyderabad </font></font></p>
  <p> <font color="#996699" size="+1" face="Lucida Handwriting">Talk to us:</font><font color="#006633" size="+1" face="Lucida Handwriting"> 040 - 44007777 / 6</font><font size="+1"><br>
    <font color="#996699" face="Lucida Handwriting">Fax us at:</font></font> <font color="#006633" size="+1" face="Lucida Handwriting">040 - 44007777 </font></p>
  <p>&nbsp;</p>
</div>
</div>
</body>
</html>