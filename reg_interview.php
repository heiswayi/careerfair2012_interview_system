<?php
 function renderForm($time, $date, $comp, $type, $error)
 {
?>
<div class="uiForm" id="make_center">
<div class="box_title">Register for Interview Session</div>
<?php

if ($error != '')
{
echo '<div class="err">'.$error.'</div>';
}
?>
 
            <form action="" method="post">
            <table>
            <tr><td class="label"><strong>Fullname</strong></td><td><input style="padding:5px;width:400px;" maxlength="140" type="text" name="name" class="uiTextbox uiTextInputPlaceholder" value="Enter your fullname here" /></td></tr>
            <tr><td class="label"><strong>I/C No.</strong></td><td><input style="padding:5px;width:200px;" maxlength="14" type="text" name="ic" class="uiTextbox uiTextInputPlaceholder" value="Ex.: 870304-10-5949" /></td></tr>
            <tr><td class="label"><strong>Matrix No.</strong></td><td><input style="padding:5px;width:100px;" maxlength="6" type="text" name="matrix" class="uiTextbox uiTextInputPlaceholder" value="Ex.: 101122" /></td></tr>
            <tr><td class="label"><strong>Course of Study</strong></td><td><input style="padding:5px;width:400px;" maxlength="140" type="text" name="course" class="uiTextbox uiTextInputPlaceholder" value="" /></td></tr>
            <tr><td class="label"><strong>Year of Study</strong></td><td>
            <input type="radio" name="year" id="uiRadioYear-1" class="uiRadio" value="1"></input><label for="uiRadioYear-1" class="uiRadio">1</label>
            <input type="radio" name="year" id="uiRadioYear-2" class="uiRadio" value="2"></input><label for="uiRadioYear-2" class="uiRadio">2</label>
            <input type="radio" name="year" id="uiRadioYear-3" class="uiRadio" value="3"></input><label for="uiRadioYear-3" class="uiRadio">3</label>
            <input type="radio" name="year" id="uiRadioYear-4" class="uiRadio" value="4"></input><label for="uiRadioYear-4" class="uiRadio">4</label>
            <input type="radio" name="year" id="uiRadioYear-5" class="uiRadio" value="Master"></input><label for="uiRadioYear-5" class="uiRadio">Master</label>    
            </td></tr>
            <tr><td class="label"><strong>Mailing Address</strong></td><td><textarea style="padding:5px;width:600px;height:100px;" name="address" class="uiTextarea uiTextInputPlaceholder" />Enter your current mailing address here</textarea></td></tr>
            <tr><td class="label"><strong>Email</strong></td><td><input style="padding:5px;width:200px;" type="text" name="email" class="uiTextbox uiTextInputPlaceholder" value="Enter your email address here" /></td></tr>
            <tr><td class="label"><strong>Contact No.</strong></td><td><input style="padding:5px;width:200px;" type="text" name="phone" class="uiTextbox uiTextInputPlaceholder" value="Enter your phone number here" /></td></tr>
            
            <tr><td class="label"><strong>REGISTER FOR</strong><br><br>
            <div style="padding:5px;border:1px dashed #999;margin-right:20px;background:#eee;"><?php echo $type; ?><br>Session</div>
            </td><td>
            <div style="border-bottom:1px solid #ccc;margin-bottom:5px;">Information of the session you are going to register:</div>
            <div style="line-height:20px;padding-bottom:5px;border-bottom:1px solid #ccc;">
            <strong>Company name:</strong> <?php echo $comp; ?><br>
            <strong>Session date:</strong> <?php echo $date; ?><br>
            <strong>Session time:</strong> <?php echo $time; ?>
            </div>
            </td></tr>
           
            <input type="hidden" name="antispam" value="" />
            
            <tr><td class="label"></td><td><input type="submit" name="submit" class="uiButton uiButtonNormal" value="Submit"></td></tr>
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
 $ic = mysql_real_escape_string(htmlspecialchars($_POST['ic']));
 $matrix = mysql_real_escape_string(htmlspecialchars($_POST['matrix']));
 $course = mysql_real_escape_string(htmlspecialchars($_POST['course']));
 $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
 $address = str_replace("\n","<br/>",$address);
 $address = str_replace("\r","<br/>",$address); 
 $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
 $phone = mysql_real_escape_string(htmlspecialchars($_POST['phone']));
 $antispam = $_POST['antispam'];
 
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
 $id = $_GET['id'];
 $result = mysql_query("SELECT * FROM $company WHERE id='$id'") or die(mysql_error());
 $row = mysql_fetch_array($result);
 if($row) {
 $time = $row['time'];
 if ($row['date'] == 'Day 1') { $date = $day1; }
 else if ($row['date'] == 'Day 2') { $date = $day2; }
 $comp = $row['name'];
 $type = $row['type'];
 }
 }
 
 // required all fields
 if ($name == '' || $ic == '' || $matrix == '' || $course == '' || $address == '' || $email == '' || $phone == '' || $time == '')
 {
 $error = 'ERROR: All fields are required!';
 renderForm($time, $date, $comp, $type, $error);
 }
 else if (!isset($_POST['year'])) {
    $error = 'ERROR: All fields are required!';
    renderForm($time, $date, $comp, $type, $error);
 }
 // prevent spambot from submitting form
 else if ($antispam !== '') {
 $error = 'ERROR: You are not human!';
 renderForm($time, $date, $comp, $type, $error);
 }
 else
 {
 $year = $_POST['year'];
 // save the data to the database
 mysql_query("INSERT $interview SET name='$name', matrix='$matrix', ic='$ic', course='$course', year='$year', address='$address', email='$email', phone='$phone', company='$comp', register='$type', date='$date', time='$time'")
 or die(mysql_error()); 
 // once saved, redirect back to the view page
 header('Location: reg_interview_success.php');
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
 $id = $_GET['id'];
 $result = mysql_query("SELECT * FROM $company WHERE id='$id'") or die(mysql_error());
 $row = mysql_fetch_array($result);
 if($row) {
 $time = $row['time'];
 if ($row['date'] == 'Day 1') { $date = $day1; }
 else if ($row['date'] == 'Day 2') { $date = $day2; }
 $comp = $row['name'];
 $type = $row['type'];
 }
 renderForm($time, $date, $comp, $type, '');
 }
 }
?> 