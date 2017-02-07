<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>Online Registration | Career Fair 2012</title>
  <meta name="description" content="">
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="robots" content="all" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
  <link rel="stylesheet" href="css/print.css" type="text/css" media="screen" />
</head>
<body>
<div id="print">
<?php
include('config.php');

if(isset($_POST['submit'])){
if(isset($_GET['go'])){
if(preg_match("/[A-Z | a-z | 0-9]+/", $_POST['keyword'])){
$keyword=$_POST['keyword'];

echo '<h2>Searching for "' . $keyword . '"  <a target="_blank" href="javascript:window.print()">PRINT</a></h2>';

$resultx = mysql_query("SELECT * FROM $careertalk WHERE name LIKE '%" . $keyword . "%' OR email LIKE '%" . $keyword ."%' OR phone LIKE '%" . $keyword ."%' OR ic LIKE '%" . $keyword ."%' OR matrix LIKE '%" . $keyword ."%' OR year LIKE '%" . $keyword ."%' OR course LIKE '%" . $keyword ."%' OR address LIKE '%" . $keyword ."%' OR company LIKE '%" . $keyword ."%' OR date LIKE '%" . $keyword ."%' OR time LIKE '%" . $keyword ."%'") or die(mysql_error());

$i = 0;
while($row = mysql_fetch_array($resultx)) {
 
      echo '<table class="people">';
      $i++;
      echo '<tr><td><span style="font-size:30px;font-weight:bold;">' . $i . '</span></td></tr>';
      echo '<tr><td class="label">Fullname</td><td>' . $row['name'] . '</td></tr>';
      echo '<tr><td class="label">I/C No.</td><td>' . $row['ic'] . '</td></tr>';
      echo '<tr><td class="label">Matrix No.</td><td>' . $row['matrix'] . '</td></tr>';
      echo '<tr><td class="label">Course of Study</td><td>' . $row['course'] . '</td></tr>';
      echo '<tr><td class="label">Year of Study</td><td>' . $row['year'] . '</td><tr>';
      echo '<tr><td class="label">Mailing Address</td><td>' . $row['address'] . '</td></tr>';
      echo '<tr><td class="label">Email</td><td>' . $row['email'] . '</td></tr>';
      echo '<tr><td class="label">Contact No.</td><td>' . $row['phone'] . '</td></tr>';
      echo '<tr><td class="label">Company for Interview</td><td>' . $row['company'] . '</td></tr>';
      echo '<tr><td class="label">Interview Date</td><td>' . $row['date'] . '</td></tr>';
      echo '<tr><td class="label">Interview Time</td><td>' . $row['time'] . '</td></tr>';
      echo '</table>';
}
} else {
      echo 'Please enter your search query!';
}
}
}

?>
</div>
</body>
</html>