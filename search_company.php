<?php require('auth/auth.php'); ?>

<?php include('header.php'); ?>

<?php include('nav.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">

<div class="nav_inside">
<a class="uiButton uiButtonNormal" href="list_sessions.php">Back</a>
<form method="post" action="search_company.php?go" id="searchform" class="searchform" target="_blank">
<input style="width:200px;" class="uiTextbox uiTextInputPlaceholder" type="text" name="keyword">
<input class="uiButton uiButtonNormal" type="submit" name="submit" value="Search">
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

$resultx = mysql_query("SELECT * FROM $company WHERE name LIKE '%" . $keyword . "%' OR type LIKE '%" . $keyword ."%' OR date LIKE '%" . $keyword ."%' OR time LIKE '%" . $keyword ."%' OR description LIKE '%" . $keyword ."%'") or die(mysql_error());

$totalsession = mysql_num_rows($resultx);
echo '<div class="box_title">Search for "' . $keyword . '" (' . $totalsession . ' sessions found)</div>';

while($row = mysql_fetch_array($resultx)) {
            $desc = str_replace("\n","<br/>",$row['description']);
            $desc = str_replace("\r","<br/>",$row['description']);
            echo '<table class="list_company">';
            echo '<tr><td class="label"><strong>Name</strong></td><td><a href="view_company.php?id=' . $row['id'] . '">' . $row['name'] . '</a> <span class="desc2"><em>(<strong>ID:</strong> ' . $row['id'] . ', <strong>Type:</strong> ' . $row['type'] . ')</em></span></td></tr>';
            echo '<tr><td class="label"><strong>Description</strong></td><td>' . $desc . '</td></tr>';
            echo '<tr><td class="label"><strong>Date | Time</strong></td><td>';
            if ($row['date'] == 'Day 1') { $date = $day1; $day = '1'; echo $date; }
            else if ($row['date'] == 'Day 2') { $date = $day2; $day = '2'; echo $date; }
            echo ' <span style="color:#777;padding-left:20px;padding-right:20px;">|</span> ' . $row['time'] . '</td></tr>';
            echo '<tr><td class="label"></td><td><a class="uiButton uiButtonNormal" href="view_company.php?id=' . $row['id'] . '">View Form</a> <a class="uiButton uiButtonNormal" href="edit_session.php?id=' . $row['id'] . '">Edit</a> <a class="uiButton uiButtonNormal" href="namelist_admin.php?id=' . $row['id'] . '&day=' . $day .'" target="_blank">View Namelist</a> <a class="uiButton uiButtonNormal" href="do_delete.php?id=' . $row['id'] . '">Delete</a>';
            $thecompany = $row['name'];
            if ($row['type'] == 'Interview') {
                $resulti = mysql_query("SELECT * FROM $interview WHERE company='$thecompany'") or die(mysql_error());
                $totali = mysql_num_rows($resulti);
                if ($totali < 2) { $totalix = 'registration'; }
                else { $totalix = 'registrations'; }
                echo '<span class="totalreg">' . $totali . ' ' . $totalix . '</span>';
            } else if ($row['type'] == 'Career Talk') {
                $resultc = mysql_query("SELECT * FROM $careertalk WHERE company='$thecompany'") or die(mysql_error());
                $totalc = mysql_num_rows($resultc);
                if ($totalc < 2) { $totaliy = 'registration'; }
                else { $totaliy = 'registrations'; }
                echo '<span class="totalreg">' . $totalc . ' ' . $totaliy . '</span>';
            }
            echo '</td></tr>';
            echo '</table>';
}
} else {
      echo 'Please enter your search query!';
}
}
}

?>
</div>

<?php include('footer.php'); ?>