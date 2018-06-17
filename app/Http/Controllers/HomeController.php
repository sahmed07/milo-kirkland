<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pets = \App\Pet::latest()->limit(5)->get(); 
        $contentpages = \App\ContentPage::latest()->limit(3)->get(); 
        $contentcategories = \App\ContentCategory::latest()->limit(5)->get(); 
        $payments = \App\Payment::latest()->limit(2)->get(); 

        return view('home', compact( 'pets', 'contentpages', 'contentcategories', 'payments' ));
    }
}
