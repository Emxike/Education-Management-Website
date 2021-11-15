@extends('admin.layouts.app')
@section('title', 'List Student')
@section('content')
    <h1>Student</h1>
    <div class="card shadow mb-4">
        @include("admin.components.box_head", ["title" => "List Student", "url" => "staff.add"])
        <div class="card-body">
            <div class="table-responsive">
                <table class="mb-4" border="0" cellspacing="5" cellpadding="5">
                    <tbody>
                    <tr>
                        <td style="width: 200px">
                            <label class="common-label" for="department_id">Faculty</label>
                            <select id="department_id" class="form-control" name="department_id">
                                <option value=""></option>
                                @foreach($departments as $item)
                                    <option value="{{ $item->id }}" @if(old("department_id") == $item->id) selected="selected" @endif>{{ $item->department_name }}</option>
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
                        <th>Avatar</th>
                        <th>Student Name</th>
                        <th>Faculty Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Sex</th>
                        <th>Birthday</th>
                        <th>Create Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><img src="{{ !empty($item->avatar) ? asset("/upload/{$item->avatar}") : asset("asset/images/". ($item->sex == 1 ? 'icon_female.png' : 'icon_male.png')) }}" style="width: 50px"></td>
                            <td>{{ $item->staff_name }}</td>
                            <td>{{ $item->department_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ trans("Department::messages.sex.$item->sex") }}</td>
                            <td>{{ $item->birthday }}</td>
                            <td>{{ $item->created }}</td>
                            <td>
                                @include("admin.components.button_table", ["url" => "staff", "id" => $item->id])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include("admin.components.popup_delete", ["url" => "staff.destroy", "type" => "Staff"])
@stop

@section("script")
    <script>
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                let cate = $("#department_id :selected").text()
                var tableData = data[3] || ""; // use data for the age column
                if(cate === tableData || cate === "" ) {
                    return true;
                }
                return false;
            }
        );
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();
            $("#department_id").on("change", function () {
                table.draw();
            })
        } );

    </script>
@stop
