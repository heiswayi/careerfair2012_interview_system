<?php require('auth/auth.php'); ?>

<?php include('header.php'); ?>

<?php include('nav.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">

<div class="nav_inside">
<a class="uiButton uiButtonNormal" href="list_sessions.php">Back</a>
<form method="post" action="search_company.php?go" id="searchform" class="searchform">
<input style="width:200px;" class="uiTextbox uiTextInputPlaceholder" type="text" name="keyword">
<input class="uiButton uiButtonNormal" type="submit" name="submit" value="Search Company">
</form>
</div>

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
                echo '<a class="uiButton uiButtonNormal" href="print_details.php?id=' . $id . '&day=' . $day . '" style="float:right;">Print Details</a>';
                echo '</div>';
                echo '<table class="list_session">';
                echo '<tr><th></th><th>Name</th><th>Time Slot</th><th></th><th></th><th></th></tr>';
                $i = 0;
                while($row = mysql_fetch_array($resulti)) {
                    $i++;
                    echo '<tr><td>' . $i . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['time'] . '</td>';
                    echo '<td><a class="uiButton uiButtonNormal" href="view_idetails.php?id=' . $row['id'] . '">View Details</a></td>';
                    echo '<td><a class="uiButton uiButtonNormal" href="edit_iuser.php?id=' . $row['id'] . '&pid=' . $id .'&pday=' . $day . '">Edit</a></td>';
                    echo '<td><a class="uiButton uiButtonNormal" href="delete_iuser.php?id=' . $row['id'] . '&pid=' . $id .'&pday=' . $day . '">Delete</a></td>';
                    echo '</tr>';
                }
                echo '</table>';
             } else if ($row['type'] == 'Career Talk') {
                $resultc = mysql_query("SELECT * FROM $careertalk WHERE company='$thecompany' AND date='$dayset' ORDER BY name") or die(mysql_error());
                $totalpeople = mysql_num_rows($resultc);
                echo '<div class="box_title">Session: <u>Career Talk</u> ::: Day <u>' . $day . '</u> ::: Time Slot: <u>' . $timeslot . '</u><br>' . $totalpeople . ' user(s) registered for <u>' . $thecompany . '</u>';
                echo '<a class="uiButton uiButtonNormal" href="print_details.php?id=' . $id . '&day=' . $day . '" style="float:right;">Print Details</a>';
                echo '</div>';
                echo '<table class="list_session">';
                echo '<tr><th></th><th>Name</th><th>Time Slot</th><th></th><th></th><th></th></tr>';
                $i = 0;
                while($row = mysql_fetch_array($resultc)) {
                    $i++;
                    echo '<tr><td>' . $i . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['time'] . '</td>';
                    echo '<td><a class="uiButton uiButtonNormal" href="view_cdetails.php?id=' . $row['id'] . '">View Details</a></td>';
                    echo '<td><a class="uiButton uiButtonNormal" href="edit_cuser.php?id=' . $row['id'] . '&pid=' . $id .'&pday=' . $day . '">Edit</a></td>';
                    echo '<td><a class="uiButton uiButtonNormal" href="delete_cuser.php?id=' . $row['id'] . '&pid=' . $id .'&pday=' . $day . '">Delete</a></td>';
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