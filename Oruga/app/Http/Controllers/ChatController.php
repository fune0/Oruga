<?php

namespace App\Http\Controllers;

use App\Notifications\Ordered;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('summaries.index'); //chat画面表示
    }
}
