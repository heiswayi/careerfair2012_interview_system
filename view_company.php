<?php ob_start(); ?>

<?php include('header.php'); ?>

<div class="nav">
<div class="nav_center">
<a class="uiButton uiButtonNormal" href="javascript:history.go(-1)">Back to Previous Page</a>
</div>
</div>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">
<div class="box_title">Company Information</div>
<?php
include('config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
$id = $_GET['id'];
$result = mysql_query("SELECT * FROM $company WHERE id='$id'") or die(mysql_error());
$row = mysql_fetch_array($result);
if($row) {
            $desc = str_replace("\n","<br/>",$row['description']);
            $desc = str_replace("\r","<br/>",$row['description']);
            $desc = strip_tags($row['description']);
            echo '<table>';
            echo '<tr><td class="label"><strong>Name</strong></td><td>';
            if ($row['sponsor'] == 'Gold') {
                echo '<span class="sponsor gold">GOLD SPONSOR</span> ';
            } else if ($row['sponsor'] == 'Silver') {
                echo '<span class="sponsor silver">SILVER SPONSOR</span> ';
            } else if ($row['sponsor'] == 'Bronze') {
                echo '<span class="sponsor bronze">BRONZE SPONSOR</span> ';
            } else if ($row['sponsor'] == 'Normal') {
                echo '';
            }
            echo '' . $row['name'] . '</td></tr>';
            echo '<tr><td class="label"><strong>Type</strong></td><td>' . $row['type'] . '</td></tr>';
            echo '<tr><td class="label"><strong>Description</strong></td><td>' . $desc . '</td></tr>';
            echo '<tr><td class="label"><strong>Date</strong></td><td>';
            if ($row['date'] == 'Day 1') { $date = $day1; echo $date; }
            else if ($row['date'] == 'Day 2') { $date = $day2; echo $date; }
            echo '</td></tr>';
            echo '<tr><td class="label"><strong>Time</strong></td><td>' . $row['time'] . '</td></tr>';
            echo '<tr><td class="label"></td><td>';
            $thecompany = $row['name'];
            if ($row['type'] == 'Interview') {
                $resulti = mysql_query("SELECT * FROM $interview WHERE company='$thecompany'") or die(mysql_error());
                $totali = mysql_num_rows($resulti);
                if ($totali < 2) { $totalix = 'registration'; }
                else { $totalix = 'registrations'; }
                echo '<span class="totalreg">Currently, we have <strong>' . $totali . ' ' . $totalix . '</strong> to this session.</span>';
            } else if ($row['type'] == 'Career Talk') {
                $resultc = mysql_query("SELECT * FROM $careertalk WHERE company='$thecompany'") or die(mysql_error());
                $totalc = mysql_num_rows($resultc);
                if ($totalc < 2) { $totaliy = 'registration'; }
                else { $totaliy = 'registrations'; }
                echo '<span class="totalreg">Currently, we have <strong>' . $totalc . ' ' . $totaliy . '</strong> to this session.</span>';
            }
            echo '</td></tr>';
            echo '</table>';
} else {
            echo '<table>';
            echo '<tr><td><strong>Error:</strong> Nothing found!</td></tr>';
            echo '</table>';
}
}
?>
</div>
<?php
include('config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
$id = $_GET['id'];
$result = mysql_query("SELECT * FROM $company WHERE id='$id'") or die(mysql_error());
$row = mysql_fetch_array($result);
if($row) {
if ($row['type'] == 'Interview') {
   $thecompany = $row['name'];
   $resulti = mysql_query("SELECT * FROM $interview WHERE company='$thecompany'") or die(mysql_error());
   $totali = mysql_num_rows($resulti);
   if ($totali == $interviewlimit || $totali > $interviewlimit || $globalclosure == 1) { include('reg_closed.php'); }
   else { include('reg_interview.php'); }
}
else if ($row['type'] == 'Career Talk') {
  $thecompany = $row['name'];
  $resulti = mysql_query("SELECT * FROM $careertalk WHERE company='$thecompany'") or die(mysql_error());
  $totali = mysql_num_rows($resulti);
  if ($totali == $careertalklimit || $totali > $careertalklimit || $globalclosure == 1) { include('reg_closed.php'); }
  else { include('reg_careertalk.php'); }
}
}
}
?>

<?php include('footer.php'); ?>

<?php ob_flush(); ?>