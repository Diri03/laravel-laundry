@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Service</h5>
                <form action="" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Service Name</label>
                        <input type="text" name="service_name" class="form-control" placeholder="Enter your service">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter your price">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea type="text" cols="30" rows="10" name="service_name" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection