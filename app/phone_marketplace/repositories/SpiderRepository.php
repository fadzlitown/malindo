<?php

/**
 * Author       : Rifki Yandhi
 * Date Created : Sep 24, 2014 9:59:52 PM
 * File         : SpiderRepository.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class SpiderRepository
{

    function get_url_contents($url, $timeout = 10, $userAgent = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_8; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.215 Safari/534.10')
    {
        $rawhtml = curl_init();  //create our handler
        curl_setopt($rawhtml, CURLOPT_URL, $url);  //set the url
        curl_setopt($rawhtml, CURLOPT_RETURNTRANSFER, 1);  //return result as string rather than direct output
        curl_setopt($rawhtml, CURLOPT_CONNECTTIMEOUT, $timeout);  //set the timeout
        curl_setopt($rawhtml, CURLOPT_USERAGENT, $userAgent);  //set our 'user agent'
        $output  = curl_exec($rawhtml);  //execute the curl call
        curl_close($rawhtml);  //close our connection
        if (!$output) {
            return -1;  //if nothing was obtained, return '-1'
        }
        return $output;
    }

    function get_item_detail($url)
    {
        $html_string = get_url_contents($url);
        $doc         = new DOMDocument();
        $doc->loadHTML($html_string);

        $xpath = new DOMXPath($doc);
        $nodes = $xpath->query('//div[@class="s_specs_box s_box_4"]/ul/li');

        $details = [];

        foreach ($nodes as $node) {
            $node_value = $node->nodeValue;
            $values     = explode(":", $node_value);
            $item       = ['attribute' => ucwords(trim($values[0])), 'value' => ucwords(trim($values[1]))];
            array_push($details, $item);
        }

        return $details;
    }

}

/* End of file SpiderRepository.php */