@extends("admin.layouts.app")

@section('title', 'Add Faculty')

@section("content")
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Add Faculty</h3>
                <div class="mT-30">
                    <form action="{{ route("department.create") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="department_name">Faculty Name</label>
                                <input type="text" class="form-control" value="{{ old("department_name") }}"
                                       name="department_name" id="department_name" placeholder="Faculty Name">
                                @error('department_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row {{ \Illuminate\Support\Facades\Auth::guard("admin")->user()->role_id == 3 ? 'd-none' : '' }}">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="manager">Manager</label>
                                <select id="manager" class="form-control" name="manager">
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if(old("manager") == $user->id) selected="selected" @endif>{{ $user->user_name . '-' . $user->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('manager')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("department.list") }}"><i
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
