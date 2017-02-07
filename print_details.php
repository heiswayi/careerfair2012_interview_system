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
$day = $_GET['day'];
if ($day == '1') { $setday = 'Day 1'; $dayset = $day1; }
else if ($day == '2') { $setday = 'Day 2'; $dayset = $day2; }
$result = mysql_query("SELECT * FROM $company WHERE id='$id'") or die(mysql_error());
$row = mysql_fetch_array($result);
if($row) {
            $thecompany = $row['name'];
            if ($row['type'] == 'Interview') {
                $resulti = mysql_query("SELECT * FROM $interview WHERE company='$thecompany' AND date='$dayset' ORDER BY name") or die(mysql_error());
                $totalpeople = mysql_num_rows($resulti);
                
echo '<h3>Company: <u>' . $thecompany . '</u> ::: Day <u>' . $day . '</u><br>';
echo 'Attendee Details for <u>Interview Session</u> (' . $totalpeople . ')</h3>';

while($row = mysql_fetch_array($resulti)) {
 
      echo '<table class="people">';
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

            } else if ($row['type'] == 'Career Talk') {
                $resultc = mysql_query("SELECT * FROM $careertalk WHERE company='$thecompany' AND date='$dayset' ORDER BY name") or die(mysql_error());
                $totalpeople = mysql_num_rows($resultc);

echo '<h3>Company: <u>' . $thecompany . '</u> ::: Day <u>' . $day . '</u><br>';
echo 'Attendee Details for <u>Interview Session</u> (' . $totalpeople . ')</h3>';

while($row = mysql_fetch_array($resultc)) {
 
      echo '<table class="people">';
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

            }
} else {
            echo '<table>';
            echo '<tr><td><strong>Error:</strong> Nothing found!</td></tr>';
            echo '</table>';
}
}
?>
</div>
</body>
</html>