<?php ob_start(); ?>

<?php require('auth/auth.php'); ?>

<?php include('header.php'); ?>

<?php include('nav.php'); ?>

<?php include('logo.php'); ?>

<?php
 function renderForm($id, $name, $desc, $time, $type_i, $type_c, $sponsor_g, $sponsor_s, $sponsor_b, $sponsor_n, $error, $day_1, $day_2)
 {
?>
<div class="uiForm" id="make_center">
<div class="box_title">Edit a session</div>
<?php

if ($error != '')
{
echo '<div class="err">' . $error . '</div>';
}
?>
 
            <form action="" method="post">
            <table>
            <tr><td class="label"><strong>Company Name</strong></td><td><input style="padding:5px;width:400px;" type="text" name="name" class="uiTextbox" value="<?php echo $name; ?>" /></td></tr>
            <tr><td class="label"><strong>Session Type</strong></td><td>
            <input type="radio" name="type" id="uiRadioType-1" class="uiRadio" value="Interview" <?php echo $type_i; ?>></input><label for="uiRadioType-1" class="uiRadio">Interview</label>
            <input type="radio" name="type" id="uiRadioType-2" class="uiRadio" value="Career Talk" <?php echo $type_c; ?>></input><label for="uiRadioType-2" class="uiRadio">Career Talk</label>
            </td></tr>
            <tr><td class="label"><strong>Company Description</strong></td><td><textarea style="padding:5px;width:600px;height:100px;" name="desc" class="uiTextarea" /><?php echo $desc; ?></textarea></td></tr>
            <tr><td class="label"><strong>Session Date</strong></td><td>
            <input type="radio" name="date" id="uiRadioDate-1" class="uiRadio" value="Day 1" <?php echo $day_1; ?>></input><label for="uiRadioDate-1" class="uiRadio">Day 1</label>
            <input type="radio" name="date" id="uiRadioDate-2" class="uiRadio" value="Day 2" <?php echo $day_2; ?>></input><label for="uiRadioDate-2" class="uiRadio">Day 2</label></td></tr>
            <tr><td class="label"><strong>Session Time</strong></td><td><input style="padding:5px;width:200px;" type="text" name="time" class="uiTextbox" value="<?php echo $time; ?>" /><br>
            <div class="desc"><strong>Example 1:</strong> 9 am - 10 pm<br>
            <strong>Example 2:</strong> 9 am - 10 pm &amp; 2 pm - 5 pm<br>
            * Time range is limited to particular date!</div></td></tr>
            <tr><td class="label"><strong>Sponsor Category</strong></td><td>
            <input type="radio" name="sponsor" id="uiRadioSponsor-1" class="uiRadio" value="Gold" <?php echo $sponsor_g; ?>></input><label for="uiRadioSponsor-1" class="uiRadio">Gold</label>
            <input type="radio" name="sponsor" id="uiRadioSponsor-2" class="uiRadio" value="Silver" <?php echo $sponsor_s; ?>></input><label for="uiRadioSponsor-2" class="uiRadio">Silver</label>
            <input type="radio" name="sponsor" id="uiRadioSponsor-3" class="uiRadio" value="Bronze" <?php echo $sponsor_b; ?>></input><label for="uiRadioSponsor-3" class="uiRadio">Bronze</label>
            <input type="radio" name="sponsor" id="uiRadioSponsor-4" class="uiRadio" value="Normal" <?php echo $sponsor_n; ?>></input><label for="uiRadioSponsor-4" class="uiRadio">N/A</label>
            </td></tr>
           
            <input type="hidden" name="antispam" value="" />
            
            <tr><td class="label"></td><td><input type="submit" name="submit" class="uiButton uiButtonNormal" value="Save"> <a class="uiButton uiButtonNormal" href="javascript:history.go(-1)">Cancel</a></td></tr>
            </table>
            </form>

</div>
           
<?php 
 }
 
 // connect to the database
 include('config.php');
 
 $type_i = 'unchecked';
 $type_c = 'unchecked';
 $day_1 = 'unchecked';
 $day_2 = 'unchecked';
 $sponsor_g = 'unchecked';
 $sponsor_s = 'unchecked';
 $sponsor_b = 'unchecked';
 $sponsor_n = 'unchecked';
 
  // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 {
 // confirm that the 'id' value is a valid integer before getting the form data
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 { 
 // get form data, making sure it is valid
 $id = $_GET['id'];
 $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
 $desc = mysql_real_escape_string(htmlspecialchars($_POST['desc']));
 $desc = str_replace(array('\r', '\n'), array(chr(13), chr(10)), $_POST['desc']);
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 $time = mysql_real_escape_string(htmlspecialchars($_POST['time']));
 $antispam = $_POST['antispam'];
 
 mysql_select_db($db) or die(mysql_error()); // Database setting is here
 $data = mysql_query("SELECT * FROM $company WHERE id='$id'") 
 or die(mysql_error()); 
 while($info = mysql_fetch_array( $data )) 
 {
 
 // required all fields
 if ($name == '' || $date == '' || $time == '')
 {
 $error = 'ERROR: All fields are required!';
 renderForm($id, $name, $desc, $time, $type_i, $type_c, $sponsor_g, $sponsor_s, $sponsor_b, $sponsor_n, $error, $day_1, $day_2);
 }
 else if (!isset($_POST['type'])) {
    $error = 'ERROR: All fields are required!';
    renderForm($id, $name, $desc, $time, $type_i, $type_c, $sponsor_g, $sponsor_s, $sponsor_b, $sponsor_n, $error, $day_1, $day_2);
 }
 else if (!isset($_POST['sponsor'])) {
    $error = 'ERROR: All fields are required!';
    renderForm($id, $name, $desc, $time, $type_i, $type_c, $sponsor_g, $sponsor_s, $sponsor_b, $sponsor_n, $error, $day_1, $day_2);
 }
 else if (!isset($_POST['date'])) {
    $error = 'ERROR: All fields are required!';
    renderForm($id, $name, $desc, $time, $type_i, $type_c, $sponsor_g, $sponsor_s, $sponsor_b, $sponsor_n, $error, $day_1, $day_2);
 }
 // prevent spambot from submitting form
 else if ($antispam !== '') {
 $error = 'ERROR: You are not human!';
 renderForm($id, $name, $desc, $time, $type_i, $type_c, $sponsor_g, $sponsor_s, $sponsor_b, $sponsor_n, $error, $day_1, $day_2);
 }
 else
 {
 $type = $_POST['type'];
 $sponsor = $_POST['sponsor'];
 $date = $_POST['date'];
 // save the data to the database
 mysql_query("UPDATE $company SET name='$name', type='$type', description='$desc', date='$date', time='$time', sponsor='$sponsor' WHERE id='$id'")
 or die(mysql_error());
 // once saved, redirect back to the view page
 header('Location: list_sessions.php');
 }
 }
 }
 
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 
 
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
 $id = $_GET['id'];
 $result = mysql_query("SELECT * FROM $company WHERE id='$id'")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 // get data from db
 $name = $row['name'];
 $desc = $row['description'];
 $time = $row['time'];
 
 if ($row['type'] == 'Interview') {
    $type_i = 'checked';
    $type_c = 'unchecked';
 } else if ($row['type'] == 'Career Talk') {
    $type_c = 'checked';
    $type_i = 'unchecked';
 }
 
 if ($row['date'] == 'Day 1') {
    $day_1 = 'checked';
    $day_2 = 'unchecked';
 } else if ($row['date'] == 'Day 2') {
    $day_2 = 'checked';
    $day_1 = 'unchecked';
 }
 
 if ($row['sponsor'] == 'Gold') {
    $sponsor_g = 'checked';
    $sponsor_s = 'unchecked';
    $sponsor_b = 'unchecked';
    $sponsor_n = 'unchecked';
 } else if ($row['sponsor'] == 'Silver') {
    $sponsor_s = 'checked';
    $sponsor_g = 'unchecked';
    $sponsor_b = 'unchecked';
    $sponsor_n = 'unchecked';
 } else if ($row['sponsor'] == 'Bronze') {
    $sponsor_b = 'checked';
    $sponsor_g = 'unchecked';
    $sponsor_s = 'unchecked';
    $sponsor_n = 'unchecked';
 } else if ($row['sponsor'] == 'Normal') {
    $sponsor_n = 'checked';
    $sponsor_g = 'unchecked';
    $sponsor_s = 'unchecked';
    $sponsor_b = 'unchecked';
 }
 
 // show form
 renderForm($id, $name, $desc, $time, $type_i, $type_c, $sponsor_g, $sponsor_s, $sponsor_b, $sponsor_n, '', $day_1, $day_2);
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>

<?php include('footer.php'); ?>

<?php ob_flush(); ?>