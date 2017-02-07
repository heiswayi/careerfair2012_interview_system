<?php ob_start(); ?>

<?php require('auth/auth.php'); ?>

<?php include('header.php'); ?>

<?php include('nav.php'); ?>

<?php include('logo.php'); ?>

<?php
 function renderForm($id, $name, $ic, $matrix, $course, $address, $email, $phone, $comp, $type, $time, $date, $year1, $year2, $year3, $year4, $year5, $page, $error)
 {
?>
<div class="uiForm" id="make_center">
<div class="box_title">Edit User Profile</div>
<?php

if ($error != '')
{
echo '<div class="err">'.$error.'</div>';
}
?>
 
            <form action="" method="post">
            <table>
            <tr><td class="label"><strong>Fullname</strong></td><td><input style="padding:5px;width:400px;" maxlength="140" type="text" name="name" class="uiTextbox" value="<?php echo $name; ?>" /></td></tr>
            <tr><td class="label"><strong>I/C No.</strong></td><td><input style="padding:5px;width:200px;" maxlength="14" type="text" name="ic" class="uiTextbox" value="<?php echo $ic; ?>" /></td></tr>
            <tr><td class="label"><strong>Matrix No.</strong></td><td><input style="padding:5px;width:100px;" maxlength="6" type="text" name="matrix" class="uiTextbox" value="<?php echo $matrix; ?>" /></td></tr>
            <tr><td class="label"><strong>Course of Study</strong></td><td><input style="padding:5px;width:400px;" maxlength="140" type="text" name="course" class="uiTextbox" value="<?php echo $course; ?>" /></td></tr>
            <tr><td class="label"><strong>Year of Study</strong></td><td>
            <input type="radio" name="year" id="uiRadioYear-1" class="uiRadio" value="1" <?php echo $year1; ?>></input><label for="uiRadioYear-1" class="uiRadio">1</label>
            <input type="radio" name="year" id="uiRadioYear-2" class="uiRadio" value="2" <?php echo $year2; ?>></input><label for="uiRadioYear-2" class="uiRadio">2</label>
            <input type="radio" name="year" id="uiRadioYear-3" class="uiRadio" value="3" <?php echo $year3; ?>></input><label for="uiRadioYear-3" class="uiRadio">3</label>
            <input type="radio" name="year" id="uiRadioYear-4" class="uiRadio" value="4" <?php echo $year4; ?>></input><label for="uiRadioYear-4" class="uiRadio">4</label>
            <input type="radio" name="year" id="uiRadioYear-5" class="uiRadio" value="Master" <?php echo $year5; ?>></input><label for="uiRadioYear-5" class="uiRadio">Master</label>    
            </td></tr>
            <tr><td class="label"><strong>Mailing Address</strong></td><td><textarea style="padding:5px;width:600px;height:100px;" name="address" class="uiTextarea" /><?php echo $address; ?></textarea></td></tr>
            <tr><td class="label"><strong>Email</strong></td><td><input style="padding:5px;width:200px;" type="text" name="email" class="uiTextbox" value="<?php echo $email; ?>" /></td></tr>
            <tr><td class="label"><strong>Contact No.</strong></td><td><input style="padding:5px;width:200px;" type="text" name="phone" class="uiTextbox" value="<?php echo $phone; ?>" /></td></tr>
            
            <tr><td class="label"><strong>REGISTER FOR</strong><br><br>
            <div style="padding:5px;border:1px dashed #999;margin-right:20px;background:#eee;"><?php echo $type; ?><br>Session</div>
            </td><td>
            <div style="border-bottom:1px solid #ccc;margin-bottom:5px;">Information of the session you are going to register:</div>
            <div style="line-height:20px;padding-bottom:5px;border-bottom:1px solid #ccc;">
            <strong>Company name:</strong> <input style="padding:5px;width:400px;" maxlength="140" type="text" name="company" class="uiTextbox" value="<?php echo $comp; ?>" /><br>
            <strong>Session date:</strong> <input style="padding:5px;width:200px;" maxlength="140" type="text" name="date" class="uiTextbox" value="<?php echo $date; ?>" /><br>
            <strong>Session time:</strong> <input style="padding:5px;width:200px;" maxlength="140" type="text" name="time" class="uiTextbox" value="<?php echo $time; ?>" />
            </div>
            </td></tr>
           
            <input type="hidden" name="antispam" value="" />
            <input type="hidden" name="previouspage" value="<?php echo $page; ?>" />
            
            <tr><td class="label"></td><td><input type="submit" name="submit" class="uiButton uiButtonNormal" value="Submit"></td></tr>
            </table>
            </form>

</div>
           
<?php
 }
 
 // connect to the database
 include('config.php');
 
 $year1 = 'unchecked';
 $year2 = 'unchecked';
 $year3 = 'unchecked';
 $year4 = 'unchecked';
 $year5 = 'unchecked';
 
  // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 {
 // confirm that the 'id' value is a valid integer before getting the form data
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 { 
 // get form data, making sure it is valid
 $id = $_GET['id'];
 $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
 $ic = mysql_real_escape_string(htmlspecialchars($_POST['ic']));
 $matrix = mysql_real_escape_string(htmlspecialchars($_POST['matrix']));
 $course = mysql_real_escape_string(htmlspecialchars($_POST['course']));
 $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
 $phone = mysql_real_escape_string(htmlspecialchars($_POST['phone']));
 $comp = mysql_real_escape_string(htmlspecialchars($_POST['company']));
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 $time = mysql_real_escape_string(htmlspecialchars($_POST['time']));
 $page = $_POST['previouspage'];
 $antispam = $_POST['antispam'];
 
 mysql_select_db($db) or die(mysql_error()); // Database setting is here
 $data = mysql_query("SELECT * FROM $interview WHERE id='$id'") 
 or die(mysql_error()); 
 while($info = mysql_fetch_array( $data )) 
 {
 
 if ($antispam !== '') {
 $error = 'ERROR: You are not human!';
 renderForm($id, $name, $ic, $matrix, $course, $address, $email, $phone, $comp, $type, $time, $date, $year1, $year2, $year3, $year4, $year5, $page, $error);
 }
 else
 {
 $year = $_POST['year'];
 // save the data to the database
 mysql_query("UPDATE $interview SET name='$name', ic='$ic', matrix='$matrix', course='$course', email='$email', phone='$phone', company='$comp', date='$date', time='$time', year='$year' WHERE id='$id'")
 or die(mysql_error());
 // once saved, redirect back to the view page
 header('Location: namelist_admin.php?' . $page . '');
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
 $page = 'id=' . $_GET['pid'] . '&day=' . $_GET['pday'] . '';
 $result = mysql_query("SELECT * FROM $interview WHERE id='$id'")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 // get data from db
 $name = $row['name'];
 $ic = $row['ic'];
 $matrix = $row['matrix'];
 $course = $row['course'];
 $address = $row['address'];
 $email = $row['email'];
 $phone = $row['phone'];
 
 $comp = $row['company'];
 $type = $row['register'];
 $time = $row['time'];
 $date = $row['date'];
 
 if ($row['year'] == '1') { $year1 = 'checked'; $year2 = 'unchecked'; $year3 = 'unchecked'; $year4 = 'unchecked'; $year5 = 'unchecked'; }
 else if ($row['year'] == '2') { $year1 = 'unchecked'; $year2 = 'checked'; $year3 = 'unchecked'; $year4 = 'unchecked'; $year5 = 'unchecked'; }
 else if ($row['year'] == '3') { $year1 = 'unchecked'; $year2 = 'unchecked'; $year3 = 'checked'; $year4 = 'unchecked'; $year5 = 'unchecked'; }
 else if ($row['year'] == '4') { $year1 = 'unchecked'; $year2 = 'unchecked'; $year3 = 'unchecked'; $year4 = 'checked'; $year5 = 'unchecked'; }
 else if ($row['year'] == 'Master') { $year1 = 'unchecked'; $year2 = 'unchecked'; $year3 = 'unchecked'; $year4 = 'unchecked'; $year5 = 'checked'; }
 
 // show form
 renderForm($id, $name, $ic, $matrix, $course, $address, $email, $phone, $comp, $type, $time, $date, $year1, $year2, $year3, $year4, $year5, $page, '');
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