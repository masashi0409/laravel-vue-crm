<?php

namespace App\Http\Controllers;

use Illuminate\http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;

use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * 顧客一覧
     * ページネーションがある
     */
    public function index()
    {
        $customers = Customer::
            select('id', 'name', 'kana', 'tel')
            ->paginate(10); // pagination
        
        return Inertia::render('Customers/Index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
