<head>
<script>
function abc()
{
var arr=new Array("usepics/run1.jpg","usepics/run2.jpg","usepics/run3.jpg","usepics/run4.jpg","usepics/run5.jpg");
var ind=eval(document.f1.h1.value);
document.img.src=arr[ind];
document.f1.h1.value=ind+1;
if(document.f1.h1.value==5)
{
document.f1.h1.value=0;
}
}
setInterval("abc()",3000);
</script>
</head>
<body>
<div id="RightPart">
  <div id="Page"><img src="usepics/run2.jpg" alt="" width="669" height="210" name="img"/>
  <form name="f1">
  <input type="hidden" name="h1" value="0" />
  </form>
  <div><br/><center><h2><font face="Lucida Handwriting"  color="#00CCFF">Latest Billing News</font></h2></center></div>
 <table border="0">
 <tr><td> 
<img src="usepics/verizon.jpg" width="150" height="180"/>
</td>
<td colspan="2">
<font face="Lucida Handwriting" size="+1" color="#99CC33">
Verizon EWA Hold off</font><br>
<font face="Comic Sans MS"><strong>Verizon workers in nine states could walk off the job as soon as early Sunday if union negotiators don't reach an agreement over benefits with the wireless carrier.
A contract covering 39,000 Verizon workers represented by two unions expires at the end of Saturday. Last week, the Communications Workers of America announced that 86 percent of Verizon workers covered by the contract voted to strike in a recent poll, if a new agreement isn't reached.
The contract covers employees in nine states from Massachusetts to Virginia who work for Verizon's wireline business, which provides fixed-line phone services and FiOS Internet service.
</strong></font></td>
</tr>
<tr>
<td>
<br>
<img src="usepics/oracle.jpg" /><br>
<font  color="#FF66CC" face="Lucida Handwriting">Oracle Billing and Revenue Management Cloud Service</font><br>
<font face="Comic Sans MS"><strong>Aug 1, 2015<br>
Oracle Billing and Revenue Management Cloud Service combines the power of Oracle’s market-leading billing and revenue management solution with the simplicity, elasticity and security
 of Oracle Cloud. This dedicated cloud billing service offers powerful pricing, discounting, account 
 management, debt management, financial management, rating, and usage processing across 
 any combination of measurable metrics, including time, events, downloads, transactions, and volume. 
 ...</strong></font></td>

<td>
<img src="usepics/p7.jpg" /><br>
<font  color="#FF66CC" face="Lucida Handwriting">Run Time usage </font><br>

<font face="Comic Sans MS"><strong>Jun 15, 2011<br>
Hadoop struggles to get the real time dating a detail case study in IEEE paper presentation...</strong></font></td>
<td>
<img src="usepics/microsoft.png" /><br>
<font  color="#FF66CC" face="Lucida Handwriting">Microsoft stepped its public-cloud game up</font><br>

<font face="Comic Sans MS"><strong>June 30, 2015<br>
 Eearlier this week by introducing by-the-minute billing for virtual-server instances in its Windows Azure cloud (several weeks after Google announced the same thing) and luring members of its developer community MSDN (Microsoft Developer Network) with monthly credit for Azure use.
 Both Google and Microsoft explained the switch to by-the-minute billing from an hourly rate by the fact that developers often do not need to spin up a VM for an entire hour. Microsoft took it a step further than Google, offering no minimum-use commitment (Google requires a minimum of 10 minutes).
 This appears to be a stab at Amazon Web Services....</strong></font></td>
</tr>
</table>
  </div>
  </div>
  </body>