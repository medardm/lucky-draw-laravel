@extends('layouts.app', ['pageTitle' => 'Admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Lucky Draw
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php // TODO: Create draw route ?>
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="prize_id" class="col-md-4 col-form-label text-md-right">{{ __('Prize Types') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="prize_id">
                                    <option value="">Please select</option>
                                    @foreach ($aPrizes as $aPrize)
                                        @if ($aPrize->id == old('prize_id'))
                                            <option selected value="{{ $aPrize->id }}">{{ $aPrize->prize }} | {{ $aPrize->remainingWinners}} prize(s) remaining</option>
                                        @else
                                            <option value="{{ $aPrize->id }}">{{ $aPrize->prize }} | {{ $aPrize->remainingWinners}} prize(s) remaining</option>
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
                            <label for="generate_ticket" class="col-md-4 col-form-label text-md-right">{{ __('Generate Randomly') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="generate_ticket">
                                    <option value="">Please select</option>
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                                @error('generate_ticket')
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
