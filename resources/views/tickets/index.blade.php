{{-- \resources\views\tickets\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Tickets')

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

<h2 class="main-title"><i class="fa fa-file-text"></i> Tickets</h2>
<br><br>
<div class="big-container-main bag-white">
    <form class="big-form">
        <div class="field" data-title="Search">
            <input type="text" name="searchTerm" placeholder="..." style="width:500px;" value="{{ isset($searchTerm) ? $searchTerm : '' }}">
        </div>
        <div class="field checkbox" data-title="Members">
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
            <a href="{{ route('tickets.create') }}">Add New</a>
        </div>
    </form>
</div>

<div class="big-container-main bag-white">
    <div class="big-table">
        <table cellpadding="0" cellspacing="0" style="width:100%;">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Title</td>
                    <td>Member</td>
                    <td>Description</td>
                    <td>Last Modified</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @php ($i = 0)
                @foreach ($tickets as $ticket)
                    @php ($i++)
                    <tr>
                        <td>{{ $i + (($tickets->currentPage() - 1) * $tickets->perPage()) }}</td>
                        <td>{{ '['. $ticket->number .'] '. $ticket->title }}</td>
                        <td>
                            @php ( $t = $ticket->users )
                            @foreach ($ticket->users as $user)
                                @if ($loop->last) 
                                    {{$user->name }} 
                                @else 
                                    {{$user->name .', '}}
                                @endif
                            @endforeach
                        </td>
                        <td>{!! $ticket->description !!}</td>
                        <td>{{ date('d m Y', strtotime($ticket->created_at)) }}</td>
                        <td class="action">
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="fa fa-pencil" data-title="Edit"></a>
                            <a href="{{ route('tickets.destroy', $ticket->id) }}" data-token="{{ csrf_token() }}" data-method="delete" data-confirm="Are you surer?" class="fa fa-times" data-title="del"></a>
                            @csrf
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tickets->links('vendor.pagination.custom') }}
    </div>
</div>

<script>

</script>

<pre>
{{-- var_dump($tickets->toArray()) --}}
</pre>

@endsection
