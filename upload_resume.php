<?php include('header.php'); ?>

<?php include('nav1.php'); ?>

<?php include('logo.php'); ?>

<div class="uiForm" id="make_center">
<div class="box_title">Upload a Resume</div>

<div style="margin:10px 0;padding:5px;border:1px solid #ff9900;background:#ffcc33;color:#111;">
The resume collection system is ONLY for database purpose. Only USM authority has the right accesses to it. PLEASE BRING ALONG YOUR RESUME FOR INTERVIEW. Thank you!
</div>

<form action="uploading.php" method="post" enctype="multipart/form-data">
<table>
<tr><td class="label"><strong>Your Name</strong></td><td><input maxlength="70" style="padding:5px;width:400px;" type="text" name="name" class="uiTextbox uiTextInputPlaceholder" value="Enter your fullname here" /> *</td></tr>
<tr><td class="label"><strong>Matrix No.</strong></td><td><input maxlength="6" style="padding:5px;width:200px;" type="text" name="matrix" class="uiTextbox uiTextInputPlaceholder" value="Enter your matrix no. here" /> *</td></tr>
<tr><td class="label"></td><td>Allowed file extension: <strong>.doc</strong>, .<strong>docx</strong>, <strong>.pdf</strong><br>Max. filesize: <strong>5 Mb</strong></td></tr>
<tr><td class="label"><strong>Select a File</strong></td><td>
<input class="uiTextbox uiTextInputPlaceholder" type="file" name="file" id="file" /> 
</td></tr>
<tr><td class="label"></td><td>* Required. Your name and matrix no. will be used as the name of your resume file.</td></tr>
<tr><td class="label"></td><td><input type="submit" name="submit" class="uiButton uiButtonNormal" value="Upload"> <a href="http://careerfair.eng.usm.my" class="uiButton uiButtonNormal">Cancel</a></td></tr>
</table>
</form>

</div>
</div>

<?php include('footer.php'); ?>