<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 9/08/14
 * Time: 5:40 PM
 */

require_once(__DIR__."/../public_html/_libs/constants.php");

require_once(__DIR__."/../_libs/Sitemap.php");

$PDO = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

try {
    $stmt = $PDO->query("SELECT * FROM ServerList1");
    $Servers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    exit(1);
}

$Sitemap = new Sitemap('http://mcpestats.com');
$Sitemap->setPath("/var/www/mcpestats.com/public_html/");

$Sitemap->addItem("/", '1.0', 'hourly');
$Sitemap->addItem("/links", '0.8', 'weekly');
$Sitemap->addItem("/login/", '0.3', 'monthly');
$Sitemap->addItem("/insert", '0.3', 'monthly');

foreach($Servers as $Server)
{
    $Sitemap->addItem("/server/{$Server['id']}", '0.5', 'daily');
}

$Sitemap->createSitemapIndex('http://mcpestats.com/');
