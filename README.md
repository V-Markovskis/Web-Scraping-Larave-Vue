## Brief Description

This project involves creating a scraper using Laravel and Vue.js to extract data from [*Hacker News*](https://news.ycombinator.com/).
The scraper will retrieve information such as title, link, points, and date created for each article. The extracted data will be stored in a local MySQL database,
utilizing phpMyAdmin. Access to the scraper interface will be restricted to registered users.

## Result

[YouTube Link](https://youtu.be/-r6NVCmG5Ow) - Here you can check out the result of my project.

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

8. **Access Your Project:**
   Once the server is running, you can access your project in the browser by entering the URL provided by Laragon.


