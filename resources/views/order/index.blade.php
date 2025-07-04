@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <div class="table-responsive">
                        <div class="mb-3" align="right">
                            <a href="{{ route('order.create') }}" class="btn btn-primary">+</a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Code</th>
                                    <th>Customer</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ route('order.show', $data->id) }}">{{ $data->order_code }}</a></td>
                                    <td>{{ $data->customer->customer_name }}</td>
                                    <td>{{ $data->order_end_date }}</td>
                                    <td>{{ $data->status_text }}</td>
                                    <td>
                                        <a href="{{ route('print_struk', $data->id) }}" class="btn btn-warning btn-sm">Print</a>
                                        <a href="{{ route('order.show', $data->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <form action="{{ route('order.destroy', $data->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection