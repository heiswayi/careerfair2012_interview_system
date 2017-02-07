<?php

 // Full script URL begins with prefix (http://) ...end with slashing (/)
 $site_url = 'http://careerfair.eng.usm.my/registration/';
 
 $day1 = '4 April 2012';
 $day2 = '5 April 2012';

 // Database Variables (edit with your own server information)
 $server = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'php';
 
 // table
 $company = 'cf_company';
 $interview = 'cf_interview';
 $careertalk = 'cf_careertalk';
 
 // Connect to Database
 $connection = mysql_connect($server, $user, $pass) 
 or die ("Could not connect to server ... \n" . mysql_error ());
 mysql_select_db($db) 
 or die ("Could not connect to database ... \n" . mysql_error ());

?>