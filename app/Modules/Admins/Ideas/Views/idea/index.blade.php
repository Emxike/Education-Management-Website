@extends('admin.layouts.app')
@section('title', 'List Idea')
@section('content')
    <h1>Role</h1>
    <div class="card shadow mb-4">
        @include("admin.components.box_head", ["title" => "List Idea"])
        <div class="card-body">
            <div class="table-responsive">
                <table class="mb-4" border="0" cellspacing="5" cellpadding="5">
                    <tbody>
                    <tr>
                        <td style="width: 200px">
                            <label class="common-label" for="category_id">Category</label>
                            <select id="category_id" class="form-control" name="category_id">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(old("category_id") == $category->id) selected="selected" @endif>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Student Name</th>
                        <th>Content</th>
                        <th>Create Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->staff_name }}</td>
                            <td>{{ $item->content }}</td>
                            <td>{{ $item->created }}</td>
                            <td>
                                @include("admin.components.button_table", ["url" => "idea", "id" => $item->id])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include("admin.components.popup_delete", ["url" => "idea.destroy", "type" => "Role"])
@stop
@section("script")
<script>
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            let cate = $("#category_id :selected").text()
            var tableData = data[1] || ""; // use data for the age column
            if(cate === tableData || cate === "" ) {
                return true;
            }
            return false;
        }
    );
    $(document).ready(function() {
        var table = $('#dataTable').DataTable();
        $("#category_id").on("change", function () {
            table.draw();
        })
    } );

</script>
@stop

