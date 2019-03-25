@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Ny bruger
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('users.store')}}">
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
                                <label>E-mail</label>
                                <input type="text"
                                       name="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password"
                                       name="password"
                                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <b-button type="submit"
                                      variant="primary"
                                      class="float-right ml-2">
                                Opret
                            </b-button>
                            <b-button class="float-right"
                                      href="{{route('users.index')}}">
                                Til oversigten
                            </b-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
