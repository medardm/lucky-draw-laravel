@extends('layouts.app', ['pageTitle' => 'Admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="fa fa-trophy"></span> Lucky Draw
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <?php // TODO: Create draw route ?>
                    @if ($members->count() > 0)
                        <form method="POST" action="{{ route('draw.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="prize_id" class="col-md-4 col-form-label text-md-right">{{ __('Prize Types') }} <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <select class="form-control @error('prize_id') is-invalid @enderror" name="prize_id">
                                        <option value="">Please select</option>
                                        @foreach ($aPrizes as $aPrize)
                                            @if ($aPrize->id == old('prize_id'))
                                                <option selected value="{{ $aPrize->id }}">{{ $aPrize->prize }} | {{ $aPrize->remainingWinners}} place(s) remaining</option>
                                            @else
                                                <option value="{{ $aPrize->id }}">{{ $aPrize->prize }} | {{ $aPrize->remainingWinners}} place(s) remaining</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('prize_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="generate_randomly" class="col-md-4 col-form-label text-md-right">{{ __('Generate Randomly') }} <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <select class="form-control @error('generate_randomly') is-invalid @enderror" name="generate_randomly">
                                        <option selected value="">Please select</option>
                                        <option {{ old('generate_randomly') == 'true'? 'selected':'' }} value="true">Yes</option>
                                        <option {{ old('generate_randomly') == 'false'? 'selected':'' }} value="false">No</option>
                                    </select>
                                    @error('generate_randomly')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ticket_number" class="col-md-4 col-form-label text-md-right">{{ __('Winning number') }}</label>

                                <div class="col-md-6">
                                    <input id="ticket_number" type="number" class="form-control @error('ticket_number') is-invalid @enderror" name="ticket_number" value="{{ old('ticket_number') }}" autocomplete="ticket_number" placeholder="">

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
                                        {{ __('Draw') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <p class="alert alert-danger">Please add members first</p>
                    @endif


                    <section>
                        <header>Rules</header>
                        <ul>
                            <li>Each user can only win one prize</li>
                            <li>If the grand prize is to be drawn randomly, the number will be drawn from the users with most number of draw tickets</li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="fa fa-award"></span> Winners
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Prize</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Winning Ticket</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($winners->count() > 0)
                                    @foreach ($winners as $winner)
                                        <tr>
                                            <td>{{ $winner->prize->details->prize }}</td>
                                            <td>{{ $winner->name}}</td>
                                            <td>{{ $winner->email}}</td>
                                            <td>{{ $winner->prize->ticket->ticket_number}}</td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan=3>
                                            <p class="alert alert-info">No winners yet</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
