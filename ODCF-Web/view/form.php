<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registered users only! | Tutorialzine demo</title> 
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
    
<?php
define('INCLUDE_CHECK',true);

require '../debug.php';
require 'login_panel/login_panel.php';


if (!isset($_SESSION['id']))
  { 
    header("location: index.php");
  }

?>

</head>
<body>
<div id="main">
<div class="container">
<div id="contactForm">
      <h1>Request a New Virtual Machine</h1>
      <div class="sepContainer"></div>
      <form action="yourvm.php" method="post" id="contact_form">
        <div class="name">
          <label for="cpu">Processor - CPU:</label>
          <p> Please enter the number of cores</p>
          <input name=cpu type=number min=0 max=64 required />
        </div>
        <div class="name">
          <label for="ram">Memory - RAM:</label>
          <p> Please enter the amount of memory in MB</p>
          <input name=ram type=number min=0 max= required />
        </div>
        <div class="name">
          <label for="disk">Disk:</label>
          <p> Please enter the disk size in GB</p>
          <input name=disk type=number min=0 max=64 required />
        </div>
        <div class="name">
          <label for="io">Network - I/O:</label>
          <p> Please enter the expected bandwidth required</p>
          <input name=io type=number min=0 max=64 required />
        </div>
        <div class="email">
          <label for="name">Expiration Date:</label>
          <p> Until when do you want the virtual machine to be available</p>
          <input name=date type="datetime-local" required/>
        </div>
        <div id="loader">
          <p></p>
          <input type="submit" value="Submit" />
        </div>
      </form>
    </div>
    </div>
    </div>
    </body>
</html>
