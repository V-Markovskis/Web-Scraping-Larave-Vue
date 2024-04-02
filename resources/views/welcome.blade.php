<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Laravel 8 / Vue.js Task</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            Welcome to Laravel / Vue.js Task
                        </div>
                        <div class="card-body">
                            <p>This task involves creating a scraper that retrieves data from <a href="https://news.ycombinator.com/">Hacker News</a> and stores it in a local database (MySQL).</p>
                            <p>To access the scraper, registration or login is required. Laragon and phpMyAdmin were utilized for this purpose. Laragon is a tool that facilitates easy setup and configuration of WAMP or LAMP development environments on your computer.</p>
                            <p>The frontend part is displayed using DataTables.</p>
                        </div>

                        <div class="card-footer d-flex gap-4">
                            <a href="/register" class="btn btn-success">Register</a>
                            <a href="/login" class="btn btn-info">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
