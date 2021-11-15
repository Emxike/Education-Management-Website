@extends("layouts.app")

@section("title", "Profile")

@section("content")
    <div style="background: rgb(99, 39, 120); padding: 50px">
        <div class="container rounded bg-white mt-5 mb-5 block-profile">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px"
                             src="{{ !empty($data->avatar) ? asset("/upload/{$data->avatar}") : asset("asset/images/". ($data->sex == 1 ? 'icon_female.png' : 'icon_male.png')) }}">
                        <span class="font-weight-bold">{{ $data->staff_name }}</span>
                        <span class="text-black-50">{{ $data->email }}</span>
                        <span class="text-black-50">{{ $data->phone }}</span>
                        <span> </span></div>
                </div>
                <div class="col-md-5 border-right">
                    <form action="{{ route("profile.post") }}" method="post" class="p-3 py-5">
                        @csrf
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Student Name</label>
                                <input type="text" class="form-control" name="staff_name"
                                       placeholder="Enter Staff Name" value="{{ $data->staff_name }}">
                                @error('staff_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input type="email" class="form-control" name="email"
                                       placeholder="Enter Email" value="{{ $data->email }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Phone</label>
                                <input type="text" class="form-control" name="phone"
                                       placeholder="Enter Phone" value="{{ $data->phone }}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="labels">Sex</label>
                                <select id="sex" class="form-control" name="sex">
                                    @foreach(trans("Home::messages.sex") as $key => $item)
                                        <option value="{{ $key }}"
                                                @if(old("sex", $data->sex) == $key) selected="selected" @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('sex')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="labels">Address</label>
                                <input type="text" class="form-control" name="address"
                                       placeholder="Enter Address" value="{{ $data->address }}">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
