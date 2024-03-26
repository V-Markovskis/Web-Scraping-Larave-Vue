<?php

use GuzzleHttp\Client;

function paginationUrlCheck ($url): string
{
    // Init Guzzle
    $client = new Client();

    // Get request
    $response = $client->request('GET', $url);

    $response_status_code = $response->getStatusCode();

    $html = $response->getBody()->getContents();

    // Create a new DOMDocument object
    $dom = new DOMDocument();

    // Load HTML from a string
    $dom->loadHTML($html);

    // Create a new DOMXPath object for executing XPath queries
    $xpath = new DOMXPath($dom);


    // Get the <a> element with the class "morelink"
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
            $page_number = intval($parts[1]);

            // Check if we need to change the URL
            if ($page_number > 2) {
                // Form a new URL
                return 'https://news.ycombinator.com/?p=' . ($page_number - 1);
            }
        }
    }
    return 'https://news.ycombinator.com/';
}
