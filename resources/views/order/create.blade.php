@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                <form action="{{ route('order.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Order Code</label>
                                <input type="text" name="order_code" class="form-control" value="{{ $code }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Customer</label>
                                <select name="id_customer" id="" class="form-control">
                                    <option value="">Choose Customer</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Packet Service</label>
                                <select name="id_service" id="id_service" class="form-control">
                                    <option value="">Choose Service</option>
                                    @foreach ($services as $service)
                                    <option data-price="{{ $service->price }}" value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">End Order</label>
                                <input type="date" name="order_end_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Note</label>
                                <textarea cols="30" rows="10" name="note" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>

                    <div class="mb-3">
                        <div class="mb-3" align="right">
                            <button type="button" class="btn btn-primary addRow">Add Row</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Packet</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <p><strong>Grand Total: Rp. <span id="grandTotalText"></span></strong></p>
                    <input type="hidden" name="grand_total" id="grandTotalInput" value="0">

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection