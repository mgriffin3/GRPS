<?php
/**
 * Created by PhpStorm.
 * User: Lappy
 * Date: 11/1/2018
 * Time: 10:02 PM
 */
//todo:
//quotes in text break insert (challenge.php)
//make challengeHandler.php
//fix $end in $info*
//clean up code
//handle 0 duplicate checker results



class siteInfo
{
    private $site;
    private $url;
    private $maxChallenges;

    public function __construct()
    {
        $this->site = "projecteuler";
        $this->url = "https://projecteuler.net/recent";
        $this->maxChallenges = 3;   //how many links will be visited to get challenges each time program runs
    }

    public function __get($property)
    {
        return $this->$property;
    }


    //parses DomDocument to extract data from index page(s) and store in a doubly linked list
    //Because of predictable naming system, links are generated rather than parsed.
    public function getDataFromIndex($list){
        $duplicate = new duplicateChecker($this->site);
        $dom = new pageGetter($this->url);      //turns URL of index into DOMDocument
        //$newestChallengeFromDom = $dom->getElementbyID("problems_table")->getElementbyTagName("a")[0];  //gets url of first link in problems table
        $newestChallengeFromDom = "https://projecteuler.net/problem=641"; //todo: get $newestChallengeFromDom working

        if ($duplicate->compare($newestChallengeFromDom)) {
            die("No new challenges found");
        }

        if ($duplicate->lastConstructed->id == null) //database is empty
            {$start = 0;}
        else
            {$start = $duplicate->lastConstructed->id;}

        //build linked list
        $end = $start + $this->maxChallenges;
        for ($i = $start + 1; $i <= $end; $i++){
            $url = "https://projecteuler.net/problem=" . $i;
            $curr = new Challenge("$this->site","$i","$url","","");
            $list->push($curr);     //add $curr to end of list
            if ($url == $newestChallengeFromDom) {      //have reached the newest posted challenge
                echo "All challenges uploaded";
                break;
            }
        }
    }

    public function getDataFromChallenge($challenge){
        $projectDOM = new pageGetter($challenge->url);
        $challenge->title = $projectDOM->html->getElementsByTagName("h2")[0]->nodeValue;   //text of first instance of <h2>
        //gets all <p> content
        $text = $projectDOM->html->getElementsByTagName("p");
        $str = "";
        foreach ($text as $para){
            $str .= "<p>" . $para->nodeValue . "</p>";
        }
        $challenge->text = $str;
    }
}