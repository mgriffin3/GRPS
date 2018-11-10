<?php
/**
 * Created by PhpStorm.
 * User: Lappy
 * Date: 10/30/2018
 * Time: 1:30 AM
 */
require "pageGetter.php";
require "dbConnector.php";
require "challengeHandler.php";
require "duplicateChecker.php";
require "challenge.php";


/*$info = new siteInfo;
$dom = new pageGetter($info->url);
//$list = new indexHandler($info->oldestFirst);
$dbConn = new dbConnector($info->site);
$duplicate = new duplicateChecker($info->site);

$info->getDataFromIndex($dom->html, $duplicate, $dbConn);     //populate list*/



$handler = new challengeHandler();
$handler->handle();
$handler->insertChallengesFromList();