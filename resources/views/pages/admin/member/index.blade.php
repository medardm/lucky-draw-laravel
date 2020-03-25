@extends('layouts.app', ['pageTitle' => 'Members'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Members <a class="float-right" href="{{ route('members.create') }}"><i class="fa fa-plus"></i> Add</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Tickets</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($members->count() > 0)
                                    @foreach ($members as $member)
                                        <tr>
                                            <td>{{ $member->name}}</td>
                                            <td>{{ $member->email}}</td>
                                            <td>[{{ $member->tickets->count() }}] = {{ $member->tickets->implode('ticket_number', ', ')}}</td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan=3>
                                            <p class="alert alert-info">No members yet</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $members->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
