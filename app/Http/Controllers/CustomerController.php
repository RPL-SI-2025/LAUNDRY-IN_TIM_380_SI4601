<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cust' => 'required|string|max:255',
            'alamat_cust' => 'required|string|max:255',
            'nomor_cust' => 'required|string|max:20',
            'tglmasuk_cust' => 'required|date',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
                         ->with('success', 'Data pelanggan berhasil ditambahkan!');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nama_cust' => 'required|string|max:255',
            'alamat_cust' => 'required|string|max:255',
            'nomor_cust' => 'required|string|max:20',
            'tglmasuk_cust' => 'required|date',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
                         ->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    /**
     * Menghapus pelanggan dari database. (Notif delete karyawan.png)
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
                         ->with('success', 'Data pelanggan berhasil dihapus!');
    }
}