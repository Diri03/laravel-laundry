@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                <form action="{{ route('service.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Service Name</label>
                        <input type="text" name="service_name" class="form-control" placeholder="Enter your service" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter your price" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea type="text" cols="30" rows="10" name="description" class="form-control"></textarea>
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