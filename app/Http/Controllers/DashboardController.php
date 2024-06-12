<?php

namespace App\Http\Controllers;

use App\Models\Nieuws;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all news from the database
        $news = Nieuws::all();
        // Pass the news data to the view
        return view('dashboard', ['news' => $news]);

    }
}
