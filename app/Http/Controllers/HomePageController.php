<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScrapeService;
use App\Models\Carro;
use App\Http\Resources\CarResource;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    

    public function homePage() {
        return view('welcome');
    }

    public function search(Request $request)
    {
       $termo = str_replace(' ', '+', $request->input('search'));
       $scrape = new ScrapeService();
       $results = $scrape->scrape($termo);
       return $results;
    }
}
