<?php ob_start(); ?>

<?php require('auth/auth.php'); ?>

<?php include('header.php'); ?>

<?php include('nav.php'); ?>

<?php include('logo.php'); ?>

<?php
 function renderForm($error)
 {
?>
<div class="uiForm" id="make_center">
<div class="box_title">Add a session</div>
<?php

if ($error != '')
{
echo '<div class="err">'.$error.'</div>';
}
?>
 
            <form action="" method="post">
            <table>
            <tr><td class="label"><strong>Company Name</strong></td><td><input style="padding:5px;width:400px;" type="text" name="name" class="uiTextbox uiTextInputPlaceholder" value="Enter company name here" /></td></tr>
            <tr><td class="label"><strong>Session Type</strong></td><td>
            <input type="radio" name="type" id="uiRadioType-1" class="uiRadio" value="Interview"></input><label for="uiRadioType-1" class="uiRadio">Interview</label>
            <input type="radio" name="type" id="uiRadioType-2" class="uiRadio" value="Career Talk"></input><label for="uiRadioType-2" class="uiRadio">Career Talk</label>
            </td></tr>
            <tr><td class="label"><strong>Company Description</strong></td><td><textarea style="padding:5px;width:600px;height:100px;" name="desc" class="uiTextarea uiTextInputPlaceholder" />Description about the company</textarea></td></tr>
            <tr><td class="label"><strong>Session Date</strong></td><td>
            <input type="radio" name="date" id="uiRadioDate-1" class="uiRadio" value="Day 1"></input><label for="uiRadioDate-1" class="uiRadio">Day 1</label>
            <input type="radio" name="date" id="uiRadioDate-2" class="uiRadio" value="Day 2"></input><label for="uiRadioDate-2" class="uiRadio">Day 2</label></td></tr>
            <tr><td class="label"><strong>Session Time</strong></td><td><input style="padding:5px;width:200px;" type="text" name="time" class="uiTextbox uiTextInputPlaceholder" value="Enter available time range" /><br>
            <div class="desc"><strong>Example 1:</strong> 9 am - 10 pm<br>
            <strong>Example 2:</strong> 9 am - 10 pm &amp; 2 pm - 5 pm<br>
            * Time range is limited to particular date!</div></td></tr>
            <tr><td class="label"><strong>Sponsor Category</strong></td><td>
            <input type="radio" name="sponsor" id="uiRadioSponsor-1" class="uiRadio" value="Gold"></input><label for="uiRadioSponsor-1" class="uiRadio">Gold</label>
            <input type="radio" name="sponsor" id="uiRadioSponsor-2" class="uiRadio" value="Silver"></input><label for="uiRadioSponsor-2" class="uiRadio">Silver</label>
            <input type="radio" name="sponsor" id="uiRadioSponsor-3" class="uiRadio" value="Bronze"></input><label for="uiRadioSponsor-3" class="uiRadio">Bronze</label>
            <input type="radio" name="sponsor" id="uiRadioSponsor-4" class="uiRadio" value="Normal"></input><label for="uiRadioSponsor-4" class="uiRadio">N/A</label>
            </td></tr>
           
            <input type="hidden" name="antispam" value="" />
            
            <tr><td class="label"></td><td><input type="submit" name="submit" class="uiButton uiButtonNormal" value="Add Session"></td></tr>
            </table>
            </form>

</div>
           
<?php 
 }
 
 // connect to the database
 include('config.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
 $desc = mysql_real_escape_string(htmlspecialchars($_POST['desc']));
 $desc = str_replace("\n","<br/>",$desc);
 $desc = str_replace("\r","<br/>",$desc);
 $desc = strip_tags($desc); 
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 $time = mysql_real_escape_string(htmlspecialchars($_POST['time']));
 $antispam = $_POST['antispam'];
 
 // required all fields
 if ($name == '' || $date == '' || $time == '')
 {
 $error = 'ERROR: All fields are required!';
 renderForm($error);
 }
 else if (!isset($_POST['type'])) {
    $error = 'ERROR: All fields are required!';
    renderForm($error);
 }
 else if (!isset($_POST['sponsor'])) {
    $error = 'ERROR: All fields are required!';
    renderForm($error);
 }
 else if (!isset($_POST['date'])) {
    $error = 'ERROR: All fields are required!';
    renderForm($error);
 }
 // prevent spambot from submitting form
 else if ($antispam !== '') {
 $error = 'ERROR: You are not human!';
 renderForm($error);
 }
 else
 {
 $type = $_POST['type'];
 $sponsor = $_POST['sponsor'];
 $date = $_POST['date'];
 // save the data to the database
 mysql_query("INSERT $company SET name='$name', type='$type', description='$desc', date='$date', time='$time', sponsor='$sponsor'")
 or die(mysql_error());
 // once saved, redirect back to the view page
 header('Location: list_sessions.php');
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('');
 }
?>

<?php include('footer.php'); ?>

<?php ob_flush(); ?>