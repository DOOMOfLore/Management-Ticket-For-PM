@extends('layouts.app')

@section('title', '| Wikipedias')

@section('content')

<div class="big-container-main bag-white">
    <div class="big-table">
        <table cellpadding="0" cellspacing="0" style="width:100%;">
            <tbody>
                <tr>
                    <td>Number</td><td>{{ $wikipedia->number }}</td>
                </tr>
                <tr>
                    <td>Title</td><td>{{ $wikipedia->title }}</td>
                </tr>
                <tr>
                    <td>Body</td><td>{!! $wikipedia->body !!}</td>
                </tr>
                <tr>
                    <td>Description</td><td>{!! $wikipedia->description !!}</td>
                </tr>
                <tr>
                    <td>User</td><td>{{ $wikipedia->user->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection