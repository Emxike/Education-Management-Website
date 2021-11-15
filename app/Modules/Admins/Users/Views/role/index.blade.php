@extends('admin.layouts.app')
@section('title', 'List Role')
@section('content')
    <h1>Role</h1>
    <div class="card shadow mb-4">
        @include("admin.components.box_head", ["title" => "List Role", "url" => "role.add"])
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->role_name }}</td>
                            <td>
                                @include("admin.components.button_table", ["url" => "role", "id" => $item->id])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include("admin.components.popup_delete", ["url" => "role.destroy", "type" => "Role"])
@stop
