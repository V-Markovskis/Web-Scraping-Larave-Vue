<?php

namespace App\Http\Controllers;

use DateTime;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;

class MainController extends Controller
{
    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function scrape(Request $request)
    {
        //get url param for scraping
        $url = $request->get('url');

        // Init Guzzle
        $client = new \GuzzleHttp\Client();

        for ($i = 1; $i <= 3; $i++) {
            $response = $client->request('GET', $url, [
                'query' => ['p' => $i]
            ]);

            $response_status_code = $response->getStatusCode();

            $html = $response->getBody()->getContents();

            // Create a new DOMDocument object
            $dom = new DOMDocument();

            // Load HTML from a string
            $dom->loadHTML($html);

            // Create a new DOMXPath object for executing XPath queries
            $xpath = new DOMXPath($dom);

            // Find all <tr> elements with class "athing"
            $items = $xpath->query('//tr[@class="athing"]');

            $resultArray = [];

            if ($response_status_code==200) {
                $index = 0;
                foreach ($items as $item) {
                    $title = $xpath->query('//span[@class="titleline"]/a')->item($index)->nodeValue;

                    $link = $xpath->query('//span[@class="titleline"]/a')->item($index)->getAttribute('href');

                    $points = $xpath->query('.//span[@class="score"]')->item($index)->nodeValue ?? 0;

                    // take only numeric value
                    preg_match('/(\d+)/', $points, $matches);
                    $points = $matches[0];

                    $dateString = $xpath->query('//span[@class="age"]')->item($index)->getAttribute('title');
                    $date = new DateTime($dateString); // Assuming the date string is in a valid format
                    $dateString = $date->format('Y-m-d H:i:s');

                    $resultArray[] = [
                        'title' => $title,
                        'link' => $link,
                        'points' => $points,
                        'date' => $dateString
                    ];

                    $index += 1;
                }

                foreach ($resultArray as $item) {
                    foreach ($item as $key => $value) {
                        echo '<strong>' . $key . ':</strong> ' . $value . '<br>';
                    }
                    echo '<br>';
                }
            }
        }
    }
}
























//if ($response_status_code==200) {
//    // Выполнение XPath-запроса для выбора первого элемента <a> внутри элемента span с классом "titleline"
//    $queryLink = "//span[@class='titleline']/a";
//    $links = $xpath->query($queryLink);
//    $link = $links->item(0)->getAttribute('href');
//
//    // Выполнение XPath-запроса для выбора всех элементов <a> внутри элементов span с классом "titleline"
//    $queryTitle = "//span[@class='titleline']/a";
//    $titles = $xpath->query($queryTitle);
//    $title = $titles->item(0)->nodeValue;
//
//    // Выполнение XPath-запроса для выбора элемента <span> с классом "score"
//    $queryScore = "//span[@class='score']";
//    $scores = $xpath->query($queryScore);
//    $score = intval($scores->item(0)->nodeValue); // Преобразование в целое число
//
//    // Преобразование текстовой даты в объект DateTime
//    $queryDate = "//span[@class='age']";
//    $dateText = $scores->item(0)->getAttribute('title');
//    $date = new DateTime($dateText);
//
//    // Создание объекта с полученными данными
//    $articleData = [
//        'title' => $title,
//        'link' => $link,
//        'points' => $score,
//        'date_created' => $date->format('Y-m-d H:i:s'),
//    ];
//
//    dd($articleData);
//}
