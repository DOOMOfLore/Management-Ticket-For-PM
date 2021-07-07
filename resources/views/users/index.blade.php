{{-- \resources\views\branchs\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Users')

@section('content')

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
        <div class="big-warning {{ $msg }}" id="msg_{{ $msg }}">
            <div class="warning-container">
                <i class="fa fa-check"></i>
                <span>
                    {{ Session::get('alert-' . $msg) }}
                </span>
                <div class="closed"></div>
            </div>
        </div>
    @endif
@endforeach

<h2 class="main-title"><i class="fa fa-file-text"></i> Users</h2>
<br><br>
<div class="big-container-main bag-white">
    <form class="big-form">
        <div class="field" data-title="Search">
            <input type="text" name="searchTerm" placeholder="..." style="width:500px;" value="{{ isset($searchTerm) ? $searchTerm : '' }}">
        </div>
        <div class="field button" data-title="Action">
            <input type="submit" value="Search">
            <a href="{{ route('users.create') }}">Add New</a>
        </div>
    </form>
</div>

<div class="big-container-main bag-white">
    <div class="big-table">
        <table cellpadding="0" cellspacing="0" style="width:100%;">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Name</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>User Roles</td>
                    <td>Last Modified</td>
                    <td>Operations</td></td>
                </tr>
            </thead>
            <tbody>
                @php ($i = 0)
                @foreach ($users as $user)
                    @php ($i++)
                    <tr>
                        <td>{{ $i + (($users->currentPage() - 1) * $users->perPage()) }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>
                        <td>{{ date('d m Y', strtotime($user->created_at))}}</td>
                        <td class="action">
                            <a href="{{ route('users.edit', $user->id) }}" class="fa fa-pencil" data-title="Edit"></a>
                            <a href="{{ route('users.destroy', $user->id) }}" data-token="{{ csrf_token() }}" data-method="delete" data-confirm="Are you surer?" class="fa fa-times" data-title="del"></a>
                            @csrf
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links('vendor.pagination.custom') }}
    </div>
</div>

<script>

</script>

<pre>
{{-- var_dump($users->toArray()) --}}
</pre>

@endsection
