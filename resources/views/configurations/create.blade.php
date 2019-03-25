@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Ny konfiguration
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('configurations.store')}}">
                            @csrf
                            <div class="form-group">
                                <label>Navn</label>
                                <input type="text"
                                       name="name"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       value="{{ old('name') }}"
                                       autofocus>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>
                                    Whitelist
                                    <i class="fas fa-question-circle"
                                       v-b-tooltip.hover
                                       title="Angiv kommasepareret streng">
                                    </i>
                                </label>
                                <input type="text"
                                       name="whitelisted_words"
                                       class="form-control {{ $errors->has('whitelisted_words') ? 'is-invalid' : '' }}"
                                       value="{{ old('whitelisted_words') }}">
                                @if ($errors->has('whitelisted_words'))
                                    <span class="text-danger">{{ $errors->first('whitelisted_words') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>
                                    Blacklist
                                    <i class="fas fa-question-circle"
                                       v-b-tooltip.hover
                                       title="Angiv kommasepareret streng">
                                    </i>
                                </label>
                                <input type="text"
                                       name="blacklisted_words"
                                       class="form-control {{ $errors->has('blacklisted_words') ? 'is-invalid' : '' }}"
                                       value="{{ old('blacklisted_words') }}">
                                @if ($errors->has('blacklisted_words'))
                                    <span class="text-danger">{{ $errors->first('blacklisted_words') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox"
                                       class="form-check-input"
                                       name="reject_duplicates"
                                       value="1">
                                <label class="form-check-label">
                                    Afvis dubletter på baggrund af virksomhedsadressen
                                </label>
                                @if ($errors->has('reject_duplicates'))
                                    <span class="text-danger">{{ $errors->first('reject_duplicates') }}</span>
                                @endif
                            </div>
                            <b-button type="submit"
                                      variant="primary"
                                      class="float-right ml-2">
                                Opret
                            </b-button>
                            <b-button class="float-right"
                                      href="{{route('configurations.index')}}">
                                Til oversigten
                            </b-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
