# celestia-pfb-ui
<h1>UI for submitting PFB on a Celestia Ligh Node</h1>

This repository contains all the necessary files to get a simple UI to interact with your Light Node Celestia :
- get your wallet balance
- get the last block header commit hash
- submit a PayForBLob transaction and get back the results

FInd the live demo here : http://116.203.145.75/ 

For deploying it on your server you will need to : 

<h3>Install Apache</h3>
<pre>sudo apt install apache2</pre>

Check if Apache is running :

<pre>sudo systemctl status apache2</pre>

Open the port 80 if needed :

<pre>sudo ufw allow 80/tcp</pre>

<h3>Install Php</h3>

<pre>sudo apt install php</pre>


<h3>Install the curl extension for php</h3>

<pre>sudo apt-get install php-curl</pre>


<h3>Activate it in the php.ini file</h3>

First of all find your php.ini file :

<pre>php --ini</pre>

Add this line to activate the extension :

<pre>extension=curl.so</pre>

And restart Apache :

<pre>sudo systemctl restart apache2</pre>

<h3>Deploys the project files /var/www/html</h3>

Navigato to /var/www/html

<pre>cd /var/www/html</pre>

And clone the project.

Of course you can create a new virtual host and connect a domain name to your UI. This this a simple ready to use UI for everyone.


<h3>You are ready to go !</h3>
 
 Your UI will we available on our browser on you node's ip adresse !
 
