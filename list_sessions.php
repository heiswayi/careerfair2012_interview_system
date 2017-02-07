<?php require('auth/auth.php'); ?>

<?php include('header.php'); ?>

<?php include('nav.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">

<div class="nav_inside">
<a class="uiButton uiButtonNormal" href="index.php">+ New Session</a> <a class="uiButton uiButtonNormal" href="list_sessions_interview.php">Interview Only</a> <a class="uiButton uiButtonNormal" href="list_sessions_careertalk.php">Career Talk Only</a>
<form method="post" action="search_company.php?go" id="searchform" class="searchform">
<input style="width:200px;" class="uiTextbox uiTextInputPlaceholder" type="text" name="keyword">
<input class="uiButton uiButtonNormal" type="submit" name="submit" value="Search">
</form>
</div>

<?php
include('config.php');
$result = mysql_query("SELECT * FROM $company ORDER BY id DESC") or die(mysql_error());
$totalsession = mysql_num_rows($result);
echo '<div class="box_title">' . $totalsession . ' session(s) in database; <u>Interview and Career Talk Sessions</u></div>';

while($row = mysql_fetch_array($result)) {
            $desc = str_replace("\n","<br/>",$row['description']);
            $desc = str_replace("\r","<br/>",$row['description']);
            echo '<table class="list_company">';
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
            echo '<a href="view_company.php?id=' . $row['id'] . '">' . $row['name'] . '</a> <span class="desc2"><em>(<strong>ID:</strong> ' . $row['id'] . ', <strong>Type:</strong> ' . $row['type'] . ')</em></span></td></tr>';
            echo '<tr><td class="label"><strong>Description</strong></td><td>' . $desc . '</td></tr>';
            echo '<tr><td class="label"><strong>Date | Time</strong></td><td>';
            if ($row['date'] == 'Day 1') { $date = $day1; $day = '1'; echo $date; }
            else if ($row['date'] == 'Day 2') { $date = $day2; $day = '2'; echo $date; }
            echo ' <span style="color:#777;padding-left:20px;padding-right:20px;">|</span> ' . $row['time'] . '</td></tr>';
            echo '<tr><td class="label"></td><td><a class="uiButton uiButtonNormal" href="view_company.php?id=' . $row['id'] . '">View Form</a> <a class="uiButton uiButtonNormal" href="edit_session.php?id=' . $row['id'] . '">Edit</a> <a class="uiButton uiButtonNormal" href="namelist_admin.php?id=' . $row['id'] . '&day=' . $day . '">View Namelist</a> <a class="uiButton uiButtonNormal" href="do_delete.php?id=' . $row['id'] . '">Delete</a>';
            $thecompany = $row['name'];
            if ($row['type'] == 'Interview') {
                $resulti = mysql_query("SELECT * FROM $interview WHERE company='$thecompany' AND date='$date'") or die(mysql_error());
                $totali = mysql_num_rows($resulti);
                if ($totali < 2) { $totalix = 'registration'; }
                else { $totalix = 'registrations'; }
                echo '<span class="totalreg">' . $totali . ' ' . $totalix . '</span>';
            } else if ($row['type'] == 'Career Talk') {
                $resultc = mysql_query("SELECT * FROM $careertalk WHERE company='$thecompany' AND date='$date'") or die(mysql_error());
                $totalc = mysql_num_rows($resultc);
                if ($totalc < 2) { $totaliy = 'registration'; }
                else { $totaliy = 'registrations'; }
                echo '<span class="totalreg">' . $totalc . ' ' . $totaliy . '</span>';
            }
            echo '</td></tr>';
            echo '</table>';
}

?>
</div>

<?php include('footer.php'); ?>