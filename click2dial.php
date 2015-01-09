<html>
<head>
<title>Click2Dial</title>
</head>
<body>
<?php
#Based on the Click-To-Call script by VoipJots.com
#Modified by Marcelo Canales for http://sterio.me

#------------------------------------------------------------------------------------------
#edit the below variable values to reflect your system/information
#------------------------------------------------------------------------------------------

#specify the name/ip address of your asterisk box
#if your are hosting this page on your asterisk box, then you can use
#127.0.0.1 as the host IP.  Otherwise, you will need to edit the following
#line in manager.conf, under the Admin user section:
#permit=127.0.0.1/255.255.255.0
#change to:
#permit=127.0.0.1/255.255.255.0,xxx.xxx.xxx.xxx ;(the ip address of the server this page is running on)
$strHost = "127.0.0.1";

#specify the username you want to login with (these users are defined in /etc/asterisk/manager.conf)
#this user is the default AAH AMP user; you shouldn't need to change, if you're using AAH.
$strUser = "admin";

#specify the password for the above user
$strSecret = "DelawarE_2014";

#specify the channel (extension) you want to receive the call requests with
#e.g. SIP/XXX, IAX2/XXXX, ZAP/XXXX, local/1NXXNXXXXXX@from-internal, etc
#$strChannel = "local/1NXXNXXXXXX@from-internal";Use this for your cell phone Number;
$strChannel = "SIP/1234";

#specify the context to make the outgoing call from.  By default, AAH uses from-internal
#Using from-internal will make you outgoing dialing rules apply
$strContext = "from-internal";

#specify the amount of time you want to try calling the specified channel before hangin up
$strWaitTime = "30";

#specify the priority you wish to place on making this call
$strPriority = "1";

#specify the maximum amount of retries
$strMaxRetry = "2";

#--------------------------------------------------------------------------------------------
#Shouldn't need to edit anything below this point to make this script work
#--------------------------------------------------------------------------------------------
#get the phone number from the posted form
$strName  = $_POST['txtname'];
$strExten = $_POST['txtphonenumber'];


$callNumber = $strExten;
#specify the caller id for the call
$strCallerId = "Web-".$strName . " <$callNumber>";

$length = strlen($strExten);

if ($length == 10 && is_numeric($strExten))
{
$oSocket = fsockopen($strHost, 5038, $errnum, $errdesc) or die("Connection to host failed");
fputs($oSocket, "Action: login\r\n");
fputs($oSocket, "Events: off\r\n");
fputs($oSocket, "Username: $strUser\r\n");
fputs($oSocket, "Secret: $strSecret\r\n\r\n");
fputs($oSocket, "Action: originate\r\n");
fputs($oSocket, "Channel: $strChannel\r\n");
fputs($oSocket, "WaitTime: $strWaitTime\r\n");
fputs($oSocket, "CallerId: $strCallerId\r\n");
fputs($oSocket, "Exten: $strExten\r\n");
fputs($oSocket, "Context: $strContext\r\n"); 
fputs($oSocket, "Priority: 1\r\n\r\n");
fputs($oSocket, "Action: Logoff\r\n\r\n");
sleep(3);
fclose($oSocket);
?>
<p>
<table width="300" border="1" bordercolor="#0f0f0f" cellpadding="3" cellspacing="0">
	<tr><td>
	<font size="2" face="verdana,georgia" color="#000000">We are processing your call, please wait about two minutes. 
If you have not received our call within two minutes, verify that your name and number were entered correctly and 
<a href="javascript:history.go(-1)">try again.</a>
</font>
	</td></tr>
</table>
<p><h3><a href="javascript:history.go(-1)">Go Back</a></h3>
</p>


<?
}
else
{
?>
<p>
<table width="300" border="1" bordercolor="#0f0f0f" cellpadding="3" cellspacing="0">
	<tr><td>
	<font size="2" face="verdana,arial,georgia" 
color="#000000">Enter your name and 10-digit number (e.g. 7875551234). If available, we will call you within the next two minutes.</font>
	<form action="<? echo $_SERVER['PHP_SELF'] ?>" method="post">
		
Name:&nbsp;&nbsp;&nbsp; <input type="text" size="30" maxlength="12" name="txtname"><br><br>
Number: <input type="text" size="30" maxlength="10" name="txtphonenumber"><br><br>
<center><input type="submit" 
value="Call Me Now"></center>
	</form>
	</td></tr>
</table>
</p>
<?
}
?>
</body>
</html>
