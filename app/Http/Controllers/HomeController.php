<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;

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

        $transactions = Transaction::all();
        $products = Product::all();


        return view('home',[
            'products' => $products,
            'transactions' => $transactions,
            'title' =>  'Transaksi'

        ]);
    }
}
