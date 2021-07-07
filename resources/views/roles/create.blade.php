@extends('layouts.app')

@section('title', '| Add Role')

@section('content')

<h2 class="main-title"><i class="fa fa-file-text"></i> Add New Role</h2>
<br><br>
<div class="big-container-main bag-white">
    {!! Form::open(array('url' => 'roles', 'class' => 'big-form')) !!}
        <div class="field" data-title="Role">
            {{Form::text('name', '', ['class' => $errors->has('name') ? ' error' : '' , 'placeholder' => '...'])}}
            @if ($errors->has('name'))
                <div class="error-msg"><span>{{ $errors->first('name') }}</span></div>
            @endif
        </div>
        <div class="field checkbox" data-title="Assign Permissions">
            @foreach ($permissions as $permission)
                <em>
                    {{ Form::checkbox('permissions[]',  $permission->id, '', ['id' => $permission->id] ) }}
                    {{ Form::label($permission->id, '<span></span> '. ($permission->name), [], false)  }}
                </em>
            @endforeach
            @if ($errors->has('permissions'))
                <div class="error-msg"><span>{{ $errors->first('permissions') }}</span></div>
            @endif
        </div>
        <div class="field button" data-title="Action">
            {{Form::submit('Save', ['class' => 'btn btn-success', 'id' => 'send'])}}
            <a class="btn btn-primary" href="{{ route('roles.index') }}">Cancel</a>
        </div>
    {!! Form:: close() !!}
</div>

@endsection
