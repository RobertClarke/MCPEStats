<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 9/08/14
 * Time: 4:02 PM
 */

echo "Running DB Update 1...";

require_once(__DIR__."/../public_html/_libs/constants.php");

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die(mysqli_error($connect));
mysqli_select_db($connect, DB_NAME) or die(mysqli_error($connect));

mysqli_query($connect, "ALTER TABLE ServerList1 ADD ServerMCPEVersion VARCHAR(16);") or die(mysqli_error($connect));
mysqli_query($connect, "ALTER TABLE ServerList1 ADD Map VARCHAR(64);") or die(mysqli_error($connect));
mysqli_query($connect, "ALTER TABLE ServerList1 ADD GameType VARCHAR(8);") or die(mysqli_error($connect));
mysqli_query($connect, "ALTER TABLE ServerList1 ADD Software VARCHAR(32);") or die(mysqli_error($connect));
mysqli_query($connect, "ALTER TABLE ServerList1 ADD Plugins TEXT;") or die(mysqli_error($connect));
mysqli_query($connect, "ALTER TABLE ServerList1 ADD Players TEXT;") or die(mysqli_error($connect));

echo "done!\n";