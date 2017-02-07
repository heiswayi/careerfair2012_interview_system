<?php include('header.php'); ?>

<?php include('nav1.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">

<div class="nav_inside">
<a class="uiButton uiButtonNormal" href="careertalk_session.php">Day 1 Career Talk Session</a> <a class="uiButton uiButtonNormal" href="careertalk_session_2.php">Day 2 Career Talk Session</a>
<form method="post" action="careertalk_session_search.php?go" id="searchform" class="searchform">
<input style="width:200px;" class="uiTextbox uiTextInputPlaceholder" type="text" name="keyword">
<input class="uiButton uiButtonNormal" type="submit" name="submit" value="Search Company">
</form>
</div>

<?php
include('config.php');
$result = mysql_query("SELECT * FROM $company WHERE type='Career Talk' AND date='Day 2' ORDER BY name") or die(mysql_error());
$totalsession = mysql_num_rows($result);
echo '<div class="box_title">' . $totalsession . ' company(s) available for <u>Career Talk Session</u> on <u>Day 2:</u> ' . $day2 . '</div>';

echo '<table class="list_session">';
echo '<tr><th>Company</th><th>Time Slot</th><th>View Name List</th><th></th></tr>';
while($row = mysql_fetch_array($result)) {
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
                $resultc = mysql_query("SELECT * FROM $careertalk WHERE company='$thecompany'") or die(mysql_error());
                $totalc = mysql_num_rows($resultc);
                if ($totalc < 2) { $totaliy = 'registration'; }
                else { $totaliy = 'registrations'; }
                echo '<a class="uiButton uiButtonNormal" href="namelist.php?id=' . $row['id'] .'&day=2">' . $totalc . ' ' . $totaliy . '</a>';
            echo '</td>';
                if ($totali == $careertalklimit || $totali > $careertalklimit || $globalclosure == 1) {
                    echo '<td><span class="uiButtonDisabled">Closed</span></td>';
                } else { echo '<td><a class="uiButton uiButtonNormal" href="view_company.php?id=' . $row['id'] . '">Register</a></td>'; }
}
echo '</tr></table>';

?>
</div>

<?php include('footer.php'); ?>