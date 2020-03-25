@extends('layouts.app', ['pageTitle' => 'Home'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @can ('view-admin-pages')
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 px-0">
                                    <div class="card">
                                      <div class="card-body text-center">
                                        <h1 class="card-title">{{ $members->count() }}</h1>
                                        <h6 class="card-subtitle mb-2 text-muted"><span class="fa fa-users"></span> Members</h6>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-4 px-0">
                                    <div class="card">
                                      <div class="card-body text-center">
                                        <h1 class="card-title">{{ $tickets->count() }}</h1>
                                        <h6 class="card-subtitle mb-2 text-muted"><span class="fa fa-ticket-alt"></span> Tickets</h6>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-4 px-0">
                                    <div class="card">
                                      <div class="card-body text-center">
                                        <h1 class="card-title">{{ $winners->count() }}</h1>
                                        <h6 class="card-subtitle mb-2 text-muted"> <span class="fa fa-trophy"></span> Winners</h6>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
