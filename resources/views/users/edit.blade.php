@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-content">
                            <span>{{$user->name}}</span>
                            <div class="ml-auto d-flex align-items-center">
                                @if(auth()->user()->is($user))
                                    <span class="text-danger mr-3">Du er logget ind som denne bruger</span>
                                @endif
                                <form method="POST"
                                      action="{{route('users.destroy', ['user' => $user])}}">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <b-button type="submit"
                                              variant="danger"
                                              size="sm"
                                              v-b-tooltip.hover
                                              title="Slet bruger">
                                        <i class="fas fa-trash"></i>
                                    </b-button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{route('users.update', ['user' => $user])}}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label>Navn</label>
                                <input type="text"
                                       name="name"
                                       value="{{$user->name}}"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
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
                                       value="{{$user->email}}">
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
