<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ScrapeController extends Controller
{
    public function scrapeAndSave()
    {
        // Call the Artisan app:scrape command
        Artisan::call('app:scrape');

        $articles = DB::table('articles')->get();

        return response()->json(['data' => $articles]);
    }
}
