<?php

namespace App\Http\Controllers;

use App\Models\Accommodations;
use App\Models\Reservation;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'hotels_count'=>Accommodations::hotels()->count(),
            'chalets_count'=>Accommodations::chalets()->count(),
            'appartments_count'=>Accommodations::appartments()->count(),
            'halls_count'=>Accommodations::halls()->count(),
            'reservations'=>Reservation::limit(5)->get(),
        ]);
    }
}
