<?php
 //ini_set('display_errors', 'On');
// define('INCLUDE_CHECK',true);
define('INCLUDE_CHECK',true);
require 'login_panel.php';

?>

    <body>
        <div id="main">
            <div class="container">
    
    <?php
    if(isset($_SESSION['id'])){
        // require 'form.php';
        echo '<h1>Hello, '.$_SESSION['usr'].'!</h1>';
        echo '<h2>Feel free to explore the available options on the panel above!</h2>';
        }
    else
        echo '<h1>Please, login to explore the Openflow Datacenter!</h1>';
    ?>

        </div>
    </body>
</html>
