<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DeleteSingleArticleController extends Controller {
    public function deleteSingle($id) {

        DB::table('articles')->where('id', $id)->delete();

        return response()->json(['success' => true]);
    }
}
