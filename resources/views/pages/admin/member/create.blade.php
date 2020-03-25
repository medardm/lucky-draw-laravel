@extends('layouts.app', ['pageTitle' => 'Members'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-2">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Generate Dummy Member
                </div>

                <div class="card-body">
                    <?php // TODO: Create draw route ?>
                    <form method="POST" action="{{ route('members.generate') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="number_of_users" class="col-md-4 col-form-label text-md-right">{{ __('Number of Users') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="number_of_users" type="number" class="form-control @error('number_of_users') is-invalid @enderror" name="number_of_users" value="{{ old('number_of_users') }}" required autocomplete="number_of_users" placeholder="max: 10">

                                @error('number_of_users')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="generate_ticket" class="col-md-4 col-form-label text-md-right">{{ __('Generate Tickets') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="form-control" name="generate_ticket" required>
                                    <option {{ old('generate_ticket') == 'true'? 'selected':'' }} value="true">Yes</option>
                                    <option {{ old('generate_ticket') == 'false'? 'selected':'' }} value="false">No</option>
                                </select>
                                @error('generate_ticket')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number_of_tickets" class="col-md-4 col-form-label text-md-right">{{ __('Number of tickets each') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="number_of_tickets" type="number" class="form-control @error('number_of_tickets') is-invalid @enderror" name="number_of_tickets" value="{{ old('number_of_tickets') }}" autocomplete="number_of_tickets" placeholder="max: 10">

                                @error('number_of_tickets')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Generate') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Create Member
                </div>

                <div class="card-body">
                    <?php // TODO: Create draw route ?>
                    <form method="POST" action="{{ route('members.store')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ticket_number" class="col-md-4 col-form-label text-md-right">{{ __('Winning ticket') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="number" class="form-control ticket_number @error('ticket_number') is-invalid @enderror" name="ticket_number" value="{{ old('ticket_number') }}" required autocomplete="ticket_number" autofocus>
                                <small>Must be between {{ config('luckydraw.start') }} &amp; {{ config('luckydraw.end') }}</small>

                                @error('ticket_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
