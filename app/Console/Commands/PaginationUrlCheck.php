<?php

use GuzzleHttp\Client;

function paginationUrlCheck ()
{
    $url = 'https://news.ycombinator.com/';

    $max_pages = 0;
    $page = 1;

    while($page !== 0) {
        $current_url = $url . '?p=' . $page;

        // Init Guzzle
        $client = new Client();

        // Get request
        $response = $client->request('GET', $current_url);

        $response_status_code = $response->getStatusCode();

        $html = $response->getBody()->getContents();

        // Create a new DOMDocument object
        $dom = new DOMDocument();

        // Load HTML from a string
        $dom->loadHTML($html);

        // Create a new DOMXPath object for executing XPath queries
        $xpath = new DOMXPath($dom);


        //Get the <a> element with the class "morelink"
        $next_page_link = $xpath->query('//td[@class="title"]/a[@class="morelink"]')->item(0);

        // Check that the link to the next page exists and has the href attribute
        if ($next_page_link) {
            $next_page_href = $next_page_link->getAttribute('href');
            var_dump($next_page_href);

            // Check if the attribute contains the "p" parameter
            if (str_contains($next_page_href, '?p=')) {
                // Split the string by the "=" sign.
                $parts = explode('=', $next_page_href);

                // Get the value of parameter "p"
                $page = intval($parts[1]);
                $max_pages = $page;
            }
        } else {
            $page = 0;
        }
    }

    return $max_pages;
}
