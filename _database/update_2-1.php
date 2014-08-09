<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 9/08/14
 * Time: 4:02 PM
 */

echo "Running DB Update 2-1...";

require_once(__DIR__."/../public_html/_libs/constants.php");

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die(mysqli_error($connect));
mysqli_select_db($connect, DB_NAME) or die(mysqli_error($connect));

mysqli_query($connect, "UPDATE ServerList1 SET ServerMCPEVersion='v0.9.5 alpha';") or die(mysqli_error($connect));

echo "done!\n";