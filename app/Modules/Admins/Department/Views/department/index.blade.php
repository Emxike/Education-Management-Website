@extends('admin.layouts.app')
@section('title', 'List Faculty')
@section('content')
    <h1>Faculty</h1>
    <div class="card shadow mb-4">
        @include("admin.components.box_head", ["title" => "List Faculty", "url" => "department.add"])
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Faculty Name</th>
                        <th>Manager</th>
                        <th>Create Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->department_name }}</td>
                            <td>{{ $item->manager }}</td>
                            <td>{{ $item->created }}</td>
                            <td>
                                @include("admin.components.button_table", ["url" => "department", "id" => $item->id])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include("admin.components.popup_delete", ["url" => "department.destroy", "type" => "Faculty"])
@stop
