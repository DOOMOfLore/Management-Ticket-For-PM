{{-- \resources\views\permissions\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Permissions')

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

<h2 class="main-title"><i class="fa fa-file-text"></i> Permissions</h2>
<br><br>
<div class="big-container-main bag-white">
    <form class="big-form">
        <div class="field" data-title="Search">
            <input type="text" name="searchTerm" placeholder="..." style="width:500px;" value="{{ isset($searchTerm) ? $searchTerm : '' }}">
        </div>
        <div class="field button" data-title="Action">
            <input type="submit" value="Search">
            <a href="{{ route('permissions.create') }}">Add New</a>
        </div>
    </form>
</div>

<div class="big-container-main bag-white">
    <div class="big-table">
        <table cellpadding="0" cellspacing="0" style="width:100%;">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Permissions</td>
                    <td>Last Modified</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @php ($i = 0)
                @foreach ($permissions as $permission)
                    @php ($i++)
                    <tr>
                        <td>{{ $i + (($permissions->currentPage() - 1) * $permissions->perPage()) }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ date('d m Y', strtotime($permission->created_at))}}</td>
                        <td class="action">
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="fa fa-pencil" data-title="Edit"></a>
                            <a href="{{ route('permissions.destroy', $permission->id) }}" data-token="{{ csrf_token() }}" data-method="delete" data-confirm="Are you surer?" class="fa fa-times" data-title="del"></a>
                            @csrf
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $permissions->links('vendor.pagination.custom') }}
    </div>
</div>

<script>

</script>

<pre>
{{-- var_dump($permissions->toArray()) --}}
</pre>

@endsection
