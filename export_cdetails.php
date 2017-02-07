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
<body onLoad="window.print()">
<div id="print">
<?php
include('config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
$id = $_GET['id'];
$result = mysql_query("SELECT * FROM $careertalk WHERE id='$id'") or die(mysql_error());
$row = mysql_fetch_array($result);
echo '<h2>Attendee\'s Details for ID: ' . $id . ' (Interview Session)</h2>';
if($row) {
      $address = str_replace("\n","<br/>",$row['address']);
      $address = str_replace("\r","<br/>",$row['address']);
      echo '<table>';
      echo '<tr><td class="label">Fullname</td><td>' . $row['name'] . '</td></tr>';
      echo '<tr><td class="label">I/C No.</td><td>' . $row['ic'] . '</td></tr>';
      echo '<tr><td class="label">Matrix No.</td><td>' . $row['matrix'] . '</td></tr>';
      echo '<tr><td class="label">Course of Study</td><td>' . $row['course'] . '</td></tr>';
      echo '<tr><td class="label">Year of Study</td><td>' . $row['year'] . '</td><tr>';
      echo '<tr><td class="label">Mailing Address</td><td>' . $address . '</td></tr>';
      echo '<tr><td class="label">Email</td><td>' . $row['email'] . '</td></tr>';
      echo '<tr><td class="label">Contact No.</td><td>' . $row['phone'] . '</td></tr>';
      echo '<tr><td class="label">Company for Interview</td><td>' . $row['company'] . '</td></tr>';
      echo '<tr><td class="label">Interview Date</td><td>' . $row['date'] . '</td></tr>';
      echo '<tr><td class="label">Interview Time</td><td>' . $row['time'] . '</td></tr>';
      echo '</table>';
}
}
?>
</div>
</body>
</html>