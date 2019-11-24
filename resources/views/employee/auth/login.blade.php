@extends('layouts.app')

@section('content')
<div class="container">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <p>Login to Nail Salon System</p>
            </div>
            @include('common.alert')
            <form class="form-horizontal" role="form" method="POST" action="{{ route('employee.login') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-12 fadeIn second">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-md-12 fadeIn third">
                        <input type="password" class="form-control" name="password"  placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox fadeIn fourth">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary fadeIn fourth">
                            <i class="fa fa-btn"></i>Login
                        </button>
                    </div>
                </div>
                <div id="formFooter">
                    <a class="underlineHover" href="{{ route('employee.reset') }}">Forgot Your Password?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
