<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function index() {
        $lists = \App\Summary::all();
        return view("summaries.index")->with('lists', $lists);
    }

}
