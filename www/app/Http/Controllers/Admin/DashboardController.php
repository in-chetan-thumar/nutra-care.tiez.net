<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Session;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
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
        $locale = 'en';
        $user = \Auth::user();
		$total_category = Category::all()->count();
		$total_product = Product::all()->count();
        
        return view('home', compact('total_category', 'total_product'));
    }
}
