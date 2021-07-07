
{{-- \resources\views\permissions\create.blade.php --}}
@extends('layouts.app')

@section('title', '| Create Permission')

@section('content')

<h2 class="main-title"><i class="fa fa-file-text"></i> Add New Permission</h2>
<br><br>
<div class="big-container-main bag-white">
    {!! Form::open(array('url' => 'permissions', 'class' => 'big-form')) !!}
        <div class="field" data-title="Permission">
            {{Form::text('name', '', ['class' => $errors->has('name') ? ' error' : '' , 'placeholder' => '...'])}}
            @if ($errors->has('name'))
                <div class="error-msg"><span>{{ $errors->first('name') }}</span></div>
            @endif
        </div>
        <div class="field checkbox" data-title="Role">
            @if(!$roles->isEmpty()) 
                @foreach ($roles as $role)
                    <em>
                        {{ Form::checkbox('roles[]',  $role->id, '', ['id' => $role->id] ) }}
                        {{ Form::label($role->id, '<span></span> '. ($role->name), [], false)  }}
                    </em>
                @endforeach
                @if ($errors->has('roles'))
                    <div class="error-msg"><span>{{ $errors->first('roles') }}</span></div>
                @endif
            @endif
        </div>
        <div class="field button" data-title="Action">
            {{Form::submit('Save', ['class' => 'btn btn-success', 'id' => 'send'])}}
            <a class="btn btn-primary" href="{{ route('permissions.index') }}">Cancel</a>
        </div>
    {!! Form:: close() !!}
</div>

@endsection
