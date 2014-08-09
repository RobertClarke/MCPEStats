<?php
/**
 * Created by PhpStorm.
 * User: Michael Yoo
 * Date: 27/07/14
 * Time: 12:19 AM
 */

function display_r_t($name, $ip, $players, $maxplayers, $onlinestatus, $port, $customname, $whitelist, $id, $serverversion)
{
    echo "<tr>";
    echo "<td><a href=/server/$id>$name</a></td>";

    echo "<td>$customname</td>";

    echo "<td>$serverversion</td>";

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