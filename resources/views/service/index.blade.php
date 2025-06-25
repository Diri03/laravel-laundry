@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Service</h5>
                    <div class="table-responsive">
                        <div class="mb-3" align="right">
                            <a href="{{ url('insert/service') }}" class="btn btn-primary">+</a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Service Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="" class="btn btn-success">Edit</a>
                                        <form action="" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection