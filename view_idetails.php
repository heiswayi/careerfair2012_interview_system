<?php require('auth/auth.php'); ?>

<?php include('header.php'); ?>

<?php include('nav.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">
<div class="box_title">Attendee Information</div>
<?php
include('config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
$id = $_GET['id'];
$result = mysql_query("SELECT * FROM $interview WHERE id='$id'") or die(mysql_error());
$row = mysql_fetch_array($result);
if($row) {
            $address = str_replace("\n","<br/>",$row['address']);
            $address = str_replace("\r","<br/>",$row['address']);
            echo '<table>';
            echo '<tr><td class="label"><strong>Name</strong></td><td>' . $row['name'] . '</td></tr>';
            echo '<tr><td class="label"><strong>I/C No.</strong></td><td>' . $row['ic'] . '</td></tr>';
            echo '<tr><td class="label"><strong>Matrix No.</strong></td><td>' . $row['matrix'] . '</td></tr>';
            echo '<tr><td class="label"><strong>Course of Study</strong></td><td>' . $row['course'] . '</td></tr>';
            echo '<tr><td class="label"><strong>Year of Study</strong></td><td>' . $row['year'] . '</td></tr>';
            echo '<tr><td class="label"><strong>Mailing Address</strong></td><td>' . $address . '</td></tr>';
            echo '<tr><td class="label"><strong>Email</strong></td><td>' . $row['email'] . '</td></tr>';
            echo '<tr><td class="label"><strong>Contact No.</strong></td><td>' . $row['phone'] . '</td></tr>';
            echo '<tr><td class="label"></td><td><a target="_blank" class="uiButton uiButtonNormal" href="export_idetails.php?id=' . $row['id'] . '">Print</a> <a class="uiButton uiButtonNormal" href="do_idelete.php?id=' . $row['id'] . '">Delete</a> <a class="uiButton uiButtonNormal" href="javascript:history.go(-1)">Back</a></td></tr>';
            echo '</table>';
} else {
            echo '<table>';
            echo '<tr><td><strong>Error:</strong> Nothing found!</td></tr>';
            echo '</table>';
}
}
?>
</div>

<?php include('footer.php'); ?>