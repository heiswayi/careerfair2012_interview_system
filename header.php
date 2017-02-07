<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
  <title>Online Application System | Career Fair 2012, USM Engineering Campus</title>
  <meta name="description" content="">
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="robots" content="all" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
    
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/ui-toolkit.css" rel="stylesheet" type="text/css"/>
  <link href="css/style.css" rel="stylesheet" type="text/css"/>

  <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
  <script type="text/javascript" src="js/ui-toolkit.js"></script>
  
  <script>
  function updateCountdown() {
    // 500 is the max message length
    var remaining = 5000 - jQuery('#secretmsg').val().length;
    jQuery('.secretmsg_char').text(remaining + ' characters remaining.');
  }

  jQuery(document).ready(function($) {
    updateCountdown();
    $('#secretmsg').change(updateCountdown);
    $('#secretmsg').keyup(updateCountdown);  
  });
  </script>
    
</head>
<body>