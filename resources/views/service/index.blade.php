@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <div class="table-responsive">
                        <div class="mb-3" align="right">
                            <a href="{{ route('service.create') }}" class="btn btn-primary">+</a>
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
                                @foreach ($datas as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->service_name }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>
                                        <a href="{{ route('service.edit', $data->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <form action="{{ route('service.destroy', $data->id) }}" method="post" class="d-inline">
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