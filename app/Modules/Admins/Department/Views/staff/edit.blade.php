@extends("admin.layouts.app")

@section('title', 'Update Student')

@section("content")
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Update Student</h3>
                <div class="mT-30">
                    <form action="{{ route("staff.update", ["id" => $data->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="staff_name">Student Name</label>
                                <input type="text" class="form-control" value="{{ old("staff_name", $data->staff_name) }}"
                                       name="staff_name" id="staff_name" placeholder="Student Name">
                                @error('staff_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="email">Email</label>
                                <input type="text" class="form-control" value="{{ old("email", $data->email) }}"
                                       name="email" id="email" placeholder="Email">
                                @error('staff_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="phone">Phone</label>
                                <input type="text" class="form-control" value="{{ old("phone", $data->phone) }}"
                                       name="phone" id="phone" placeholder="Phone">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="sex">Sex</label>
                                <select id="sex" class="form-control" name="sex">
                                    @foreach(trans("Department::messages.sex") as $key => $item)
                                        <option value="{{ $key }}" @if(old("sex", $data->sex) == $key) selected="selected" @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('sex')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="department">Faculty</label>
                                <select id="department" class="form-control" name="department">
                                    <option></option>
                                    @foreach($departments as $item)
                                        <option value="{{ $item->id }}" @if(old("department", $data->department_id) == $item->id) selected="selected" @endif>{{ $item->department_name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="address">Address</label>
                                <input type="text" class="form-control" value="{{ old("address", $data->address) }}"
                                       name="address" id="address" placeholder="Address">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("staff.list") }}"><i
                                class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-save"
                                                                                    aria-hidden="true"></i> Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
