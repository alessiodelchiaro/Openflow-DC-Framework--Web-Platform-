<?php

define('INCLUDE_CHECK',true);

require 'debug.php';
require 'view/login_panel/login_panel.php';

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
    {
        echo '<h1>Hello, Guest!</h1>';
        echo '<h2>Please, login to explore the Openflow Datacenter!</h2>';
    }
    ?>

        </div>
    </body>
</html>
