@extends('layouts.app')

@section('title', '| Edit Archive')

@section('content')

<h2 class="main-title"><i class="fa fa-file-text"></i> Edit Archive</h2>
<br><br>
<div class="big-container-main bag-white">
    {!! Form::model($archive, array('route' => array('archives.update', $archive->id), 'method' => 'PUT', 'class' => 'big-form')) !!}
        <div class="field" data-title="Archive Number">
            {{Form::text('number', null, ['readonly' => true, 'class' => '', 'placeholder' => '...'])}}
        </div>
        <div class="field" data-title="Title">
            {{Form::text('title', null, ['class' => $errors->has('title') ? ' error' : '' , 'placeholder' => '...'])}}
            @if ($errors->has('title'))
                <div class="error-msg"><span>{{ $errors->first('title') }}</span></div>
            @endif
        </div>
        <div class="field" data-title="Body">
            {{Form::textarea('body', null, ['class' => '', 'placeholder' => '...'])}}
            @if ($errors->has('body'))
                <div class="error-msg"><span>{{ $errors->first('body') }}</span></div>
            @endif
        </div>
        <div class="field" data-title="Description">
            {{Form::textarea('description', null, ['class' => '', 'placeholder' => '...'])}}
            @if ($errors->has('description'))
                <div class="error-msg"><span>{{ $errors->first('description') }}</span></div>
            @endif
        </div>
        <div class="field button" data-title="Action">
            {{Form::submit('Save', ['class' => 'btn btn-success', 'id' => 'send'])}}
            <a class="btn btn-primary" href="{{ route('archives.index') }}">Cancel</a>
        </div>
    {!! Form:: close() !!}
</div>

<script>
    CKEDITOR.replace( 'body' );
    CKEDITOR.replace( 'description' );
</script>

@endsection
