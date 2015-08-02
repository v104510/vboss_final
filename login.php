<?php

include("config.php");
if($_REQUEST['sub'])
{
$id=$_REQUEST['t1'];
$pass=$_REQUEST['p1'];

   $sel=mysql_query("select username,password from login where  username='$id'");
  $arr=mysql_fetch_array($sel);

if(($arr[0]==$id) and( $arr[1]==$pass))
  {
  session_start();
   $_SESSION['eid']=$id;
   $suc = "Succesfully logged in";
   echo "<font color='#00CCFF'>$suc</font>";
//echo "Successfully Logged in";
//echo "<script>location.href='welcome_new.php?page=wel'</script>";
   }
else
{
$er="userid and password do not match";
}
}
?>
<html>
<div><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">Login your Account</font></h2></center></div>
<div>

<!--div style="width:25%;float:right">
<img src="usepics/7.jpg">
</div>-->

<br><br>
<div style="width:100%;float:right" align="center" >
<center><fieldset style="background:#e5f9ff;width:50%">
<br><br>
<table width="250" border="0" align="center">
<form method="post">
<tr><td colspan="2"><?php echo "<font color='#00CCFF'>$er</font>";?></td></tr>
  <tr>
    <td width="90"><div align="center"><font size="+0.5" face="Lucida Handwriting">UserID:</font></div></td>
    <td width="144"><label>
      <input name="t1" type="text" id="t1">
    </label></td>
  </tr>
  <tr>
    <td><div align="center"><font size="+0.5" face="Lucida Handwriting">Password:</font></div></td>
    <td><input name="p1" type="password" id="p1"></td>
  </tr>
  <tr>
    <td><label>
      <div align="center">
<input name="sub" type="submit" value="Login">
        </div>
    </label></td>
    <!--td><strong><a href="index.php?con=11"><font color="#993333" size="+1" face="Bradley Hand ITC">Sign Up</font></a></strong> </td>-->
  </tr>
  <!--tr>
    <td height="37" colspan="2"><div align="center"><a href="#"><font size="+1" face="Bradley Hand ITC"><strong>Forgot your Password? </strong></font></a></div></td>
    </tr-->
  </form>
</table>
</fieldset>
</center>
</div>

</div>

<!--<div style="width:100%;float:left"><center><b>Copyright&copy;Priya Gupta</b></center></div>
</div>-->

</body>
</html>