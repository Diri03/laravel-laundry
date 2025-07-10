<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\TransDetails;
use App\Models\TransOrders;
use App\Models\TypeOfServices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Vtiful\Kernel\Format;
use Midtrans\Config;
use Midtrans\Snap;

class TransOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
    public function index()
    {
        $title = "Data Order";
        $datas = TransOrders::with('customer')->orderBy('id', 'desc')->get();
        return view('order.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Order';
        $today = Carbon::now()->format('dmY');
        $countDay = TransOrders::whereDate('created_at', now())->count() + 1;
        $runningNumber = str_pad($countDay,3,'0', STR_PAD_LEFT);
        $code = 'TR-' . $today . '-' . $runningNumber;

        $customers = Customers::orderBy('id','desc')->get();
        $services = TypeOfServices::orderBy('id','desc')->get();
        return view('order.create', compact('title', 'code', 'customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transOrder = TransOrders::create([
            'id_customer' => $request->id_customer,
            'order_code' => $request->order_code,
            'order_end_date' => $request->order_end_date,
            'total' => $request->total
        ]);

        foreach ($request->id_service as $key => $idService) {
            $id_order = $transOrder->id;

            TransDetails::create([
                'id_order' => $id_order,
                'id_service' => $idService,
                'qty' => $request->qty[$key] * 1000,
                'subtotal' => $request->subtotal[$key]
            ]);
        }

        return redirect()->to('order')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TransOrders $transOrders, string $id)
    {
        $title = "Detail Order";
        $details = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();
        
        return view('order.show', compact('title', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransOrders $transOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = TransOrders::findOrFail($id);
        $order->order_pay = $request->order_pay;
        $order->order_change = $request->order_change;
        $order->order_status = 1;
        $order->save();
        return redirect()->to('order')->with('success','Data berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransOrders $transOrders)
    {
        //
    }

    public function printStruk(string $id)
    {
        $details = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();
        // debuging
        // return $details;
        // dd($details);
        return view('order.print', compact('details'));
    }

    public function snap(Request $request, $id){
        $order = TransOrders::with(['details', 'customer'])->findOrFail($id);

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->customer->customer_name ?? "Budi",
                'email' => $order->customer->email ?? "Budi@gmail.com",
                // 'phone' => "0812345456",
            ],
            'payment_type' => [
                'qris'
            ],
            'qris' =>[
                'acquirer' => 'gopay',
            ]

        ];
        // $snapToken = Snap::getSnapToken($params);
        $snap = Snap::createTransaction($params);
        return response()->json(['token' => $snap->token]);
    }
}
