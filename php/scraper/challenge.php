<?php
/**
 * Created by PhpStorm.
 * User: Lappy
 * Date: 11/4/2018
 * Time: 3:38 PM
 */

class challenge
{
    private $site;
    private $id;
    private $url;
    private $title;
    private $text;

    public function __construct($site, $id, $url, $title, $text){
    $this->site = $site;
    $this->id = $id;
    $this->url = $url;
    $this->title = $title;
    $this->text = $text;
}

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

}