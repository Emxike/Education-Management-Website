@extends('admin.layouts.app')

@section('content')
<h1>Example Modules</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">DataTables Example</h6>
        <a class="float-right" href="{{ route("example.add") }}">Add</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Content</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->content }}</td>
                        <td>
                            <a href="{{ route("example.edit", ["id" => $item->id]) }}">Edit</a>
                            <a href="{{ route("example.edit", ["id" => $item->id]) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
