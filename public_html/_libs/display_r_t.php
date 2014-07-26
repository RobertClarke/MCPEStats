<?php
/**
 * Created by PhpStorm.
 * User: Michael Yoo
 * Date: 27/07/14
 * Time: 12:19 AM
 */

function display_r_t($name, $ip, $players, $maxplayers, $onlinestatus, $port, $customname, $whitelist, $id)
{
    echo "<tr>";
    if($onlinestatus == "Online")
        echo "<td><a href=/server/$id>$name</a></td>";
    else
        echo "<td>$name</td>";

    echo "<td>$customname</td>";

    if($whitelist == 0)
        echo '<td><span class="label label-success">Public</span></td>';
    else if($whitelist == 1)//Whitelist
        echo '<td><span class="label label-important">Whitelisted</span></td>';
    else if($whitelist == 2)//Registdation
        echo '<td><span class="label label-warning">Registdation</span></td>';
    else
        echo '<td><span class="label label-important">Unknown</span></td>';

    echo "
          <td>$ip:$port</td>
          <td>$players/$maxplayers</td><td>";
    if($onlinestatus == "Online")
        echo '<span class="label label-success">';
    else if($onlinestatus == "Offline")
        echo '<span class="label label-important">';
    else
        echo '<span class="label label-warning">';
    echo "$onlinestatus</td>
      </tr>";

    return true;
}