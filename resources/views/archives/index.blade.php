@extends('layouts.app')

@section('title', '| Archives')

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

<h2 class="main-title"><i class="fa fa-file-text"></i> Archives</h2>
<br><br>
<div class="big-container-main bag-white">
    <form class="big-form">
        <div class="field" data-title="Search">
            <input type="text" name="searchTerm" placeholder="..." style="width:500px;" value="{{ isset($searchTerm) ? $searchTerm : '' }}">
        </div>
        <div class="field checkbox" data-title="Users">
            @foreach ($users as $user)
            @php ($t = false)
                <em>
                    @if (isset($searchUsers))
                        @foreach ($searchUsers as $u)
                            @if ($u == $user->id) 
                                @php ($t = true)
                            @endif
                        @endforeach
                    @endif
                    {{ Form::checkbox('searchUsers[]',  $user->id, '', ['id' => $user->id, 'checked' => $t] ) }}
                    {{ Form::label($user->id, '<span></span> '. ($user->name), [], false)  }}
                </em>
            @endforeach
        </div>
        <div class="field button" data-title="Action">
            <input type="submit" value="Search">
            <a href="{{ route('archives.create') }}">Add New</a>
        </div>
    </form>
</div>

<div class="big-container-main bag-white">
    <div class="big-table">
        <table cellpadding="0" cellspacing="0" style="width:100%;">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Number</td>
                    <td>Title</td>
                    <td>User</td>
                    <td>Last Modified</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @php ($i = 0)
                @foreach ($archives as $archive)
                    @php ($i++)
                    <tr>
                        <td>{{ $i + (($archives->currentPage() - 1) * $archives->perPage()) }}</td>
                        <td>{{ $archive->number }}</td>
                        <td>{{ $archive->title }}</td>
                        <td>{{ $archive->user->name }}</td>
                        <td>{{ date('d F Y', strtotime($archive->created_at)) }}</td>
                        <td class="action">
                            <a href="{{ route('archives.edit', $archive->id) }}" class="fa fa-pencil" data-title="Edit"></a>
                            <a href="#" value="{{ route('archives.show', $archive->id) }}" class="fa fa-search popup" data-popup="popup2" data-title="Detail" title="Archive Detail"></a>
                            <a href="{{ route('archives.destroy', $archive->id) }}" data-token="{{ csrf_token() }}" data-method="delete" data-confirm="Are you surer?" class="fa fa-times" data-title="del"></a>
                            @csrf
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $archives->links('vendor.pagination.custom') }}
    </div>
</div>

<pre>
{{-- var_dump($archives->toArray()) --}}
</pre>

@endsection
