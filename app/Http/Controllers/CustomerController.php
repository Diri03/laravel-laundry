<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\RequiredCustomer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $datas = Customers::all();
        $datas = Customers::orderBy('id', 'desc')->get();
        $title = "Data Customer";
        return view('customer.index', compact('datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add Customer";
        return view('customer.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // try {
        //     $validator =Validator::make($request->all(), [
        //         'customer_name' => 'required',
        //     ]);
    
        //     if($validator->fails()){
        //         return response()->json(['status' => 'error', 'errors'=> $validator->errors()], 422);
        //     }
        //     $customers = Customers::create($request->all());
        //     return response()->json(['data' => $customers, 'message' => 'Request success'], 201);
        // } catch (\Throwable $th) {
        //     return response()->json(['status' => 'error', 'message' => 'Request failed', 'errors' => $th->getMessage()], 500);
        // }

        // $request->validate([
        //     'customer_name' =>['required']
        // ]);

        Customers::create($request->all());
        return redirect()->to('customer')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        // $Customers = Customers::find($id);
        $customer = Customers::findOrFail($id);
        $title = "Edit Customer";
        // $Customers = Customers::where('id', $id)->first();
        return view('customer.edit', compact('customer', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customers::findOrFail($id);
        $customer->customer_name = $request->customer_name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        return redirect()->to('customer')->with('success','Data berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();
        return redirect()->to('customer')->with('success','Data berhasil di hapus');
    }
}
