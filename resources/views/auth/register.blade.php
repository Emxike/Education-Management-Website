@extends('auth.app')

@section('content')
    <section class="login-block">
        <div class="col-12">
            <div class="row">
                <div class="col-md-4 login-sec">
                    <h2 class="text-center">REGISTER</h2>
                    <form method="POST" action="{{ route('register') }}" class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-uppercase">Student Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-uppercase">Phone</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-uppercase">Sex</label>
                            <select id="sex" class="form-control" name="sex">
                                @foreach(trans("messages.sex") as $key => $item)
                                    <option value="{{ $key }}" @if(old("sex") == $key) selected="selected" @endif>{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('sex')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="text-uppercase">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>


                        <div class="form-check">
                            <button type="submit" class="btn btn-login float-right">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 banner-sec" style="background: url({{ asset("asset/images/images.jpg") }}) no-repeat left bottom">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <div class="carousel-caption d-none d-md-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

