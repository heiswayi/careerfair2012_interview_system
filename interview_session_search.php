<?php include('header.php'); ?>

<?php include('nav1.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">

<div class="nav_inside">
<a class="uiButton uiButtonNormal" href="interview_session.php">Day 1 Interview Session</a> <a class="uiButton uiButtonNormal" href="interview_session_2.php">Day 2 Interview Session</a>
<form method="post" action="interview_session_search.php?go" id="searchform" class="searchform">
<input style="width:200px;" class="uiTextbox uiTextInputPlaceholder" type="text" name="keyword">
<input class="uiButton uiButtonNormal" type="submit" name="submit" value="Search Company">
</form>
</div>

<?php
include('config.php');

if(isset($_POST['submit'])){
if(isset($_GET['go'])){
if(preg_match("/[A-Z | a-z | 0-9]+/", $_POST['keyword'])){
$keyword=$_POST['keyword'];

if ($keyword == $day1) { $keyword = 'Day 1'; }
else if ($keyword == $day2) { $keyword = 'Day 2'; }

$resultx = mysql_query("SELECT * FROM $company WHERE type='Interview' AND name LIKE '%" . $keyword ."%'") or die(mysql_error());

$totalsession = mysql_num_rows($resultx);
echo '<div class="box_title">Search for "' . $keyword . '"</div>';

echo '<table class="list_session">';
echo '<tr><th>Company</th><th>Time Slot</th><th>View Name List</th><th></th></tr>';
while($row = mysql_fetch_array($resultx)) {
            $desc = str_replace("\n","<br/>",$row['description']);
            $desc = str_replace("\r","<br/>",$row['description']);
            echo '<tr><td>';
            if ($row['sponsor'] == 'Gold') {
                echo '<span class="sponsor gold">GOLD SPONSOR</span> ';
            } else if ($row['sponsor'] == 'Silver') {
                echo '<span class="sponsor silver">SILVER SPONSOR</span> ';
            } else if ($row['sponsor'] == 'Bronze') {
                echo '<span class="sponsor bronze">BRONZE SPONSOR</span> ';
            } else if ($row['sponsor'] == 'Normal') {
                echo '';
            }
            echo '<a href="view_company.php?id=' . $row['id'] . '">' . $row['name'] . '</a></td>';
            echo '<td>' . $row['time'] . '</td>';
            echo '<td>';
            $thecompany = $row['name'];
            if ($row['date'] == 'Day 1') { $day = '1'; }
            else if ($row['date'] == 'Day 2') { $day = '2'; }
                $resulti = mysql_query("SELECT * FROM $interview WHERE company='$thecompany'") or die(mysql_error());
                $totali = mysql_num_rows($resulti);
                if ($totali < 2) { $totalix = 'registration'; }
                else { $totalix = 'registrations'; }
                echo '<a class="uiButton uiButtonNormal" href="namelist.php?id=' . $row['id'] .'&day=' . $day . '">' . $totali . ' ' . $totalix . '</a>';
            echo '</td>';
                if ($totali == $interviewlimit || $totali > $interviewlimit || $globalclosure == 1) {
                    echo '<td><span class="uiButtonDisabled">Closed</span></td>';
                } else { echo '<td><a class="uiButton uiButtonNormal" href="view_company.php?id=' . $row['id'] . '">Register</a></td>'; }
}
echo '</tr></table>';

}
}
}

?>
</div>

<?php include('footer.php'); ?>