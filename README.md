## Brief Description

This project involves creating a scraper using Laravel and Vue.js to extract data from [*Hacker News*](https://news.ycombinator.com/).
The scraper will retrieve information such as title, link, points, and date created for each article. The extracted data will be stored in a local MySQL database,
utilizing phpMyAdmin. Only registered users will be able to view the scraper UI.

## Result

- Here you can check out the result of this project:

<a href="https://youtu.be/-r6NVCmG5Ow"><img src="https://cdn4.iconfinder.com/data/icons/free-social-media-icons-1/200/1469470444_Youtube-512.png" style="width:100px; height:100px;"></a>


## Requirements

- Laragon installed on your system.

## Setup Instructions

1. **Download and Install Laragon:**
   Download and install Laragon from the [official website](https://laragon.org/download/). Follow the installation instructions.

2. **Clone the Project:**
   Clone the project from the repository to your local computer.

3. **Configure Environment:**
   Create a `.env` file from the `.env.example` file in the root directory of the project. Configure the database connection parameters in the `.env` file.

4. **Install Composer Dependencies:**
   Open the command line and navigate to the project directory. Then run the command `composer install` to install dependencies.

5. **Generate Application Key:**
   Run the command `php artisan key:generate` to generate the Laravel application key.

6. **Run Migrations:**
   Execute the database migrations with the command `php artisan migrate`.

7. **Start Laragon:**
   Launch Laragon. Open Laragon and click the "Start All" button to start the Apache server and MySQL database.

8. **Viewing the UI:**
   To view the UI, you need to run the following command in your console: `npm run dev`

9. **Access Your Project:**
   Once the server is running, you can access your project in the browser by entering the URL provided by Laragon.

## Notes

- While scraping can be initiated through the UI, for testing purposes, you can also trigger it from the command line using the following command:
```bash
php artisan app:scrape
```
- To begin scraping, the `ScraperCommand.php` file contains the following code snippet:

```php
$max_pages = 3; // You can adjust this value to scrape more pages

for ($page = 1; $page <= $max_pages; $page++) {
    $response = $client->request('GET', $url, [
        'query' => ['p' => $page]
    ]);
```
> Warning: Increasing the number of pages to scrape may result in errors such as 503 (Service Unavailable) and 403 (Forbidden) due to excessive requests to the server. This could lead to your IP address being blocked or other access issues with the website. It is recommended to use scraping cautiously and consider the site's data usage policy and limitations.


## Additional Resources

[How to Install PHP & MySQL with Laragon on Windows](https://www.youtube.com/watch?v=zIbKfg-tIGM)
