@extends("layouts.app")

@section("title", "Profile")

@section("content")
    <div style="background: rgb(99, 39, 120); padding: 50px">
        <div class="container rounded bg-white mt-5 mb-5 block-profile">
            <div class="row">
                <div class="col-md-12 border-right">
                    <form action="{{ route("change-password.post") }}" method="post" class="p-3 py-5">
                        @csrf
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Change Password</h4>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Password</label>
                                <input type="password" class="form-control" value="{{ old("password_new") }}"
                                       name="password_new" id="password_new" placeholder="Password New">
                                @error('password_new')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-md-12">
                                <label class="labels">Password Confirm</label>
                                <input type="password" class="form-control" value="{{ old("password_confirm") }}"
                                       name="password_confirm" id="password_confirm" placeholder="Password Confirm">
                                @error('password_confirm')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
