@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-content">
                            <span>{{$configuration->name}}</span>
                            <div class="ml-auto">
                                <form method="POST"
                                      action="{{route('configurations.destroy', ['configuration' => $configuration])}}">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <b-button type="submit"
                                              variant="danger"
                                              size="sm"
                                              v-b-tooltip.hover
                                              title="Slet konfiguration">
                                        <i class="fas fa-trash"></i>
                                    </b-button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{route('configurations.update', ['configuration' => $configuration])}}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label>Navn</label>
                                <input type="text"
                                       name="name"
                                       value="{{$configuration->name}}"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
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
                                       value="{{$configuration->whitelisted_words}}"
                                       class="form-control {{ $errors->has('whitelisted_words') ? 'is-invalid' : '' }}">
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
                                       value="{{$configuration->blacklisted_words}}"
                                       class="form-control {{ $errors->has('blacklisted_words') ? 'is-invalid' : '' }}">
                                @if ($errors->has('blacklisted_words'))
                                    <span class="text-danger">{{ $errors->first('blacklisted_words') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-check">
                                <input type="hidden"
                                       name="reject_duplicates"
                                       value="0"
                                       checked>
                                <input type="checkbox"
                                       class="form-check-input"
                                       name="reject_duplicates"
                                       value="1"
                                @if($configuration->reject_duplicates) {{'checked'}} @endif
                                >
                                <label class="form-check-label">
                                    Afvis dubletter på baggrund af virksomhedsadressen
                                </label>
                                @if ($errors->has('reject_duplicates'))
                                    <span class="text-danger">{{ $errors->first('reject_duplicates') }}</span>
                                @endif
                            </div>
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <b-button type="submit"
                                      variant="primary"
                                      class="float-right ml-2">
                                Opdater
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
