@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Customer</h5>
                <table class="table table-stripped">
                    <tr>
                        <th>Name</th>
                        <td>:</td>
                        <td>{{ $details->customer->customer_name }}</td>
                    </tr>
                    <tr>
                        <th>Hp</th>
                        <td>:</td>
                        <td>{{ $details->customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>:</td>
                        <td>{{ $details->customer->address }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order Transaction</h5>
                <table class="table table-stripped">
                    <tr>
                        <th>Code</th>
                        <td>:</td>
                        <td>{{ $details->order_code }}</td>
                    </tr>
                    <tr>
                        <th>Estimation date</th>
                        <td>:</td>
                        <td>{{ date('d F Y', strtotime($details->order_end_date)) }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>:</td>
                        <td>{{ $details->status_text }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                <form action="{{ route('order.update', $details->id) }}" method="post" id="paymentForm" data-order-id="{{ $details->id }}">
                    @csrf
                    @method('PUT')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Packet Service</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details->details as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $detail->service->service_name }}</td>
                                <td>Rp. {{ number_format($detail->service->price) }}</td>
                                <td>{{ $detail->qty / 1000 }} kg</td>
                                <td>Rp. {{ number_format($detail->subtotal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" align="right" class="pe-4"><strong>Total</strong></td>
                                <td colspan="1">
                                    Rp. {{ number_format($details->total) }}
                                    <input type="hidden" id="order_total" value="{{ $details->total }}">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right" class="pe-4"><strong>Pay (Rp)</strong></td>
                                <td colspan="1">
                                    <input type="number" class="form-control" id="order_pay" name="order_pay" value="" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right" class="pe-4"><strong>Change</strong></td>
                                <td colspan="1">
                                    <span id="order_change_display"></span>
                                    <!-- <input type="text" class="form-control" id="order_change_display" value="" readonly> -->
                                    <input type="hidden" id="order_change" name="order_change" required>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="mb-3">
                        <button class="btn btn-primary" name="payment_method" type="submit" value="cash">Cash</button>
                        <button class="btn btn-success" name="payment_method" type="submit" value="midtrans">Cashless</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    const selectPay = document.querySelector('#order_pay');
    const selectChange = document.querySelector('#order_change');
    const total = document.querySelector('#order_total').value;
    
    selectPay.addEventListener('input', function(e){
        const pay = parseInt(e.target.value) || 0;
        const change = pay - total;
        if (change < 0) {
            console.log(change);            
            return document.querySelector('#order_change_display').textContent = `Rp. 0`;
        }
        
        return document.querySelector('#order_change_display').textContent = `Rp. ${change.toLocaleString('id-ID')}`;
    });

</script>
@endsection