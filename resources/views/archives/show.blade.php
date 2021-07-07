@extends('layouts.app')

@section('title', '| Archives')

@section('content')

<div class="big-container-main bag-white">
    <div class="big-table">
        <table cellpadding="0" cellspacing="0" style="width:100%;">
            <tbody>
                <tr>
                    <td>Number</td><td>{{ $archive->number }}</td>
                </tr>
                <tr>
                    <td>Title</td><td>{{ $archive->title }}</td>
                </tr>
                <tr>
                    <td>Body</td><td>{!! $archive->body !!}</td>
                </tr>
                <tr>
                    <td>Description</td><td>{!! $archive->description !!}</td>
                </tr>
                <tr>
                    <td>User</td><td>{{ $archive->user->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection