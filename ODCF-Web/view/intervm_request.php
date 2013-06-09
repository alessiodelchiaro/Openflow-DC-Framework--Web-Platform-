<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>OF Datacenter</title> 
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
    
<?php
define('INCLUDE_CHECK',true);
require 'login_panel.php';

?>

</head>
<body>
<div id="main">
<div class="container">
    <?php
        if(!isset($_SESSION['id']))
            echo '<h1>Login Required</h1><h2>Please, use the panel above to <a href="index.php">login</a>!</h2>';
        else{
    ?>
            <h1>List of Virtual Machines</h1>
            <table id="rounded-corner" summary="List of Virtual Machines">
                <thead>
                    <tr>
                        <?php
                        //Get the List of vm's for this user
                        $vm_list = get_vm($_SESSION['usr']);
                        //Draw the header
                        $table_title = $vm_list[0];
                        $counter = 1;
                        foreach ($table_title as $column)
                        {
                            if ($counter==1)
                                echo '<th scope="col" class="rounded-first">';
                            elseif ($counter==sizeof($table_title))
                                echo '<th scope="col" class="rounded-last">';
                            else
                                echo '<th scope="col">';

                            echo $column;
                            echo '</th>';
                            $counter+=1;
                        }   
                        ?>
                    </tr>
                </thead>
                    <tfoot>
                        <tr>
                            <td colspan="8" class="rounded-foot-left">
                                <em></em>
                            </td>
                            <td class="rounded-foot-right">&nbsp;</td>
                        </tr>
                    </tfoot>
                <tbody>
                    <?php
                    unset($vm_list[0]);

                    foreach ($vm_list as $vm)
                        {
                            echo "<tr>";
                            foreach ($vm as $value)
                            {
                                echo "<td>";
                                echo $value;
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <?php
        }
            ?>
        </div>     
    </div>   
</body>
</html>
