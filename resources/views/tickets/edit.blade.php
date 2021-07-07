@extends('layouts.app')

@section('title', '| Edit Ticket')

@section('content')

<h2 class="main-title"><i class="fa fa-file-text"></i> Edit Ticket</h2>
<br><br>
<div class="big-container-main bag-white">
    {!! Form::model($ticket, array('route' => array('tickets.update', $ticket->id), 'method' => 'PUT', 'class' => 'big-form')) !!}
        <div class="field" data-title="Ticket Number">
            {{Form::text('number', null, ['readonly' => true, 'class' => '', 'placeholder' => '...'])}}
        </div>
        <div class="field" data-title="Title">
            {{Form::text('title', null, ['class' => $errors->has('title') ? ' error' : '' , 'placeholder' => '...'])}}
            @if ($errors->has('title'))
                <div class="error-msg"><span>{{ $errors->first('title') }}</span></div>
            @endif
        </div>
        <div class="field" data-title="Description">
            {{Form::textarea('description', null, ['class' => '', 'placeholder' => '...'])}}
            @if ($errors->has('description'))
                <div class="error-msg"><span>{{ $errors->first('description') }}</span></div>
            @endif
        </div>
        <div class="field checkbox" data-title="Member">
            @foreach ($users as $user)
                <em>
                    {{ Form::checkbox('users[]',  $user->id, null, ['id' => $user->id]) }}
                    {{ Form::label($user->id, '<span></span> '. ($user->name), [], false)  }}
                </em>
            @endforeach
            @if ($errors->has('users'))
                <div class="error-msg"><span>{{ $errors->first('users') }}</span></div>
            @endif
        </div>
        <div class="field button" data-title="Action">
            {{Form::submit('Save', ['class' => 'btn btn-success', 'id' => 'send'])}}
            <a class="btn btn-primary" href="{{ route('tickets.index') }}">Cancel</a>
        </div>
    {!! Form:: close() !!}
</div>

<script>
    CKEDITOR.replace( 'description' );
</script>

@endsection
