<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DeleteAllController extends Controller
{
    public function deleteAll()
    {
        DB::table('articles')->delete();

        return response()->json(['message' => 'All articles have been deleted']);
    }
}
