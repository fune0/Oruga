<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{

    public function search(Request $request) {//DBから検索

        return \App\Summary::whereSearch($request->word)->get();

    }
    
}
