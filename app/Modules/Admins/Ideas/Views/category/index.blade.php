@extends('admin.layouts.app')
@section('title', 'List Category')
@section('content')
    <h1>Category</h1>
    <div class="card shadow mb-4">
        @include("admin.components.box_head", ["title" => "List Category", "url" => "category.add"])
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Create Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->created }}</td>
                            <td>
                                @include("admin.components.button_table", ["url" => "category", "id" => $item->id, "idea" => $item->is_idea])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include("admin.components.popup_delete", ["url" => "category.destroy", "type" => "Role"])
@stop
