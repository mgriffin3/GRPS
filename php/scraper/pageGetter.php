<?php

class pageGetter
{
    public function __construct($url)
    {
        $this->html = new domDocument;
        $ch = curl_init();      //curl handler

        //connects to correct url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return instead of outputting directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //Remove header before returning
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //TODO: This is a workaround to bya
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //turns website source string into parseable domDocument
        @$this->html->loadHTML(curl_exec($ch));
        //error handling
/*        if ($output == FALSE) {
            echo "cURL Error: " . curl_error($ch);
        }*/

        curl_close($ch);
    }

    public function __get($property)
    {
        return $this->$property;
    }
}
