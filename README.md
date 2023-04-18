# celestia-pfb-ui
<h1>UI for submitting PFB on a Celestia Ligh Node</h1>

This repository contains all the ncessary files to get a simple UI to interect with your Light Node Celestion :
- get your wallet balance
- get the last block header commit hash
- submit a PayForBLob transaction and get back the results

For woking you will need to 

<h2>Install Apache</h2>
<pre>sudo apt install apache2</pre>

Check if Apache is running :

<pre>sudo systemctl status apache2</pre>

Open the port 80 if needed :

<pre>sudo ufw allow 80/tcp</pre>

<h2>Install Php</h2>

<pre>sudo apt install php</pre>


<h2>Install the curl extension for php</h2>

<pre>sudo apt-get install php-curl</pre>


<h2>Activate it in the php.ini file</h2>

First of all find your php.ini file :

<pre>php --ini</pre>

Add this line to activate the extension :

<pre>extension=curl.so<.pre>

And restart Apache :

<pre>sudo systemctl restart apache2</pre>

<h2>Deploys the project files /var/www/html</h2>

Navigato to /var/www/html

<pre>cd /var/www/html</pre>

And clone the project.

Of course you can create a new virtual host and connect a domain name to your UI. This this a simple ready to use UI for everyone.


<h2>You are ready to go !</h2>
 
 Your UI will we available on our browser on you node's ip adresse !
 
