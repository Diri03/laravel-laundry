@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                <form action="{{ route('customer.update', $customer->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Enter your customer" value="{{ $customer->customer_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter your phone" value="{{ $customer->phone }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Address</label>
                        <textarea cols="30" rows="10" name="address" class="form-control">{{ $customer->address }}</textarea>
                    </div>
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