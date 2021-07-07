@extends('layouts.login')

@section('content')

<div class="container">
    <img src="{{ asset('backend/image/i-mardoc.svg') }}" />
    <h3>Login Page<br> </h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input id="username" type="text" placeholder="Username" class="form-control{{ $errors->has('username') ? ' error' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
        <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' error' : '' }}" name="password" required>
        <input type="submit" value="{{ __('Login') }}"/>

        @if ($errors->has('username'))
            <div class="big-warning error" id="msg_error">
                <div class="warning-container">
                    <i class="fa fa-check"></i>
                    <span>
                            {{ $errors->first('username') }}
                    </span>
                    <div class="closed"></div>
                </div>
            </div>
        @endif
    </form>
</div>
<script>
    $('.big-warning .warning-container .closed').click(function(e) {    
        $(this).closest('.big-warning').removeClass('error');
    });
    $('a[href^="#msg_error"]').click(function(e) {    
        $('#msg_error').addClass('error');        
    });
</script>
@endsection
