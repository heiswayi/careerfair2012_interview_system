<?php include('header.php'); ?>

<?php include('nav1.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">

<?php
include('config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
$id = $_GET['id'];
$day = $_GET['day'];
if ($day == '1') { $setday = 'Day 1'; $dayset = $day1; }
else if ($day == '2') { $setday = 'Day 2'; $dayset = $day2; }
$result = mysql_query("SELECT * FROM $company WHERE id='$id' AND date='$setday'") or die(mysql_error());
$row = mysql_fetch_array($result);
if($row) {
            $thecompany = $row['name'];
            $timeslot = $row['time'];
            if ($row['type'] == 'Interview') {
                $resulti = mysql_query("SELECT * FROM $interview WHERE company='$thecompany' AND date='$dayset' ORDER BY name") or die(mysql_error());
                $totalpeople = mysql_num_rows($resulti);
                echo '<div class="box_title">Session: <u>Interview</u> ::: Day <u>' . $day . '</u> ::: Time Slot: <u>' . $timeslot . '</u><br>' . $totalpeople . ' user(s) registered for <u>' . $thecompany . '</u>';
                if ($totalpeople == $interviewlimit || $totalpeople > $interviewlimit) {
                    echo '<span class="uiButtonDisabled" style="float:right;">Registration Closed</span>';
                } else { echo '<a class="uiButton uiButtonNormal" href="view_company.php?id=' . $id . '" style="float:right;">Register</a>'; }
                echo '</div>';
                echo '<table class="list_session">';
                echo '<tr><th></th><th>Name</th><th></th></tr>';
                $i = 0;
                while($row = mysql_fetch_array($resulti)) {
                    $i++;
                    echo '<tr><td>' . $i . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td><span class="uiButtonDisabled">View Details</span></td>';
                    echo '</tr>';
                }
                echo '</table>';
             } else if ($row['type'] == 'Career Talk') {
                $resultc = mysql_query("SELECT * FROM $careertalk WHERE company='$thecompany' AND date='$dayset' ORDER BY name") or die(mysql_error());
                $totalpeople = mysql_num_rows($resultc);
                echo '<div class="box_title">Session: <u>Career Talk</u> ::: Day <u>' . $day . '</u> ::: Time Slot: <u>' . $timeslot . '</u><br>' . $totalpeople . ' user(s) registered for <u>' . $thecompany . '</u>';
                if ($totalpeople == $careertalklimit || $totalpeople > $careertalklimit) {
                    echo '<span class="uiButtonDisabled" style="float:right;">Registration Closed</span>';
                } else { echo '<a class="uiButton uiButtonNormal" href="view_company.php?id=' . $id . '" style="float:right;">Register</a>'; }
                echo '<table class="list_session">';
                echo '<tr><th></th><th>Name</th><th></th></tr>';
                $i = 0;
                while($row = mysql_fetch_array($resultc)) {
                    $i++;
                    echo '<tr><td>' . $i . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['time'] . '</td>';
                    echo '<td><span class="uiButtonDisabled">View Details</span></td>';
                    echo '</tr>';
                }
                echo '</table>';
             }
} else {
echo '<div class="box_title">Error 404: Not found!</div>';
}
}
?>
</div>

<?php include('footer.php'); ?>