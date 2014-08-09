<?php
/**
 * Created by PhpStorm.
 * User: Michael Yoo
 * Date: 27/07/14
 * Time: 12:26 AM
 */

function removeServer($Owner, $IP, $Port, $login, $id)
{
    $connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
    mysqli_select_db($connect, DB_NAME);

    $Owner = mysqli_real_escape_string($connect, $Owner);
    $id = mysqli_real_escape_string($connect, $id);
    $IP = mysqli_real_escape_string($connect, $IP);
    $Port = mysqli_real_escape_string($connect, $Port);

    $stmt = mysqli_prepare($connect, "SELECT Owner FROM ServerList1 WHERE id=? LIMIT 0,1");
    mysqli_stmt_bind_param($stmt, "d", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $realOwner);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if(in_array($_SESSION['user_name'], $login->moderators) === true)
    {
        $stmt = mysqli_prepare($connect, "DELETE FROM ServerList1 WHERE id=?");
        mysqli_stmt_bind_param($stmt, "d", $id);
    }
    else
    {
        $stmt = mysqli_prepare($connect, "DELETE FROM ServerList1 WHERE id=? AND Owner=?");
        mysqli_stmt_bind_param($stmt, "ds", $id, $Owner);
    }
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    if($result)
    {
        return true;
    }
    else
    {
        return "Could Not delete Server IP:".$IP.":".$Port;
    }
}