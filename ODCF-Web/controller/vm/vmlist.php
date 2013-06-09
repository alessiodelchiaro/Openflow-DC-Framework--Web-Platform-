            <?php
            require dirname(__FILE__).'/../../model/connect.php';
            require dirname(__FILE__).'/../../model/database.php';
            ?>

            <table id="rounded-corner" summary="List of Virtual Machines">
                <thead>
                    <tr>
                    <?php
                    //Get the List of vm's for this user
                    $vm_list = get_vm($_SESSION['usr']);
                    //Draw the header
                    $table_title = array("ID", "CPU (#Cores)", "RAM (MB)", "DISK (GB)", "IO (Mbps)","IP Address", "Expiration date", 
                        "Date created", "Status", "Group ID");
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
                        <td colspan="9" class="rounded-foot-left">
                            <em></em>
                        </td>
                        <td class="rounded-foot-right">&nbsp;</td>
                    </tr>
                </tfoot>
            <tbody>
                <?php
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