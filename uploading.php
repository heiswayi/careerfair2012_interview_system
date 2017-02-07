<?php ob_start(); ?>

<?php include('header.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">
<div class="box_title">Upload a Resume</div>

<?php
$name = htmlspecialchars($_POST['name']);
$matrix = htmlspecialchars($_POST['matrix']);

function sanitize($string, $force_lowercase = true, $anal = false) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "—", "–", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}

$filenamex = $_FILES['file']['name'];
$ext = substr($filenamex, strpos($filenamex,'.'), strlen($filenamex)-1);
$resumefile = $name . ' ' . $matrix;
$filesize = $_FILES['file']['size'] / 1024;

echo '<table>';
if ($_FILES['file']['name'] == '') {
  echo '<tr><td class="label"></td><td><span class="failure">Resume upload failed!</span></td></tr>';
  echo '<tr><td class="label"></td><td>';
  echo 'ERROR: You are not select any file to be uploaded!</td></tr>';
  echo '<tr><td class="label"></td><td>';
  echo '<a href="http://careerfair.eng.usm.my/registration/upload_resume.php" class="uiButton uiButtonNormal">Go Back</a></td></tr>';
} else {
if ($ext == '.doc' || $ext == '.docx' || $ext == '.pdf') {
if ($name == '' || $matrix == '')  {
  echo '<tr><td class="label"></td><td><span class="failure">Resume upload failed!</span></td></tr>';
  echo '<tr><td class="label"></td><td>';
  echo 'ERROR: Please insert your <strong>name</strong> and your <strong>matrix number</strong>.</td></tr>';
  echo '<tr><td class="label"></td><td>';
  echo '<a href="http://careerfair.eng.usm.my/registration/upload_resume.php" class="uiButton uiButtonNormal">Go Back</a></td></tr>';
}
else if ($_FILES['file']['size'] > 5000000) {
  echo '<tr><td class="label"></td><td><span class="failure">Resume upload failed!</span></td></tr>';
  echo '<tr><td class="label"></td><td>';
  echo 'ERROR: Your file size is too big, more than 1 Mb!</td></tr>';
  echo '<tr><td class="label"></td><td>';
  echo '<a href="http://careerfair.eng.usm.my/registration/upload_resume.php" class="uiButton uiButtonNormal">Go Back</a></td></tr>';
}
else {
  echo '<tr><td class="label"></td><td><span class="success">Resume is successfully uploaded. Thank You!</span></td></tr>';
  echo '<tr><td class="label"><strong>Original Filename</strong></td><td>' . $_FILES['file']['name'] . '</td></tr>';
  echo '<tr><td class="label"><strong>Filetype</strong></td><td>' . $_FILES['file']['type'] . '</td></tr>';
  echo '<tr><td class="label"><strong>Filesize</strong></td><td>' . round($filesize, 2) . ' Kb</td></tr>';
  echo '<tr><td class="label"></td><td></td><tr>';
  move_uploaded_file($_FILES['file']['tmp_name'], '../resume/' . sanitize($resumefile) . $ext);
  echo '<tr><td class="label"><strong>New Filename</strong></td><td>' . sanitize($resumefile) . $ext . '</td></tr>';
  echo '<tr><td class="label"><strong>Reference Link</strong></td><td><a href="http://careerfair.eng.usm.my/resume/' . sanitize($resumefile) . $ext . '">http://careerfair.eng.usm.my/resume/' . sanitize($resumefile) . $ext . '</a></td></tr>';
  echo '<tr><td class="label"></td><td></td><tr>';
  echo '<tr><td class="label"></td><td><a href="http://careerfair.eng.usm.my" class="uiButton uiButtonNormal">Back to Homepage</a></td><tr>';
}
} else {
echo '<tr><td class="label"></td><td><span class="failure">Resume upload failed!</span></td></tr>';
echo '<tr><td class="label"></td><td>';
echo 'ERROR: Only file with extension; <strong>.doc</strong> / <strong>.docx</strong> / <strong>.pdf</strong> is allowed!</td></tr>';
echo '<tr><td class="label"></td><td>';
echo '<a href="http://careerfair.eng.usm.my/registration/upload_resume.php" class="uiButton uiButtonNormal">Go Back</a></td></tr>';
}
}
echo '</table>';
?>

</div>
</div>

<?php include('footer.php'); ?>

<?php ob_flush(); ?>