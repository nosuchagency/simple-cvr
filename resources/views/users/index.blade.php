@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-content">
                            <span>Brugere</span>
                            <div class="ml-auto">
                                <b-button variant="primary"
                                          size="sm"
                                          href="{{route('users.create')}}"
                                          v-b-tooltip.hover
                                          title="Opret ny bruger">
                                    <i class="fas fa-plus"></i>
                                </b-button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="align-middle">{{$user->name}}</td>
                                    <td class="align-middle">{{$user->email}}</td>
                                    <td class="text-center">
                                        <b-button class="mr-2"
                                                  variant="success"
                                                  size="sm"
                                                  v-b-tooltip.hover
                                                  title="Rediger bruger"
                                                  href="{{route('users.edit', ['user' => $user])}}">
                                            <i class="fas fa-edit"></i>
                                        </b-button>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($users) === 0)
                                <tr>
                                    <td class="text-center"
                                        colspan="7">
                                        Ingen resultater
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
@endsection