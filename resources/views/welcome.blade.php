<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/js/app.js')
{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
</head>
    <body>
        @extends('layouts.app')

        @section('content')
            <div id="app">
                <fetch-scraped-data></fetch-scraped-data>
            </div>
        @endsection>
    </body>
</html>
