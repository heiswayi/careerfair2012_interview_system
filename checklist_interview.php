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
$result = mysql_query("SELECT * FROM $interview WHERE date='$day1' ORDER BY company") or die(mysql_error());
$totalpeople = mysql_num_rows($result);

echo '<h2>List of Attendees for Interview Session (' . $totalpeople . ') <a target="_blank" href="javascript:window.print()">PRINT</a><br>';
echo 'Date: ' . $day1 . '</h2>';
echo '<p class="printby"><a href="list_interview.php">&larr; Back to System</a> | <a href="checklist_interview.php">Day 1</a> | <a href="checklist_interview_2.php">Day 2</a></p>';

echo '<table class="checklist">';
echo '<tr><th>Company</th><th>Name</th><th>Matrix No.</th><th>Time</th><th class="oncheck"></th><th class="oncheck"></th></tr>';
while($row = mysql_fetch_array($result)) {
      echo '<tr><td>' . $row['company'] . '</td>';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>' . $row['matrix'] . '</td>';
      echo '<td>' . $row['time'] . '</td>';
      echo '<td class="oncheck"></td>';
      echo '<td class="oncheck"></td><tr>';
}
echo '</table>';

?>
</div>
</body>
</html>