@extends("admin.layouts.app")

@section('title', 'Add Role')

@section("content")
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Add Role</h3>
                <div class="mT-30">
                    <form action="{{ route("role.create") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="role_name">Role Name</label>
                                <input type="text" class="form-control" value="{{ old("role_name") }}"
                                       name="role_name" id="role_name" placeholder="Role Name">
                                @error('role_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("role.list") }}"><i
                                class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-save"
                                                                                    aria-hidden="true"></i> Add
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
