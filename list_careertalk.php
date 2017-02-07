<?php require('auth/auth.php'); ?>

<?php include('header.php'); ?>

<?php include('nav.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">

<div class="nav_inside">
<a class="uiButton uiButtonNormal" href="export_careertalk.php">Print Details</a> <a class="uiButton uiButtonNormal" href="checklist_careertalk.php">Print Checklist</a>
<form method="post" action="search_careertalk.php?go" id="searchform" class="searchform" target="_blank">
<input style="width:200px;" class="uiTextbox uiTextInputPlaceholder" type="text" name="keyword">
<input class="uiButton uiButtonNormal" type="submit" name="submit" value="Search">
</form>
</div>

<?php
include('config.php');
$result = mysql_query("SELECT * FROM $careertalk ORDER BY company") or die(mysql_error());
$totalpeople = mysql_num_rows($result);
echo '<div class="box_title">Global Attendee List for <u>Career Talk Session</u> (' . $totalpeople . ')</div>';

while($row = mysql_fetch_array($result)) {
            echo '<table class="list_company">';
            echo '<tr><td class="label"><strong>Name</strong></td><td><a href="view_cdetails.php?id=' . $row['id'] . '">' . $row['name'] . '</a> <span class="desc2">(<strong>Year:</strong> ' . $row['year'] . ')</span></td></tr>';
            echo '<tr><td class="label"><strong>Session</strong></td><td>';
            echo '' . $row['company'] . ' <span style="color:#777;padding-left:20px;padding-right:20px;">|</span> ' . $row['date'] . ' <span style="color:#777;padding-left:20px;padding-right:20px;">|</span> ' . $row['time'] . '';
            echo '</td></tr>';
            echo '<tr><td class="label"></td><td><a class="uiButton uiButtonNormal" href="view_cdetails.php?id=' . $row['id'] . '">View Details</a> <a class="uiButton uiButtonNormal" href="do_cdelete.php?id=' . $row['id'] . '">Delete</a></td></tr>';
            echo '</table>';
}

?>
</div>

<?php include('footer.php'); ?>