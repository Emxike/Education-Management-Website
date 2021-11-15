@extends("admin.layouts.app")

@section('title', 'Add Member')

@section("content")
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Add Member</h3>
                <div class="mT-30">
                    <form action="{{ route("member.create") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="user_name">User Name</label>
                                <input type="text" class="form-control" value="{{ old("user_name") }}"
                                       name="user_name" id="user_name" placeholder="User Name">
                                @error('user_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="full_name">Full Name</label>
                                <input type="text" class="form-control" value="{{ old("full_name") }}"
                                       name="full_name" id="full_name" placeholder="Full Name">
                                @error('role_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="phone">Phone</label>
                                <input type="text" class="form-control" value="{{ old("phone") }}"
                                       name="phone" id="phone" placeholder="Phone">
                                @error('role_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="address">Address</label>
                                <input type="text" class="form-control" value="{{ old("address") }}"
                                       name="address" id="address" placeholder="Address">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="role">Role</label>
                                <select id="role" class="form-control" name="role">
                                    <option></option>
                                    @foreach($roles as $item)
                                        <option value="{{ $item->id }}" @if(old("role") == $item->id) selected="selected" @endif>{{ $item->role_name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("member.list") }}"><i
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
