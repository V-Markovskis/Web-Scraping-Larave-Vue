<?php

namespace App\Console\Commands;
require_once 'PaginationUrlCheck.php';

use DateTime;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ScrapeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape data from a website and store it in the database';

    /**
     * Execute the console command.
     * @throws GuzzleException
     * @throws \Exception
     */
    public function handle(): void
    {
        //get url param for scraping
        $url = 'https://news.ycombinator.com/';

        // Get a new URL for the next page
        // $new_url = paginationUrlCheck($url);

        // Init Guzzle
        $client = new Client();


        for ($i = 1; $i <= 1; $i++) {
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

                    //save data into db (phpmyadmin)
                    DB::table('articles')->insert([
                        'title' => $title,
                        'link' => $link,
                        'points' => $points,
                        'date_created' => $dateString
                    ]);

                    $index += 1;
                }
            }
        }
    }
}
