@extends('admin.layouts.app')
@section('title', 'Permission')
@section('content')
    <h1>Permission</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <form action="{{ route("permission") }}" method="GET">
                        <label class="common-label" for="catalog">Role</label>
                        <select id="role_id" class="form-control" name="role_id">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if($role_id == $role->id) selected="selected" @endif>{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="row col-12">
                            <button type="submit" class="btn btn-primary btn-common text-center mt-2">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <form method="POST" action="{{ route("permission.add") }}" enctype="multipart/form-data">
                        @csrf
                        <input name="role_id" type="hidden" value="{{ $role_id }}">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr class="text-center">
                                <th>Screen</th>
                                <th>View <input type="checkbox" id="view_all"></th>
                                <th>Add <input type="checkbox" id="add_all"></th>
                                <th>Edit <input type="checkbox" id="edit_all"></th>
                                <th>Delete <input type="checkbox" id="del_all"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($screen as $key => $item)
                                <tr class="text-center">
                                    <td class="text-left">
                                        {{ $item->menu_title }}
                                        <input type="hidden" name="screen[{{ $item->menu_href }}][id]" value="{{ $item->id }}">
                                    </td>
                                    <td><input class="ckb_view" name="screen[{{ $item->menu_href }}][view]" type="checkbox" @if($item->view_flg) checked @endif></td>
                                    <td><input class="ckb_add" @if(!$item->menu_add) disabled @endif name="screen[{{ $item->menu_href }}][add]" type="checkbox" @if($item->add_flg && $item->menu_add) checked @endif></td>
                                    <td><input class="ckb_edit" @if(!$item->menu_edit) disabled @endif name="screen[{{ $item->menu_href }}][edit]" type="checkbox" @if($item->edit_flg && $item->menu_edit) checked @endif></td>
                                    <td><input class="ckb_del" @if(!$item->menu_edit) disabled @endif name="screen[{{ $item->menu_href }}][delete]" type="checkbox" @if($item->del_flg && $item->menu_edit) checked @endif></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button @if(empty($role_id)) disabled @endif class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section('script')
    <script>
        $("#view_all").change(function(){
            $(".ckb_view:enabled").prop('checked', $(this).prop('checked'));
        });
        $("#add_all").change(function(){
            $(".ckb_add:enabled").prop('checked', $(this).prop('checked'));
        });
        $("#edit_all").change(function(){
            $(".ckb_edit:enabled").prop('checked', $(this).prop('checked'));
        });
        $("#del_all").change(function(){
            $(".ckb_del:enabled").prop('checked', $(this).prop('checked'));
        });
    </script>
@endsection
