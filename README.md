# Simple-Click2Call-for-Asterisk-PBX
Copy click2dial.php into the web folder on your Asterisk server (/var/www/html). 
Log into your Asterisk server as root and edit the file: nano -w /var/www/html/click2dial.php. 
For a SIP extension on your Asterisk system, the line should look like this: 
$strChannel = "SIP/502"; where 502 is the extension you wish to ring for incoming Click2Dial calls. 
If you have multiple outbound trunks and you want to route incoming web calls to your cellphone, here's the syntax:

$strChannel = "local/1NXXNXXXXXX@from-internal" ;

Replace 1NXXNXXXXXX with the actual phone number that you currently dial from an extension on your system to place 
a call to your cellphone. Save your change (Ctrl-X, Y, then Enter), and you're done! 
To try it out, point a web browser at the following page substituting your own fully-qualified domain name 
or IP address of your Asterisk server: http://192.168.0.211/click2dial.php. Feel free to cut-and-paste the code 
into an actual web page if you'd prefer to integrate Click2Dial for Asterisk into your existing web layout.
