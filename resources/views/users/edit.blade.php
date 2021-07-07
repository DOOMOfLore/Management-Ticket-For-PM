@extends('layouts.app')

@section('title', '| Update New User')

@section('content')

<h2 class="main-title"><i class="fa fa-file-text"></i>Edit User</h2>
<br><br>
<div class="big-container-main bag-white">
    {!! Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'class' => 'big-form')) !!}
        <div class="field" data-title="Username">
            {{Form::text('username', null, ['class' => $errors->has('username') ? ' error' : '', 'placeholder' => '...'])}}
            @if ($errors->has('username'))
                <div class="error-msg"><span>Please fill in the required fields</span></div>
            @endif
        </div>
        <div class="field" data-title="Name">
            {{Form::text('name', null, ['class' => $errors->has('name') ? ' error' : '', 'placeholder' => '...'])}}
            @if ($errors->has('name'))
                <div class="error-msg"><span>Please fill in the required fields</span></div>
            @endif
        </div>
        <div class="field" data-title="Email">
            {{Form::text('email', null, ['class' => $errors->has('email') ? ' error' : '', 'placeholder' => '...'])}}
            @if ($errors->has('email'))
                <div class="error-msg"><span>Please fill in the required fields</span></div>
            @endif
        </div>
        <div class="field checkbox" data-title="Chceckbox">
            @foreach ($roles as $role)
                <em>
                    {{ Form::checkbox('roles[]',  $role->id, null, ['id' => $role->id] ) }}
                    {{ Form::label($role->id, '<span></span> '. ($role->name), [], false)  }}
                </em>
            @endforeach
        </div>
        <div class="field" data-title="Password">
            {{Form::password('password', ['class' => $errors->has('password') ? ' error' : '', 'placeholder' => '...'])}}
            @if ($errors->has('password'))
                <div class="error-msg"><span>Please fill in the required fields</span></div>
            @endif
        </div>
        <div class="field" data-title="Confirm Password">
            {{Form::password('password_confirmation', ['class' => $errors->has('password_confirmation') ? ' error' : '', 'placeholder' => '...'])}}
            @if ($errors->has('password_confirmation'))
                <div class="error-msg"><span>Please fill in the required fields</span></div>
            @endif
        </div>
        <div class="field button" data-title="Action">
            {{Form::submit('Save', ['class' => 'btn btn-success', 'id' => 'send'])}}
            <a class="btn btn-primary" href="{{ route('users.index') }}">Cancel</a>
        </div>
    {!! Form:: close() !!}
</div>

@endsection
