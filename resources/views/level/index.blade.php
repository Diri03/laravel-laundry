@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                <div class="mb-3" align="right">
                    <a href="{{ route('level.create') }}" class="btn btn-primary">+</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Level Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key => $data )                            
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->level_name }}</td>
                                <td>
                                    <a href="{{ route('level.edit', $data->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('level.destroy', $data->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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