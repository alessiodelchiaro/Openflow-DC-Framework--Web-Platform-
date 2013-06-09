<?php

   if(isset($_POST['BtnSubmit']))
   {
      echo "<h3>Your submitted form data as bellow</h3>";

      echo "Your Name : {$_POST['FullName']}</br>";
      echo "You Like : {$_POST['YourChoice']}</br>";

      echo "<hr>";
   }

?>

<h3>PHP HTML Form checkbox Example</h3>

<form name="UserInformationForm" method="POST" action="#">
      Enter Your Full Name :
      <input name="FullName" type="text" value="<?php echo $_POST['FullName']; ?>"><br/><br/>
      I Like :
      <input name="YourChoice" type="checkbox" value="fish" <?php if($_POST['YourChoice']=="fish") echo "checked=checked"; ?> > Fish
      <input name="YourChoice" type="checkbox" value="meat" <?php if($_POST['YourChoice']=="meat") echo "checked=checked"; ?> > Meat
      <input name="YourChoice" type="checkbox" value="vegetable" <?php if($_POST['YourChoice']=="vegetable") echo "checked=checked"; ?> > Vegetable
      <br/><br/>
      <input name="BtnSubmit" type="submit" value="Submit">
</form>