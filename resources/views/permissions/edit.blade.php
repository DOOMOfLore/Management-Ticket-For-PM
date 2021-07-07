@extends('layouts.app')

@section('title', '| Edit Permission')

@section('content')

<h2 class="main-title"><i class="fa fa-file-text"></i> Edit Permission</h2>
<br><br>
<div class="big-container-main bag-white">
    {!! Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT', 'class' => 'big-form')) !!}
        <div class="field" data-title="Permission">
            {{Form::text('name', null, ['class' => $errors->has('name') ? ' error' : '' , 'placeholder' => '...'])}}
            @if ($errors->has('name'))
                <div class="error-msg"><span>{{ $errors->first('name') }}</span></div>
            @endif
        </div>
        <div class="field button" data-title="Action">
            {{Form::submit('Save', ['class' => 'btn btn-success', 'id' => 'send'])}}
            <a class="btn btn-primary" href="{{ route('permissions.index') }}">Cancel</a>
        </div>
    {!! Form:: close() !!}
</div>

@endsection
