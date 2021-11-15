@extends('admin.layouts.app')
@section('title', 'List Member')
@section('content')
    <h1>Member</h1>
    <div class="card shadow mb-4">
        @include("admin.components.box_head", ["title" => "List Member", "url" => "member.add"])
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Role Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user_name }}</td>
                            <td>{{ $item->full_name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->role_name }}</td>
                            <td>{{ trans("Users::messages.status.{$item->status}") }}</td>
                            <td>
                                @include("admin.components.button_table", ["url" => "member", "id" => $item->id])
                                @if($item->role_id != \Illuminate\Support\Facades\Auth::guard("admin")->user()->role_id)
                                    <button class="btn btn-sm btn-box btn-outline btn-info" data-toggle="modal"
                                            data-target="#modalLock" onclick="lockCommon('{{$item->id}}', '{{ route("member.lock") }}' , '{{$item->status == 0 ? "Lock" : "UnLock"}}')">
                                        <i class="fas {{ $item->status == 0 ? 'fa-lock' : 'fa-unlock' }} text_white"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include("admin.components.popup_delete", ["url" => "member.destroy", "type" => "Member"])
@stop

@section("script")
    <script>
        function lockCommon(id, url, text) {
            $("#formLock").attr('action', url);
            $("#lbText").html('Are you sure to '+ text +  ' this Member');
            $("#lock_id").val(id)
            $("#btnLock").html(text)
            $("#titleConfirm").html(text + " Member")
        }
    </script>
@stop
