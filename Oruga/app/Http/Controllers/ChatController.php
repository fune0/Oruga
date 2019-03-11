<?php

namespace App\Http\Controllers;

use App\Notifications\Ordered;
use Illuminate\Http\Request;
use App\Summary;

class ChatController extends Controller
{
    public function index()
    {
        return view('summaries.index'); //chat画面表示
    }
}
