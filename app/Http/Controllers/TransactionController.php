<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();


        return view('pages.admin.transaction.index',[
            'transactions' => $transactions,
            'title' =>  'Transaksi'

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('pages.admin.transaction.create',[
            'products' => $products,
            'title' =>  'Tambah Trasaksi Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $product = Product::findOrFail($request->product_id);
        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Quantity melebihi stock, stock sekarang adalah: ' . $product->stock);
        }

        // UNTUK MENGUPDATE STOCK\\
        $update_product['stock'] = $product->stock - $request->quantity;
        $product->update($update_product);

        Transaction::create($data);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();

        return redirect()->back();
    }
}
