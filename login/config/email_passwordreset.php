<?php

/**
 * Configuration file for: password reset email data
 * This is the place where your constants are saved
 * 
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 */

/** absolute URL to register.php, necessary for email password reset links */
define("EMAIL_PASSWORDRESET_URL", "http://mcpe-list.sekjun9878.info/login/password_reset.php");

define("EMAIL_PASSWORDRESET_FROM", "noreply@mcpe-list.sekjun9878.info");
define("EMAIL_PASSWORDRESET_SUBJECT", "Password reset for MCPE Server List");
define("EMAIL_PASSWORDRESET_CONTENT", "Please click on this link to reset your password:");
