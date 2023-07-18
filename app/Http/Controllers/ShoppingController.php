<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use App\Http\Requests\StoreShoppingRequest;
use App\Http\Requests\UpdateShoppingRequest;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home', [
            "title" => "Home",
            "image" => "sepatu1.jpg"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shopping');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'custumer_name' => 'required',
            'total_amount' => 'required|numeric',
        ]);

        $shopping = $shopping::create([
            'custumer_name' => $validatedData['custumer_name'],
            'total_amount' => $validatedData['total_amount'],
            'voucher_code' => $this->generateVoucherCode(),
            'voucher_expiry_date' => $this->calculateVoucherExpiryDate(),
        ]);

        return redirect()->route('shopping.create')->with('success', 'Shopping data created successfully');
    }

    private function generateVoucherCode()
    {
        return strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));
    }

    private function calculateVoucherExpiryDate()
    {
        return Carbon::now()->addMonths(3)->toDateString();
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreShoppingRequest $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Shopping $shopping)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Shopping $shopping)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateShoppingRequest $request, Shopping $shopping)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Shopping $shopping)
    // {
    //     //
    // }
}
