@extends('layouts.app')

@section('title', '| Daily')

@section('content')

<div class="big-container-main bag-white">
    <div class="big-table">
        <table cellpadding="0" cellspacing="0" style="width:100%;">
            <tbody>
                <tr>
                    <td>Number</td><td>{{ $daily->number }}</td>
                </tr>
                <tr>
                    <td>Title</td><td>{{ $daily->title }}</td>
                </tr>
                <tr>
                    <td>Body</td><td>{!! $daily->body !!}</td>
                </tr>
                <tr>
                    <td>Description</td><td>{!! $daily->description !!}</td>
                </tr>
                <tr>
                    <td>User</td><td>{{ $daily->user->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection